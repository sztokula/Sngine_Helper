# Need more help or custom work?
Join My `Facebook` group: https://www.facebook.com/groups/snginewowonder
Check my `Fanpage`: https://www.facebook.com/flowsitedev
Check my `Website`: https://flowsite.dev


# Secure Config Setup (Very Simple Guide)

This guide helps you move sensitive data (like database password) from `config.php` to `.env`.

You do not need coding knowledge. Follow the steps exactly.

## Why do this?
- It keeps passwords and private keys out of code files.
- It is safer when sharing or backing up project files.
- It makes future updates easier (change settings in one file).
- It lowers risk of exposing database access by mistake.

## Before you start
1. Make a copy (backup) of these files:
   - `includes/config.php`
   - `.htaccess`
2. Keep the backup in a safe folder.

## Step 1: Edit `includes/config.php`
1. Open file: `includes/config.php`.
2. Replace all content with the new config code I already prepared (the version that reads `.env`).
3. Save the file.

## Step 2: Create `.env` file
1. Go to your main project folder (one level above `includes`).
2. Create new file named: `.env`
3. Paste this text inside:

```env
DB_NAME=
DB_USER=
DB_PASSWORD=
DB_HOST=
DB_PORT=3306
SYS_URL=https://example.com
URL_CHECK=true
DEBUGGING=false
DEFAULT_LOCALE=en_us
LICENCE_KEY=
```

4. Copy values from your old `config.php` and put them after `=`.
5. Save `.env`.

Example:

```env
DB_NAME=my_database
DB_USER=my_user
DB_PASSWORD=my_password
DB_HOST=localhost
```

## Step 3: Protect `.env` in `.htaccess`
1. Open `.htaccess` in your project root.
2. Find:

```apache
<FilesMatch "\.(htaccess|htpasswd|ini|log|sh|inc|bak|tpl)$">

Order Allow,Deny

Deny from all
</FilesMatch>
```

3. Replace with:

```apache
<FilesMatch "\.(htaccess|htpasswd|ini|log|sh|inc|bak|tpl|env)$">

Order Allow,Deny

Deny from all
</FilesMatch>
```

4. Save `.htaccess`.

## Step 4: Test if it is safe
1. Open browser.
2. Go to: `https://your-domain.com/.env`
3. Correct result: `403` or `404`.
4. Wrong result: if you can see file content, stop and fix server rules.

## Step 5: Check website
1. Open your website.
2. Check if website works normally.
3. Check login and main pages.

## Important safety notes
- Keep `.env` private.
- Do not upload `.env` to GitHub.
- On production, use `DEBUGGING=false`.
- Best practice: keep `.env` outside public web folder.

## If something breaks
1. Restore your backup files.
2. Try steps again slowly.
3. Check for typing mistakes in `.env`.

# Need more help or custom work?
Join My `Facebook` group: https://www.facebook.com/groups/snginewowonder
Check my `Fanpage`: https://www.facebook.com/flowsitedev
Check my `Website`: https://flowsite.dev