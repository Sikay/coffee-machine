<?php

return [
    'argument' => [
        'drink-type' => [
            'name'          => 'drink-type',
            'mode'          => 'REQUIRED',
            'description'   => 'The type of the drink. (Tea, Coffee or Chocolate)',
            'default-value' => null
        ],
        'money' => [
            'name'          => 'money',
            'mode'          => 'REQUIRED',
            'description'   => 'The amount of money given by the user',
            'default-value' => null
        ],
        'sugars' => [
            'name'          => 'sugars',
            'mode'          => 'OPTIONAL',
            'description'   => 'The number of sugars you want. (0, 1, 2)',
            'default-value' => 0
        ],
    ],
    'option' => [
        'extra-hot' => [
            'name'          => 'extra-hot',
            'shortcut'      => 'e',
            'mode'          => 'NONE',
            'description'   => 'The number of sugars you want. (0, 1, 2)',
            'default-value' => null
        ]
    ]
];
