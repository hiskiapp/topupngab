<?php
// Header menu
return [

    'items' => [
        [],
        [
            'title' => 'Home',
            'root' => true,
            'page' => '/',
            'new-tab' => false,
        ],
        [
            'title' => 'Bot',
            'root' => true,
            'page' => '/bot',
            'new-tab' => false,
        ],
        [
            'title' => 'Transaksi',
            'root' => true,
            'page' => '/transactions',
            'new-tab' => false,
        ],
        [
            'title' => 'Laporan',
            'root' => true,
            'page' => '/reports',
            'new-tab' => false,
        ],
        [
            'title' => 'Master Data',
            'root' => true,
            'toggle' => 'click',
            'submenu' => [
                'type' => 'classic',
                'alignment' => 'left',
                'items' => [
                    [
                        'title' => 'Admin',
                        'icon' => 'media/svg/icons/General/User.svg',
                        'page' => '/users'
                    ],
                    [
                        'title' => 'Customer',
                        'icon' => 'media/svg/icons/Communication/Address-card.svg',
                        'page' => '/customers'
                    ],
                    [
                        'title' => 'Game',
                        'icon' => 'media/svg/icons/Devices/Gamepad2.svg',
                        'page' => '/games'
                    ]
                ]
            ]
        ],
        [
            'title' => 'Lainnya',
            'root' => true,
            'toggle' => 'click',
            'submenu' => [
                'type' => 'classic',
                'alignment' => 'left',
                'items' => [
                    [
                        'title' => 'Broadcast',
                        'icon' => 'media/svg/icons/Devices/LTE2.svg',
                        'page' => '/broadcast'
                    ],
                    [
                        'title' => 'Schedule',
                        'icon' => 'media/svg/icons/Text/Bullet-list.svg',
                        'page' => '/schedules'
                    ],
                    [
                        'title' => 'Pengaturan',
                        'icon' => 'media/svg/icons/General/Settings-2.svg',
                        'page' => '/settings'
                    ]
                ]
            ]
        ],
    ]

];
