# Max Kebab

Laravel 11 storefront and admin panel for the Max Kebab website.

## Requirements

- PHP 8.2+
- Composer
- A database:
  - MySQL / MariaDB, or
  - SQLite
- Git
- Node.js and npm are optional for this repo's current runtime

## Important Notes

- Seed data comes from `config/maxkebab.php` and `config/maxkebab-catalog.php`.
- Running the seeders creates the storefront catalog and an admin user from your `.env` values.
- The current layouts load CSS and JS from `public/assets`, so the app can run without Vite.
- `npm run dev` and `npm run build` are not currently usable as-is because `vite.config.js` points to `resources/css/app.css` and `resources/js/app.js`, and those files are not present in the repo.
- Mail defaults to `log`, so SMTP is not required for local setup.

## Option 1: Run With Laravel Herd

Use this if Herd is already installed on the other system.

### 1. Clone the project

```bash
git clone <your-github-repo-url> max-kebab
cd max-kebab
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Create the environment file

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Set the app URL

If Herd will serve this project as `max-kebab.test`, keep:

```env
APP_URL=http://max-kebab.test
```

If Herd gives you a different local domain, update `APP_URL` to match it.

### 5. Choose a database

#### Option A: MySQL / MariaDB

Create a database named `max_kebab`, then set:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=max_kebab
DB_USERNAME=root
DB_PASSWORD=
```

#### Option B: SQLite

This is the quickest local option if you do not want to set up MySQL.

Update `.env` to:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/max-kebab/database/database.sqlite
```

That `DB_DATABASE` value is a placeholder. Replace it with the real absolute path on your machine.

Example on Windows:

```env
DB_CONNECTION=sqlite
DB_DATABASE=C:/Users/your-username/path/to/max-kebab/database/database.sqlite
```

If `database/database.sqlite` does not exist on the new machine, create it:

```bash
touch database/database.sqlite
```

### 6. Run migrations and seeders

```bash
php artisan migrate --seed
```

This will:

- create the tables
- seed the menu/catalog
- create the admin user from `.env`

### 7. Serve the project through Herd

Add or link the project in Herd so it resolves to your local domain, then open that URL in the browser.

Typical local URL:

```text
http://max-kebab.test
```

### 8. Log in to the admin panel

Open:

```text
/login
```

Default seeded admin credentials from `.env.example`:

- Email: `admin@maxkebab.co.uk`
- Password: `MaxKebabAdmin123!`

You can change these in `.env` before running `php artisan migrate --seed`.

## Option 2: Run Without Laravel Herd

Use this if the other system does not have Herd installed.

### 1. Install local prerequisites

Make sure the machine has:

- PHP 8.2+
- Composer
- MySQL / MariaDB or SQLite

### 2. Clone the project

```bash
git clone <your-github-repo-url> max-kebab
cd max-kebab
```

### 3. Install PHP dependencies

```bash
composer install
```

### 4. Create the environment file

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Set the local app URL

For the built-in PHP server, use:

```env
APP_URL=http://127.0.0.1:8000
```

### 6. Choose a database

#### Option A: MySQL / MariaDB

Create a database named `max_kebab`, then set:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=max_kebab
DB_USERNAME=root
DB_PASSWORD=
```

#### Option B: SQLite

Update `.env` to:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/max-kebab/database/database.sqlite
```

That `DB_DATABASE` value is a placeholder. Replace it with the real absolute path on your machine.

Example on Windows:

```env
DB_CONNECTION=sqlite
DB_DATABASE=C:/Users/your-username/path/to/max-kebab/database/database.sqlite
```

Create the SQLite file if needed:

```bash
touch database/database.sqlite
```

### 7. Run migrations and seeders

```bash
php artisan migrate --seed
```

### 8. Start the local server

```bash
php artisan serve
```

Then open:

```text
http://127.0.0.1:8000
```

### 9. Log in to the admin panel

Open:

```text
http://127.0.0.1:8000/login
```

Default seeded admin credentials from `.env.example`:

- Email: `admin@maxkebab.co.uk`
- Password: `MaxKebabAdmin123!`

## Optional Verification

If you install Composer dev dependencies, you can run the test suite with:

```bash
./vendor/bin/pest
```

The feature tests use in-memory SQLite in the test environment.

## Troubleshooting

### App loads but admin/catalog actions fail

Make sure you ran:

```bash
php artisan migrate --seed
```

The storefront can partially fall back to config data, but checkout, admin, orders, and contact records still need the database tables.

### Environment changes are not being picked up

Run:

```bash
php artisan optimize:clear
```

### MySQL connection problems

If you just want the fastest local setup, switch to SQLite in `.env` and use `database/database.sqlite`.

### Frontend build commands fail

That is expected right now. The current app serves its CSS and JS from `public/assets`, and the Vite entry files referenced in `vite.config.js` are missing.
