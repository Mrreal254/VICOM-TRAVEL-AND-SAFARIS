# Local Setup

## Requirements

- PHP 8.2+
- Composer
- Node.js 20+
- PostgreSQL 15+
- npm

## Backend

```bash
cd backend
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

## Frontend

```bash
cd frontend
cp .env.example .env.local
npm install
npm run dev
```

Frontend defaults to `http://localhost:3000`; Laravel defaults to `http://localhost:8000`.

## Admin seed

Set `ADMIN_EMAIL` and `ADMIN_PASSWORD` in `backend/.env` before seeding.

Never commit real secrets.
