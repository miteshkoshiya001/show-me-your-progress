<?php 

return [
    'user_types' => [
        'CUSTOMER' => 'customer',
        'DELIVERY_PERSON' => 'delivery_person',
    ],
    'order_status' => [
        'pending' => [
            'name' => 'Pending',
            'value' => 0,
        ],
        'in progress' => [
            'name' => 'In Progress',
            'value' => 1,
        ],
        'confirmed' => [
            'name' => 'Confirmed',
            'value' => 2,
        ],
        'shipped' => [
            'name' => 'Shipped',
            'value' => 3,
        ],
        'delivered' => [
            'name' => 'Delivered',
            'value' => 4,
        ],
        'cancelled' => [
            'name' => 'Cancel',
            'value' => 5,
        ],
    ]
];