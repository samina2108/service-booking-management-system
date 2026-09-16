# Service Booking Management System

A web-based **Service Booking Management System** built with Laravel 9 and Bootstrap 5. The system allows administrators and users to manage services, customers, bookings, and related activities through a role-based access control system.

## Features

* 🔐 Authentication — Login, Registration, Password Management
* 👥 Role-Based Access Control — Admin and User roles
* 📊 Dashboard with booking and revenue statistics
* 🛠️ Service Management — Create, View, Edit, Delete
* 👤 Customer Management — Create, View, Edit, Delete
* 📅 Booking Management — Create, View, Edit, Delete
* 🔄 Booking Status Management
* 🧾 Booking Invoice with Print functionality
* 📝 Activity Logs for tracking system activities
* 🔎 Search and filtering
* 📄 Pagination
* 👨‍💼 User Management for administrators
* 👤 User Profile Management
* 📱 Responsive Bootstrap 5 interface

## Admin Access

Administrators have access to:

* Dashboard
* Services
* Customers
* Bookings
* Users
* Activity Logs
* Profile

## User Access

Normal users can access the main operational modules according to their assigned permissions.

Administrative modules such as **Users** and **Activity Logs** are restricted to administrators.

## Technologies Used

* **PHP**
* **Laravel 9**
* **MySQL**
* **Bootstrap 5**
* **Blade Templates**
* **JavaScript**
* **jQuery**
* **Laravel Breeze**
* **Eloquent ORM**
* **Git & GitHub**

## Project Modules

### Dashboard

Provides an overview of:

* Total Services
* Active and Inactive Services
* Total Customers
* Total Bookings
* Booking Status Statistics
* Completed Booking Revenue
* Recent Bookings

### Service Management

Administrators and users can manage service records including:

* Service Name
* Description
* Price
* Status

### Customer Management

The customer module provides:

* Customer registration
* Customer details
* Customer search
* Customer editing
* Customer deletion based on permissions

### Booking Management

Bookings include:

* Customer
* Service
* Booking Date
* Booking Time
* Price
* Booking Status
* Notes

Available booking statuses:

* Pending
* Confirmed
* Completed
* Cancelled

### Activity Logs

The system records important activities such as:

* Booking creation
* Booking updates
* Booking deletion
* Booking status changes
* Customer activities
* Service activities

Administrators can search, filter, view, export, and delete activity logs.

### Role-Based Access Control

The application uses a dedicated **Role model** and `role_id` relationship.

Available roles:

* Admin
* User

Permissions are controlled through middleware and role checks.

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/samina2108/service-booking-management-system.git
cd service-booking-management-system
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Create Environment File

Copy `.env.example` to `.env`:

```bash
cp .env.example .env
```

For Windows:

```bash
copy .env.example .env
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Configure Database

Open `.env` and configure your MySQL database:

```env
DB_DATABASE=service_booking
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Run Migrations

```bash
php artisan migrate
```

### 7. Seed Roles

```bash
php artisan db:seed
```

### 8. Start Laravel Development Server

```bash
php artisan serve
```

Then open:

```text
http://127.0.0.1:8000
```

## Database

The project uses **MySQL** with Laravel migrations for database structure.

Main database entities include:

* Users
* Roles
* Services
* Customers
* Bookings
* Activity Logs

## Security

The application includes:

* Authentication
* CSRF protection
* Password hashing
* Role-based authorization
* Admin middleware
* Permission-based route protection
* Validation for user input

## Project Structure

```text
service-booking/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   ├── Middleware/
│   │   └── Requests/
│   └── Models/
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
├── routes/
├── public/
├── storage/
├── tests/
├── composer.json
└── README.md
```

## GitHub Repository

**Repository:**

https://github.com/samina2108/service-booking-management-system

## License

This project is developed as a portfolio project using the Laravel framework.
