<?php 

    return [
        'module'=>[
            [
                'title'=>'Tài khoản',
                'icon' => 'fa fa-user',
                'name'=>['user'],
                'subModule' =>[
                    [
                        'title' => 'Quản lý Thành viên',
                        'route' => 'admin/user/list'
                    ],
                    [
                        'title' => 'Quản lý Nhóm thành viên',
                        'route' => 'admin/user/catalogue/list'
                    ]
                ]
            ],
            [
                'title'=>'Bài viết',
                'icon' => 'fa fa-file',
                'name'=>['post'],
                'subModule' =>[
                    [
                        'title' => 'Quản lý Bài viết',
                        'route' => 'admin/post/list'
                    ],
                    [
                        'title' => 'Quản lý Nhóm bài viết',
                        'route' => 'admin/post/catalogue/list'
                    ]
                ]
            ],
            [
                'title'=>'Cấu hình chung',
                'icon' => 'fa fa-file',
                'name'=>['language'],
                'subModule' =>[
                    [
                        'title' => 'Quản lý Ngôn ngữ',
                        'route' => 'admin/language/list'
                    ]
                ]
            ],
        ]
    ];