<?php
return [
    'plugin_file' => 'wp-lumen-framework.php',

    'debug' => env('APP_DEBUG'),
    'env' => env('APP_ENV'),
    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */
    'key' => 'SdJFxJjx6z8vyoUTOAEhGdZtpZAWqYh4',
    'cipher' => 'AES-256-CBC',
    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */
    'locale' => 'en',
    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */
    'fallback_locale' => 'en',
];
