# PHP 8.4 application image for Vercel's Container runtime.
FROM dunglas/frankenphp:1-php8.4-alpine

WORKDIR /app

RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# The PHP application lives in php-version/; expose it as the web document root.
COPY php-version/ ./public/
COPY style.css ./public/style.css

COPY Caddyfile /etc/caddy/Caddyfile

ENV PORT=80

CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile"]
