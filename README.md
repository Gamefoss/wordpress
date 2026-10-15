# Gamefoss WordPress theme

Legacy WordPress site and theme source for Gamefoss.

## Environment configuration

WordPress reads its database credentials and authentication salts from an `env.ini` file beside `wp-config.php`. Create the local file from the tracked example:

```bash
cp example.env.ini env.ini
```

Update every value in `env.ini` for the target environment:

```ini
[STRINGS]
DB_NAME = "database_name"
DB_USER = "database_user"
DB_PASSWORD = "database_password"
DB_HOST = "localhost"

AUTH_KEY = "unique value"
SECURE_AUTH_KEY = "unique value"
LOGGED_IN_KEY = "unique value"
NONCE_KEY = "unique value"
AUTH_SALT = "unique value"
SECURE_AUTH_SALT = "unique value"
LOGGED_IN_SALT = "unique value"
NONCE_SALT = "unique value"
```

Generate unique salt values with the [WordPress salt generator](https://api.wordpress.org/secret-key/1.1/salt/). Copy only the generated values into the corresponding INI entries, not the surrounding PHP `define()` statements.

`env.ini` contains secrets and is intentionally ignored by Git. Never commit it or include it in a public build artifact. `example.env.ini` must contain placeholders or local-only defaults—never production credentials.

On production, prefer storing the configuration outside the public web root and updating the `parse_ini_file()` path in `wp-config.php`. If the host requires `env.ini` beside `wp-config.php`, deny web access in the WordPress `.htaccess` file:

```apache
<Files "env.ini">
    Require all denied
</Files>
```

Confirm that requesting `/env.ini` returns `403 Forbidden` or `404 Not Found`. If the file has ever been publicly accessible or committed with real credentials, rotate the database password and WordPress salts.

## Build the theme

Install the locked dependencies and build the generated theme:

```bash
npm ci
npm run build
```

The output is written to `wp-content/themes/gamefoss/`.

## Deployment

Pull requests run the build without publishing. A push to `main` builds and uploads only `wp-content/themes/gamefoss/`.

The deployment assumes the FTP user's root maps to the server's `/old` directory, so the workflow target `/wp-content/themes/gamefoss/` resolves to `/old/wp-content/themes/gamefoss/` on the server.
