<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'Admin',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>Hela</b> Job',

    'logo_mini' => '<b>HJ</b>',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'blue',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'admin/dashboard',

    'logout_url' => 'admin/logout',

    'logout_method' => null,

    'login_url' => 'admin/login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        // 'MAIN NAVIGATION',
        // [
        //     'text' => 'Blog',
        //     'url'  => 'admin/blog',
        //     'can'  => 'manage-blog',
        // ],
        // [
        //     'text'        => 'Pages',
        //     'url'         => 'admin/pages',
        //     'icon'        => 'file',
        //     'label'       => 4,
        //     'label_color' => 'success',
        // ],
        // 'ACCOUNT SETTINGS',
        // [
        //     'text' => 'Profile',
        //     'url'  => 'admin/settings',
        //     'icon' => 'user',
        // ],
        // [
        //     'text' => 'Change Password',
        //     'url'  => 'admin/settings',
        //     'icon' => 'lock',
        // ],
        // [
        //     'text'    => 'Multilevel',
        //     'icon'    => 'share',
        //     'submenu' => [
        //         [
        //             'text' => 'Level One',
        //             'url'  => '#',
        //         ],
        //         [
        //             'text'    => 'Level One',
        //             'url'     => '#',
        //             'submenu' => [
        //                 [
        //                     'text' => 'Level Two',
        //                     'url'  => '#',
        //                 ],
        //                 [
        //                     'text'    => 'Level Two',
        //                     'url'     => '#',
        //                     'submenu' => [
        //                         [
        //                             'text' => 'Level Three',
        //                             'url'  => '#',
        //                         ],
        //                         [
        //                             'text' => 'Level Three',
        //                             'url'  => '#',
        //                         ],
        //                     ],
        //                 ],
        //             ],
        //         ],
        //         [
        //             'text' => 'Level One',
        //             'url'  => '#',
        //         ],
        //     ],
        // ],
    //    'LABELS',
        [
            'text' => 'Dashboard',
            'url'  => 'admin/dashboard',
            'icon' => 'home',
        ],
        [
            'text'       => 'Reports',
            'url'  => '',
            'icon' => 'list',
            'submenu' => [
                    [
                        'text'       => 'Service History',
                        'url'  => 'admin/services/servicesHistory',
                        'icon' => 'file',
                    ],
                ]
        ],
        [
            'text' => 'Customers',
            'url'  => 'admin/customers',
            'icon' => 'user',
        ],
        [
            'text'       => 'Job Seeker',
            'url'  => '',
            'icon' => 'user',
            'submenu' => [
                            [
                                'text' => 'List Job Seeker',
                                'url'  => 'admin/experts',
                                'icon'        => 'list',
                            ],
                            [
                                'text' => 'Payout',
                                'url'  => 'admin/payouts',
                                'icon'  => 'money',
                            ],
                        ],
        ],
        [
            'text'       => 'Platform Settings',
            'url'  => '',
            'icon' => 'home',
            'submenu' => [
                [
                    'text'       => 'FAQ',
                    'url'  => 'admin/faqs',
                    'icon' => 'question',
                ],
                [
                    'text'        => 'Categories',
                    'url'         => 'admin/services',
                    'icon'        => 'hand-spock-o',
                ],
                [
                    'text'        => 'Vouchers',
                    'url'         => 'admin/vouchers',
                    'icon'        => 'tag',
                ],
            ]
        ],
        [
            'text'        => 'Account Settings',
            'url'         => '',
            'icon'        => 'user-circle',
            'submenu' => [
                            [
                                'text' => 'Update Profile',
                                'url'  => 'admin/changeProfile',
                                'icon'        => 'user-secret',
                            ],
                            [
                                'text' => 'Change Password',
                                'url'  => 'admin/changePassword',
                                'icon'        => 'lock',
                            ],
                        ],
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
        'select2'    => true,
        'chartjs'    => true,
    ],
];
