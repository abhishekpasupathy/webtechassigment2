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

## Hosting on Vercel
The repository root now contains a `Dockerfile`, `Caddyfile`, and `vercel.json` configured for Vercel's Container runtime with FrankenPHP. Import the repository into Vercel, keep Root Directory set to `./`, use the Container framework preset, and deploy from the root. See `VERCEL_DEPLOYMENT.md` for the complete steps.

**GitHub Pages cannot execute PHP.** It continues to serve the separate static version from the root `index.html`.

## Data handling
This educational demo validates and displays the submitted details. It does not store them in a database or send email. Avoid entering real sensitive personal information on a public demo.