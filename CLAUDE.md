# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel-based event management system with Filament admin panel and Bootstrap 5 frontend. The system handles:
- Event registration and management
- QR code-based attendance tracking
- Email notifications (registration confirmations, reminders)
- Admin panel for event CRUD operations
- Public frontend for event listing and registration

## Development Commands

### Core Laravel Commands
- `php artisan serve` - Start development server
- `php artisan migrate` - Run database migrations
- `php artisan migrate:rollback` - Rollback migrations
- `php artisan tinker` - Access Laravel REPL
- `php artisan config:clear` - Clear config cache
- `php artisan route:list` - List all routes

### Development Workflow
- `composer dev` - Start full development environment (server, queue, logs, vite)
- `npm run dev` - Start Vite development server for assets
- `npm run build` - Build production assets

### Testing
- `composer test` - Run PHPUnit tests (includes config:clear)
- `php artisan test` - Run tests directly
- `vendor/bin/phpunit` - Run PHPUnit manually

### Code Quality
- `vendor/bin/pint` - Format PHP code (Laravel Pint)
- `vendor/bin/pail` - View application logs in real-time

## Architecture

### Frontend Stack
- **Bootstrap 5** for public-facing pages
- **Tailwind CSS 4** for styling (via Vite)
- **Vite** for asset compilation
- **Blade templates** for views

### Backend Stack
- **Laravel 12** framework
- **Filament** for admin panel
- **PHP 8.2+** requirement
- **SQLite** for testing, configurable for production

### Key Directories
- `app/Http/Controllers/` - HTTP controllers
- `app/Models/` - Eloquent models
- `resources/views/` - Blade templates
- `resources/css/` & `resources/js/` - Frontend assets
- `database/migrations/` - Database schema
- `routes/web.php` - Web routes
- `config/` - Laravel configuration files

### Database
- Uses Laravel migrations for schema management
- Default testing setup uses SQLite in-memory database
- User model includes standard Laravel authentication features

## Development Notes

### Asset Compilation
- Assets are managed through Vite with Laravel integration
- CSS and JS entry points: `resources/css/app.css`, `resources/js/app.js`
- Tailwind CSS configured via `@tailwindcss/vite` plugin

### Testing Environment
- PHPUnit configured for Feature and Unit tests
- Uses array drivers for cache, mail, queue in testing
- SQLite in-memory database for fast test execution

### Event Management Features (Implemented)
The system includes all features from the README:
- **Event Management**: Full CRUD via Filament admin panel
- **Participant Registration**: Public forms with custom fields support
- **QR Code System**: Auto-generated QR codes for each participant
- **Email Notifications**: Registration confirmations and event reminders
- **Attendance Tracking**: QR scanning with real-time status updates
- **Export Functionality**: Excel export for participant lists
- **Bootstrap 5 Frontend**: Responsive public pages

### Commands
- `php artisan events:send-reminders` - Send reminder emails for events happening in 24 hours
- Add to scheduler in `app/Console/Kernel.php` for automated reminders

### Routes
- `/` - Homepage with event listings
- `/events` - Event listings
- `/events/{event}` - Event details and registration
- `/ticket/{qrCode}` - View ticket with QR code
- `/attendance/scan/{qrCode}` - QR scan for check-in
- `/admin` - Filament admin panel