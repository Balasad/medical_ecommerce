# Copilot / AI agent instructions for medical-ecommerce 🚑

Purpose: give AI coding agents the minimum, concrete context to be immediately productive in this Laravel app.

---

## Quick summary (TL;DR) ✅
- Laravel 12 application (PHP 8.2). Core patterns follow Laravel/Breeze scaffolding.
- Frontend uses Vite + Tailwind + Alpine; backend uses Spatie permissions and Laravel queues.
- DB defaults to SQLite for local/dev; migrations create Spatie permission tables in addition to app tables.
- Main useful commands:
  - Setup: `composer run setup` (installs deps, copies `.env`, generates app key, runs migrations, npm install & build)
  - Dev: `composer run dev` (starts `php artisan serve`, queue listener, `php artisan pail` for logs, and `npm run dev`)
  - Tests: `composer run test` or `php artisan test`
  - Formatter: `./vendor/bin/pint`

---

## Big-picture architecture & where to look 🔎
- Backend: standard Laravel MVC
  - Routes: `routes/web.php`, `routes/auth.php` (Breeze-auth routes)
  - Controllers: `app/Http/Controllers/` — auth controllers are under `app/Http/Controllers/Auth`
  - Requests: `app/Http/Requests` holds form request validation
  - Models: `app/Models` (notable: `User` uses `Spatie\Permission\Traits\HasRoles`)
- Frontend: Vite + Tailwind + Alpine
  - CSS: `resources/css/app.css`
  - JS: `resources/js/app.js`
  - Views & components: `resources/views/`, `resources/views/components/`
- Auth & permissions:
  - Breeze-provided auth scaffolding: see `routes/auth.php`, `app/Http/Controllers/Auth/*` and tests in `tests/Feature/Auth`
  - Spatie permissions config: `config/permission.php`, migrations in `database/migrations/*create_permission_tables.php`
- Background work / dev tooling:
  - Queue connection defaults to database (`QUEUE_CONNECTION=database` in `.env.example`)
  - Pail is used to stream logs during `composer run dev` (`php artisan pail`)

---

## Developer workflows & concrete commands (do these first) 🔧
- Local quick-start (recommended):
  1. `composer run setup` — installs PHP/JS deps, copies `.env`, generates app key, runs migrations, builds assets (creates `database/database.sqlite` if missing)
  2. `composer run dev` — runs server + queue + pail + vite in parallel
- Running tests & debugging:
  - `composer run test` or `php artisan test`
  - Run a single test: `php artisan test --filter AuthenticationTest` or `vendor/bin/phpunit tests/Feature/Auth/AuthenticationTest.php`
  - Tests use `RefreshDatabase` and factories (`database/factories/*`) — prefer factories for test data
- Formatting and linting:
  - `./vendor/bin/pint` to format code
- Database notes:
  - Default env uses `DB_CONNECTION=sqlite` (see `.env.example`) — composer setup creates `database/database.sqlite` automatically
  - If you change DB schema, update migrations under `database/migrations/` and run `php artisan migrate`

---

## Project-specific conventions & patterns 🧭
- Auth scaffolding is Breeze-style: controllers in `app/Http/Controllers/Auth`, routes in `routes/auth.php`, tests in `tests/Feature/Auth`.
- Roles & permissions are implemented using Spatie (`HasRoles` on `User` model). Check `config/permission.php` and permission migration for table/column names.
- Use `RefreshDatabase` in feature tests (tests expect a clean DB per test run).
- `User` model uses `protected function casts()` and Laravel's `password` cast (`'password' => 'hashed'`), so tests and factories should expect hashed passwords handled automatically.
- Frontend interactions are minimal; prefer server-side Blade logic for new features unless adding a significant SPA component.

---

## Where to look when something breaks (debugging tips) 🐞
- Auth/login issues → `app/Http/Controllers/Auth/AuthenticatedSessionController.php`, related routes: `routes/auth.php`, and tests: `tests/Feature/Auth/AuthenticationTest.php`.
- Permission problems → `config/permission.php` and migration `database/migrations/*create_permission_tables.php` (check caching: `php artisan config:clear` and permissions cache key).
- Background jobs → ensure the queue worker is running (`php artisan queue:listen`) and `QUEUE_CONNECTION` matches your environment. Use `php artisan queue:failed` and `php artisan queue:work` for debugging.
- Logs → `php artisan pail` or `storage/logs/` (dev uses `composer run dev` which runs `pail` automatically).

---

## Examples the agent should follow (concrete edits)
- Add a new authenticated route:
  - Add entry to `routes/web.php` inside `Route::middleware('auth')->group(...)`
  - Create controller method in `app/Http/Controllers/*`
  - Add a feature test in `tests/Feature/` using `RefreshDatabase` and factories
- Add a permission-protected endpoint:
  - Add permission in a migration/seed or via `Spatie\Permission\Models\Permission`
  - Protect controller with middleware / `authorize` checks and add tests asserting `403` for unauthorized users

---

## PR checklist for AI agents ✅
- Run `composer run test` (fix failing tests first)
- Run `./vendor/bin/pint` to format code
- Run `npm run build` if frontend assets changed
- Add/modify tests related to behavior changes (tests live in `tests/Feature` or `tests/Unit`)
- Update `README.md` or add a short note in a relevant file if new developer-facing commands are introduced

---

## Notes & gotchas ⚠️
- The repo uses PHP 8.2 and Laravel 12 features; ensure any new code uses compatible language features.
- Permissions caching can hide changes — when debugging, clear config/cache or restart dev processes: `php artisan config:clear`, `php artisan cache:clear`.

---

If anything above is unclear or you'd like additional examples (e.g., CI steps, Docker setup, deploy commands or a short TODOS file for common tasks), tell me which area you'd like expanded and I'll iterate. 🙋‍♂️
