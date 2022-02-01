<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'files' => [
            'driver' => 'local',
            'root' => storage_path('app/files'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'convenios' => [
            'driver' => 'local',
            'root' => storage_path('app/convenios'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
        ],


        'ftp' => [
            'driver' => 'ftp',
            'host' => env('FTP_HOST'),
            'port' => env('FTP_PORT', '21'),
            'username' => env('FTP_USERNAME'),
            'password' => env('FTP_PASSWORD'),
            'root' => '/Contenido/ImagenesPerfil'// for example: /var/www/html/dev/images
        ],

        'ftp2' => [
            'driver' => 'ftp',
            'host' => env('FTP_HOST'),
            'port' => env('FTP_PORT', '21'),
            'username' => env('FTP_USERNAME'),
            'password' => env('FTP_PASSWORD'),
            'root' => '/Contenido/ConveniosGuardados/'// for example: /var/www/html/dev/images
        ],

        'ftp3' => [
            'driver' => 'ftp',
            'host' => env('FTP_HOST'),
            'port' => env('FTP_PORT', '21'),
            'username' => env('FTP_USERNAME'),
            'password' => env('FTP_PASSWORD'),
            'root' => '/Contenido/Imagenes/'// for example: /var/www/html/dev/images
        ],

        'ftp4' => [
            'driver' => 'ftp',
            'host' => env('FTP_HOST'),
            'port' => env('FTP_PORT', '21'),
            'username' => env('FTP_USERNAME'),
            'password' => env('FTP_PASSWORD'),
            'root' => '/Contenido/Informacion/'// for example: /var/www/html/dev/images
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
