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
- For this purpose is created a user model with the following fields:
    - Name
    - Email
    - Password
    - Email verification is automatically verified
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
Reservation successful
```

---

## My Reservations

Users can view their reservations at:

```
/my-reservations
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
- Add/edit/delete reservations

---

## Database

### Users
- id
- name
- email
- password
- email_verified_at - auto-verified for the purpose of this project

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

All frontend routes are localized and require a language prefix (e.g., `/en/` or `/sl/`).

### Public Localized
- `/{locale}` - Home/Welcome page (redirects to dashboard if logged in)
- `/{locale}/login` - Custom login form
- `/{locale}/register` - Custom registration form

### Authenticated Localized
- `/{locale}/dashboard` - Main user dashboard, with latest reservation (just for showcase)
- `/{locale}/rooms` - Room listing
- `/{locale}/rooms/{room}` - Individual room details and reservation form
- `/{locale}/my-reservations` - Overview of user's past and current reservations
- `/{locale}/profile` - User profile management (edit/update/delete)
- `/{locale}/logout` - Logout (POST)

### Administrative (Non-localized)
- `/cms` - Twill CMS for managing rooms and multilingual content
- `/admin` - Filament Admin Panel for managing reservations and data overview

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
root
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
Auth - Login and Registeration

### Step 2
Localization setup

### Step 3
Room model + Twill CMS

### Step 4
Frontend room listing

### Step 5
Reservation system (Livewire)

### Step 5.1
Adjust all translations

### Step 6
My reservations page

### Step 7
Filament admin

### Step 8
Add seeder for Users and Rooms

## Installation

### 1. Clone repository

```
git clone https://github.com/dusanCemovic/hotels
cd hotels
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
php artisan storage:link
```

Configure database in `.env`. It is set to be mysql by default.
```
DB_DATABASE=hotels
DB_USERNAME=user
DB_PASSWORD=pass
```

### 4. Run migrations and run seeders
Seeder contains Twill admin user, User admin (for Filament) and 2 rooms for showcase.

```
php artisan migrate
php artisan db:seed
```

### 5. Build assets

```
npm run build
```

### 6. Start server
My local server has php 8.3, so didn't use docker, Laravel Herd or anything like that.

```
php artisan serve
```

### 7. *Run Tests
+ check notes at the end of this file BEFORE running a test
```
php artisan test
```
+ For showcase, i have added some tests. One of them is for reservationService, which checks availability of room and create reservation.
Any running tests now will clear the database, so run again migrations and seeders after it.

---

## Design Decisions

- **Livewire** is used for the reservation flow to handle the multi-step form without full page reloads.
- **Twill CMS** is used for managing rooms to provide a structured and multilingual content editing experience.
- **Filament** is used for admin management due to its speed and ease of building admin panels.
- **URL-based localization** ensures clear language separation and better user experience. For now, it is used id for rooms. This can be updated with translated slugs.
- **Separation of concerns** between CMS, frontend, and admin improves maintainability.

---

## Notes

- Rooms can't be reserved if they are already booked in that period. That's why there is a checker called in the Livewire component. It returns an error message if the room is already booked (simple). 
- We are using ReservationService for availlability and adding reservation. This is done just for good practice how to separate concerns, using dependency injection.
- Separating service is also good for testing. Test for ReservationService is in ReservationServiceTest.php. I did that, because this is a good example of edge cases.
- Users must be authenticated to access room-related pages.
- Basic validation is implemented for reservation dates.
- Localization is handled via URL prefix.
- Exam has simple test coverage.
  - Those tests will clear the database. So, if you want to run them, run `php artisan migrate:fresh --seed` after it.
  - You may run: `php artisan test`. This can be later changed not to make db changes.

---

## Future Improvements

- Add pricing and availability logic with the proposition for free days.
- Improve UI/UX
  - Make dates in reservation form more user friendly and clearer for specific region (e.g. d.M.Y. for Slovenian).
  - Add pagination to a room listing.
  - Update 404 page especially for room listing.
- Using slugs instead of IDs for rooms.
- Each reservation to have a single page
- Make new tests and update them not to make db changes.
- Point out more edge cases and make tests for it.
