# Laravel Ticketing App

This is an app that allows users to participate and organize events.

## 🚀 Quick Start

Run project locally

```bash
# First, install dependencies
composer install
npm install

# Then, setup the database
php artisan migrate:fresh --seed

# Then, start the Laravel server
php artisan serve

# On a separate terminal, run the Vite dev server
npm run dev

# Finally, open the app in your browser: http://localhost:8000
```

## ✨ Features

-   [x] User authentication
-   [x] User registration
-   [x] Organizer: Event listing
-   [x] Organizer: Event posting
-   [x] Explore events (upcoming & current)
-   [ ] Participate in events

## Tech Stack

-   [PHP](https://www.php.net/) - Programming language
-   [Laravel](https://laravel.com/) - PHP framework
-   [Laravel Breeze](https://laravel.com/docs/8.x/starter-kits#laravel-breeze) - Authentication scaffolding
-   [MySQL](https://www.mysql.com/) - Database
-   [Inertia.js](https://inertiajs.com/) - Frontend routing
-   [Vue.js](https://vuejs.org/) - Frontend library
-   [TypeScript](https://www.typescriptlang.org/) - Static typing
-   [Vite](https://vitejs.dev/) - Frontend build tool
-   [TailwindCSS](https://tailwindcss.com/) - Utility CSS classes
-   [TailwindUI](https://tailwindui.com/) - UI components

## Testing

```bash
composer test
```
