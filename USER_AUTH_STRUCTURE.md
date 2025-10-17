# User Authentication Structure - JeevanPravaah

## Overview

This document explains the authenticated user structure and how the navigation changes after login.

## Folder Structure

```
resources/views/
├── auth/
│   ├── login.blade.php          # Login page
│   └── register.blade.php       # Registration page
├── layouts/
│   ├── app.blade.php            # Main layout (for public pages)
│   ├── auth-app.blade.php       # Authenticated layout (for logged-in users)
│   ├── header.blade.php         # Public navbar (with Login button)
│   ├── auth-header.blade.php    # Authenticated navbar (with User Profile dropdown)
│   ├── footer.blade.php         # Footer
│   └── loader.blade.php         # Page loader
└── user/
    └── dashboard.blade.php      # User dashboard (authenticated welcome page)
```

## Key Features

### 1. **Authentication Flow**

-   **Registration**: User registers → Automatically logged in → Redirected to `/dashboard`
-   **Login**: User logs in → Redirected to `/dashboard`
-   **Logout**: User logs out → Redirected to `/login` with success message

### 2. **Navbar Differences**

#### Public Navbar (`layouts/header.blade.php`)

-   Shows: Home, About, Donate, Contact, **Login Button**
-   Used in: `layouts/app.blade.php`
-   Available to: Non-authenticated users

#### Authenticated Navbar (`layouts/auth-header.blade.php`)

-   Shows: Home, About, Donate, Contact, **User Profile Dropdown**
-   User Profile Dropdown includes:
    -   User name and email
    -   My Profile
    -   Donation History
    -   Settings
    -   **Logout button**
-   Used in: `layouts/auth-app.blade.php`
-   Available to: Authenticated users only

### 3. **Routes**

```php
// Public Routes
GET  /                    # Public welcome page
GET  /about              # About page
GET  /donate             # Donate page
GET  /login              # Login page
POST /login              # Login form submission
GET  /register           # Registration page
POST /register           # Registration form submission

// Protected Routes (Requires Authentication)
GET  /dashboard          # User dashboard (authenticated welcome page)
POST /logout             # Logout action
```

### 4. **Controllers**

#### LoginController

-   `showLoginForm()` - Shows login page
-   `login()` - Handles login and redirects to dashboard
-   `logout()` - Logs out user and redirects to login

#### RegisterController

-   `showRegisterForm()` - Shows registration page
-   `register()` - Creates user, logs them in, redirects to dashboard

## User Experience

### New User Journey

1. Visits site → Sees public welcome page with Login button
2. Clicks Register → Fills form → Submits
3. **Automatically logged in** → Redirected to Dashboard
4. Sees personalized welcome message with their name
5. Navbar now shows User Profile dropdown instead of Login button

### Returning User Journey

1. Visits site → Clicks Login
2. Enters credentials → Submits
3. Redirected to Dashboard with welcome back message
4. Navbar shows User Profile dropdown with their name

### Logged-In User Features

-   Personalized dashboard with welcome message
-   User profile dropdown in navbar (Desktop & Mobile)
-   Quick access to:
    -   Profile settings
    -   Donation history
    -   Account settings
    -   Logout option
-   Same content as welcome page but personalized

## Technologies Used

-   **Alpine.js**: For dropdown functionality (loaded via CDN in `auth-app.blade.php`)
-   **Tailwind CSS**: For styling
-   **Laravel Authentication**: Built-in `Auth` facade

## Security

-   Dashboard route protected with `auth` middleware
-   Session regeneration on login/logout
-   Password hashing with bcrypt
-   CSRF protection on all forms

## Customization

To add more authenticated pages:

1. Create view in `resources/views/user/`
2. Extend `layouts/auth-app.blade.php`
3. Add route in `web.php` within `auth` middleware group

## Notes

-   Desktop: Dropdown shows full name and email
-   Mobile: Shows user info at top of mobile menu
-   All links maintained (Home, About, Donate, Contact)
-   Only the auth button changes (Login → User Profile)
