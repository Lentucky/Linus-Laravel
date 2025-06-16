# 🎬 Laravel Cinema Booking App

A web-based cinema seat reservation system built with Laravel. This application allows users to browse movie showtimes, view available seats, and book tickets in real time. Designed with a responsive and user-friendly interface using Tailwind CSS.

---

## 📸 Demo

> *(Optional: Insert a screenshot or link to a deployed demo)*  
![Screenshot](public/images/demo-screenshot.png)

---

## ✨ Features

- 🗓️ View available showtimes for each movie
- 🎟️ Real-time seat selection interface
- ✅ Seat booking and availability updates
- 👤 Customer registration and login
- 🛡️ Admin panel for managing movies, schedules, and bookings
- 📱 Mobile responsive design using Tailwind CSS

---

## 🛠️ Technologies Used

- **Backend:** Laravel 10+
- **Frontend:** Blade, Tailwind CSS
- **Database:** MySQL / MariaDB
- **Authentication:** Laravel Breeze / Jetstream (optional)
- **Storage:** Local/private file storage for user avatars (optional)

---


---

## ⚙️ Installation

Follow these steps to set up the Laravel Cinema Booking App on your local machine.

### Prerequisites

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL or compatible database
- Git

---

### Step-by-Step Guide

1. **Clone the Repository**

- git clone https://github.com/yourusername/laravel-cinema-booking.git
- cd laravel-cinema-booking

2. **Install PHP Dependencies via Composer**

- composer install

3. **Install Frontend Dependencies via NPM**

- npm install
- npm run dev

4. **Run Migrations**

- php artisan migrate

5. **Seed the Database**

- php artisan db:seed --class=AllSeeder
- php artisam db:seed --class=SeatSeeder

6. **Run Laravel Development Server**

- php artisan serve
