<?php

return [
    # Url settings
    'frontend_prefix' => 'shop',
    'backend_prefix' => 'admin/shop',
    'admin_middleware' => 'auth:admin',

    # Images settings
    'thumbnails' => [
        'category' => [
            'width' => 300,
            'height' => 200
        ],

        'product' => [
            'width' => 300,
            'height' => 200
        ],

        'brand' => [
            'width' => 200,
            'height' => 100
        ],
    ],

    'medium_images' => [
        'category' => [
            'width' => 600,
            'height' => 400
        ],

        'product' => [
            'width' => 600,
            'height' => 400
        ],
    ],
];
