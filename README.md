# RVITM Student Registration Portal

A responsive online student registration form built with **HTML5, CSS3, JavaScript, jQuery**, and a PHP-compatible project structure.

## Features
- Student information form with required-field validation.
- Email, phone number, and date-of-birth validation.
- jQuery-powered submit handling and feedback.
- Formatted application summary after successful submission.
- Print-friendly receipt and option to submit another response.
- Responsive layout for desktop and mobile screens.

## Run locally
Because this GitHub Pages version is static, you can simply open `index.html` in a browser or run a local static server:

```bash
python3 -m http.server 8000
```

Then visit http://localhost:8000.

## Host on GitHub Pages
1. Open **Settings → Pages** in this repository.
2. Under **Build and deployment**, choose **Deploy from a branch**.
3. Select branch **main** and folder **/(root)**, then save.
4. Wait for the Pages deployment and open the URL shown there.

## PHP note
GitHub Pages does not execute PHP. This repository therefore uses client-side JavaScript/jQuery to validate and display the submitted details so the application works on GitHub Pages. The form is a front-end demonstration; it does not persist submissions to a server or database.

To use actual PHP processing, deploy the PHP version to a PHP-enabled host (for example, a server running Apache or PHP-FPM) and point the form to the PHP endpoint.

## Assignment coverage
- HTML: form structure and fields.
- CSS: responsive styling and formatted result view.
- JavaScript: validation and output generation.
- jQuery: event handling, DOM updates, and effects.
- PHP: documented deployment limitation for GitHub Pages; PHP cannot run on static GitHub Pages hosting.
