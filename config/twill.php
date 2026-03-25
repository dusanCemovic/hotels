<?php

return [
    'enabled' => [
        'users-management' => true,
        'media-library' => true,
        'file-library' => true,
        'block-editor' => true,
        'buckets' => true,
        'settings' => true,
        'dashboard' => true,
        'search' => true,
        'capsules' => false,
    ],
    'locale' => 'en',
    'admin_app_path' => 'cms',
    'admin_app_url' => env('ADMIN_APP_URL', null),
    'publish_date_24h' => true,
];
