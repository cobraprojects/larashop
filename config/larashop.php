<?php

return [
    # Url settings
    'frontend_prefix' => 'shop',
    'backend_prefix' => 'admin/shop',
    'admin_middleware' => 'auth:admin',

    # Images settings
    'thumbnails' => [
        'category' => [
            'width' => '300px',
            'height' => '200px'
        ],

        'product' => [
            'width' => '300px',
            'height' => '200px'
        ],
    ],

    'medium_images' => [
        'category' => [
            'width' => '600px',
            'height' => '400px'
        ],

        'product' => [
            'width' => '600px',
            'height' => '400px'
        ],
    ],
];
