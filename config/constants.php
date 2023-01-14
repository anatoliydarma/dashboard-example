<?php

return [

    'times' => [
        '08:00:00',
        '09:00:00',
        '10:00:00',
        '11:00:00',
        '12:00:00',
    ],

    'order_options' => [
        ['key' => 'start', 'label' => 'Preorder'],
        ['key' => 'order', 'label' => 'Order'],
        ['key' => 'no_shows', 'label' => 'No-shows'],
        ['key' => 'add_on', 'label' => 'Add-on'],
        ['key' => 'adjustment', 'label' => 'Adjustment'],
        ['key' => 'end', 'label' => 'End of day'],
    ],

    'roles' => [
        'operator' => 'Operator',
        'manager' => 'Manager',
        'admin' => 'Admin',
    ],

    'discrepancy_types' => [
        'lost_ticket' => 'Lost ticket',
        'returned_ticket' => 'Returned ticket',
        'missed_pickup' => 'Missed Pickup',
        'other' => 'Other',
    ],
];
