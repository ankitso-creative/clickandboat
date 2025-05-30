<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],
        'profile_image' => [
            'driver' => 'local',
            'root' => storage_path('app/public/profile_images'),
            'url' => env('APP_URL').'/storage/profile_images',
            'visibility' => 'public',
            'throw' => false,
        ],
        'listing' => [
            'driver' => 'local',
            'root' => storage_path('app/public/listing/images'),
            'url' => env('APP_URL').'/storage/listing/images',
            'visibility' => 'public',
            'throw' => false,
        ],
        'cover_images' => [
            'driver' => 'local',
            'root' => storage_path('app/public/listing/cover_images'),
            'url' => env('APP_URL').'/storage/listing/cover_images',
            'visibility' => 'public',
            'throw' => false,
        ],
        'blog_images' => [
            'driver' => 'local',
            'root' => storage_path('app/public/blog_images'),
            'url' => env('APP_URL').'/storage/blog_images',
            'visibility' => 'public',
            'throw' => false,
        ],
        'website_logo' => [
            'driver' => 'local',
            'root' => storage_path('app/public/website_logo'),
            'url' => env('APP_URL').'/storage/website_logo',
            'visibility' => 'public',
            'throw' => false,
        ],
        'company_files' => [
            'driver' => 'local',
            'root' => storage_path('app/public/company_files'),
            'url' => env('APP_URL').'/storage/company_files',
            'visibility' => 'public',
            'throw' => false,
        ],
        'evidence_files' => [
            'driver' => 'local',
            'root' => storage_path('app/public/evidence_files'),
            'url' => env('APP_URL').'/storage/evidence_files',
            'visibility' => 'public',
            'throw' => false,
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
            'throw' => false,
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
