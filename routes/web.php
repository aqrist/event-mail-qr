<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\QRController;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\ScannerController;

Route::get('/', [EventController::class, 'index']);
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::post('/events/{event}/register', [EventController::class, 'register'])->name('events.register');

Route::get('/qr/{participant}', [QRController::class, 'generateQR'])->name('qr.generate');
Route::get('/attendance/scan/{qrCode}', [QRController::class, 'scanQR'])->name('attendance.scan');
Route::get('/ticket/{qrCode}', [QRController::class, 'showQRTicket'])->name('ticket.show');

Route::get('/tutorial', [TutorialController::class, 'index'])->name('tutorial.index');
Route::get('/scanner', [ScannerController::class, 'index'])->name('scanner.index');
