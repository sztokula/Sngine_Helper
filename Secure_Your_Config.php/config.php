<?php
function loadEnvFile($envPath)
{
    if (!is_readable($envPath)) {
        return;
    }

    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines === false) {
        return;
    }

    foreach ($lines as $line) {
        $trimmed = trim($line);

        if ($trimmed === '' || strpos($trimmed, '#') === 0) {
            continue;
        }

        $parts = explode('=', $trimmed, 2);
        if (count($parts) !== 2) {
            continue;
        }

        $key = trim($parts[0]);
        $value = trim($parts[1]);

        if ($value !== '' && (
            ($value[0] === '"' && substr($value, -1) === '"') ||
            ($value[0] === "'" && substr($value, -1) === "'")
        )) {
            $value = substr($value, 1, -1);
        }

        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
        putenv($key . '=' . $value);
    }
}

function env($key, $default = null)
{
    $value = getenv($key);

    if ($value === false && isset($_ENV[$key])) {
        $value = $_ENV[$key];
    }

    if ($value === false || $value === null || $value === '') {
        return $default;
    }

    return $value;
}

function envBool($key, $default = false)
{
    $value = env($key, null);
    if ($value === null) {
        return $default;
    }

    return filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? $default;
}

$envCandidates = [
    __DIR__ . '/../.env',
    __DIR__ . '/.env',
];

foreach ($envCandidates as $envPath) {
    if (is_readable($envPath)) {
        loadEnvFile($envPath);
        break;
    }
}

define("DB_NAME", env('DB_NAME'));
define("DB_USER", env('DB_USER'));
define("DB_PASSWORD", env('DB_PASSWORD'));
define("DB_HOST", env('DB_HOST'));
define("DB_PORT", env('DB_PORT', '3306'));
define("SYS_URL", env('SYS_URL', 'https://localhost/sngine'));
define("URL_CHECK", envBool('URL_CHECK', true));
define("DEBUGGING", envBool('DEBUGGING', true));
define("DEFAULT_LOCALE", env('DEFAULT_LOCALE', 'en_us'));
define("LICENCE_KEY", env('LICENCE_KEY'));
?>
