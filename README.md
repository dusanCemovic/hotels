# Laravel Hotel Booking Application

## Project Overview
The application allows users to register, log in, browse rooms, and make reservations through a two-step booking process.

---

## Architecture Overview

The application is divided into three main parts:

### 1. Frontend
- Authentication (login/register)
- Room listing and detail pages
- Reservation flow (Livewire)
- User reservations overview

### 2. CMS (Twill) `/cms`
- Room management
- Multilingual content editing

### 3. Admin Panel (Filament) `/admin`
- Reservation management
- Data overview

---

## Tech Stack

- PHP 8.3
- Laravel 11
- Livewire
- Twill CMS
- Filament 5.x
- MySQL 8.x

---

## Localization

Supported languages:
- Slovenian (sl)
- English (en)

Locale is included in the URL:

```
/sl/...
/en/...
```

Frontend content is translated based on the selected locale.

---

## Authentication

Users must register and log in to:
- View room listings
- View individual room pages
- Make reservations
- Access their reservation history
- For this purpose I will use Laravel Breeze
---

## Rooms

Rooms are managed through Twill CMS:

```
/cms
```

Features:
- Multilingual content
- Room title and description
- Media (images)

---

## Reservations

Reservations are created via a two-step form implemented with Livewire.

### Step 1
- Select date range (from / to)

### Step 2
- Enter personal data:
    - Name
    - Email

After submission, a success message is displayed:

```
Uspešna rezervacija
```

---

## My Reservations

Users can view their reservations at:

```
/moje-rezervacije
```

---

## Admin Panel (Filament)

Reservations are managed via:

```
/admin
```

Admin can:
- View all reservations
- See user and room relationships

---

## Database

### Users
- id
- name
- email
- password

### Rooms
- id
- (translated fields via Twill)
    - title
    - description

### Reservations
- id
- user_id
- room_id
- date_from
- date_to
- name
- email
- timestamps
* This table can be normalized and deleted name and email from it. Keep them only in table users.
---

## Routes Overview

### Public
- `/login`
- `/register`

### Authenticated (localized)
- `/{locale}/rooms`
- `/{locale}/rooms/{room}`
- `/{locale}/my-reservations`
- `/{locale}/logout`

### CMS
- `/cms`

### Admin
- `/admin`

---

## Admin Credentials

### Twill (/cms)
### Filament (/admin)

Email:
```
laravel@humanfrog.com
```

Password:
```
root123
```

---

## Programming steps:

### Presteps:
Install libraries as:
- Twill
- Filament
- Mcamara - laravel localization
- Livewire

### Step 1
Auth (Breeze Livewire)

### Step 2
Localization setup

### Step 3
Room model + Twill CMS

### Step 4
Frontend room listing

### Step 5
Reservation system (Livewire)

### Step 6
My reservations page

### Step 7
Filament admin

## Installation

### 1. Clone repository

```
git clone <repo-url>
cd project
```

### 2. Install dependencies

```
composer install
npm install
```

### 3. Environment setup

```
cp .env.example .env
php artisan key:generate
```

Configure database in `.env`.

### 4. Run migrations

```
php artisan migrate
```

### 5. Build assets

```
npm run dev
```

### 6. Start server

```
php artisan serve
```

---

## Design Decisions

- **Livewire** is used for the reservation flow to handle the multi-step form without full page reloads.
- **Twill CMS** is used for managing rooms to provide a structured and multilingual content editing experience.
- **Filament** is used for admin management due to its speed and ease of building admin panels.
- **URL-based localization** ensures clear language separation and better user experience.
- **Separation of concerns** between CMS, frontend, and admin improves maintainability.

---

## Notes

- Users must be authenticated to access room-related pages.
- Basic validation is implemented for reservation dates.
- Localization is handled via URL prefix.

---

## Future Improvements

- Prevent overlapping reservations
- Add pricing and availability logic
- Improve UI/UX
