# Deploy the PHP registration app to Vercel

This repository now includes a PHP 8.4 + FrankenPHP container setup following Vercel's official PHP-with-Docker deployment guide.

## What Vercel will serve
The root Dockerfile copies the PHP application from `php-version/` into the container web root and copies the shared `style.css` alongside it. The root `index.php` is the registration form; `process.php` validates POST data and renders the formatted result.

## Deploy from GitHub
1. Sign in to Vercel and choose **Add New → Project**.
2. Import `abhishekpasupathy/webtechassigment2`.
3. Set **Root Directory** to the repository root (leave it as `./`).
4. Ensure the Framework Preset is **Other / Container**. The committed `vercel.json` selects the Container framework.
5. Leave Build and Output settings at their defaults; Vercel builds the root `Dockerfile`.
6. Click **Deploy**.

For an already-imported Vercel project, open **Settings → Build and Deployment**, set Framework Preset to **Other / Container** if it is not detected, keep Root Directory at `./`, then redeploy the latest `main` commit.

## Important
- Do not set the Vercel Root Directory to `php-version`; the Dockerfile and Caddyfile are in the repository root.
- GitHub Pages continues to serve the separate static app from root `index.html`; it cannot execute PHP.
- The PHP demo validates and displays submitted values but does not persist them in a database or send email.
- Vercel containers have ephemeral local storage. If persistent registration storage is needed, connect a database or managed storage service.

## Local run
With Docker installed, from the repository root:

```bash
docker build -t rvitm-registration .
docker run --rm -p 8080:80 -e PORT=80 rvitm-registration
```

Open http://localhost:8080.
