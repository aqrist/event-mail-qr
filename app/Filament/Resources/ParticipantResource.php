<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ParticipantResource\Pages;
use App\Filament\Resources\ParticipantResource\RelationManagers;
use App\Models\Participant;
use App\Models\Event;
use App\Mail\ParticipantRegistered;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Mail;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ParticipantResource extends Resource
{
    protected static ?string $model = Participant::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('event_id')
                    ->label('Event')
                    ->relationship('event', 'title')
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->label('Telepon')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\Textarea::make('additional_data')
                    ->label('Data Tambahan')
                    ->helperText('Format JSON untuk data peserta tambahan'),
                Forms\Components\TextInput::make('qr_code')
                    ->label('Kode QR')
                    ->disabled()
                    ->helperText('Dibuat otomatis saat pembuatan'),
                Forms\Components\Toggle::make('is_attended')
                    ->label('Sudah Hadir'),
                Forms\Components\DateTimePicker::make('attended_at')
                    ->label('Waktu Hadir'),
                Forms\Components\Toggle::make('email_sent')
                    ->label('Email Terkirim'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('event.title')
                    ->label('Event')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Telepon'),
                Tables\Columns\IconColumn::make('is_attended')
                    ->label('Sudah Hadir')
                    ->boolean(),
                Tables\Columns\TextColumn::make('attended_at')
                    ->label('Waktu Hadir')
                    ->dateTime(),
                Tables\Columns\IconColumn::make('email_sent')
                    ->label('Email Terkirim')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('event_id')
                    ->relationship('event', 'title')
                    ->label('Event'),
                Tables\Filters\TernaryFilter::make('is_attended')
                    ->label('Status Kehadiran'),
                Tables\Filters\TernaryFilter::make('email_sent')
                    ->label('Email Terkirim'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('markAttended')
                    ->label('Tandai Hadir')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(function (Participant $record) {
                        $record->markAsAttended();
                        
                        Notification::make()
                            ->title('Berhasil')
                            ->body("Peserta {$record->name} telah ditandai hadir.")
                            ->success()
                            ->send();
                    })
                    ->visible(fn (Participant $record) => !$record->is_attended),
                    
                Tables\Actions\Action::make('resendEmail')
                    ->label('Kirim Ulang Email')
                    ->icon('heroicon-o-envelope')
                    ->color('info')
                    ->requiresConfirmation()
                    ->modalHeading('Kirim Ulang Email Konfirmasi')
                    ->modalDescription(fn (Participant $record) => "Apakah Anda yakin ingin mengirim ulang email konfirmasi kepada {$record->name} ({$record->email})?")
                    ->modalSubmitActionLabel('Kirim Email')
                    ->visible(true)
                    ->action(function (Participant $record) {
                        try {
                            // Log attempt
                            \Log::info('Attempting to resend email to: ' . $record->email);
                            
                            Mail::to($record->email)->send(new ParticipantRegistered($record));
                            
                            $record->update(['email_sent' => true]);
                            
                            \Log::info('Email sent successfully to: ' . $record->email);
                            
                            Notification::make()
                                ->title('Email Terkirim')
                                ->body("Email konfirmasi berhasil dikirim ulang ke {$record->email}")
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            \Log::error('Failed to send email to ' . $record->email . ': ' . $e->getMessage());
                            
                            Notification::make()
                                ->title('Gagal Mengirim Email')
                                ->body("Terjadi kesalahan saat mengirim email: {$e->getMessage()}")
                                ->danger()
                                ->send();
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->label('Export ke Excel'),
                    Tables\Actions\BulkAction::make('resendEmails')
                        ->label('Kirim Ulang Email')
                        ->icon('heroicon-o-envelope')
                        ->color('info')
                        ->requiresConfirmation()
                        ->modalHeading('Kirim Ulang Email Konfirmasi')
                        ->modalDescription('Apakah Anda yakin ingin mengirim ulang email konfirmasi kepada peserta yang dipilih?')
                        ->modalSubmitActionLabel('Kirim Email')
                        ->action(function ($records) {
                            $successCount = 0;
                            $failCount = 0;
                            
                            foreach ($records as $record) {
                                try {
                                    \Log::info('Bulk resending email to: ' . $record->email);
                                    
                                    Mail::to($record->email)->send(new ParticipantRegistered($record));
                                    $record->update(['email_sent' => true]);
                                    $successCount++;
                                    
                                    \Log::info('Bulk email sent successfully to: ' . $record->email);
                                } catch (\Exception $e) {
                                    \Log::error('Bulk email failed for ' . $record->email . ': ' . $e->getMessage());
                                    $failCount++;
                                }
                            }
                            
                            if ($successCount > 0) {
                                Notification::make()
                                    ->title('Email Terkirim')
                                    ->body("Berhasil mengirim {$successCount} email konfirmasi.")
                                    ->success()
                                    ->send();
                            }
                            
                            if ($failCount > 0) {
                                Notification::make()
                                    ->title('Sebagian Email Gagal')
                                    ->body("{$failCount} email gagal dikirim.")
                                    ->warning()
                                    ->send();
                            }
                        })
                        ->deselectRecordsAfterCompletion(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListParticipants::route('/'),
            'create' => Pages\CreateParticipant::route('/create'),
            'edit' => Pages\EditParticipant::route('/{record}/edit'),
        ];
    }
}
