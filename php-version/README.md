# PHP Student Registration Version

This folder contains the server-side PHP implementation of the RVITM student registration assignment.

## Files
- `index.php` — HTML registration form; submits using HTTP POST.
- `process.php` — validates submitted data on the server and prints a formatted application summary.
- `validation.js` — JavaScript/jQuery client-side validation.
- `../style.css` — shared responsive styling.

## Run locally
Install PHP 8 or later, open a terminal in the repository root, and run:

```bash
php -S localhost:8000
```

Open http://localhost:8000/php-version/.

## Hosting
**Do not use GitHub Pages for this PHP version.** GitHub Pages only serves static files and will not execute `.php` files. Deploy the repository (or just this folder and its shared stylesheet) to a PHP-enabled host such as InfinityFree, a cPanel/Hostinger PHP hosting account, or a VPS with PHP configured.

For a basic shared host, upload the contents of `php-version/` into the site's public web directory and also upload the root `style.css` file one directory above it, or change the stylesheet path to match where you place it.

## Data handling
This educational demo validates and displays the submitted details. It does not store them in a database or send email. Avoid entering real sensitive personal information on a public demo.