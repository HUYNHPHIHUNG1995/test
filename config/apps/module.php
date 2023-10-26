<?php 

    return [
        'module'=>[
            [
                'title'=>'Tài khoản',
                'icon' => 'fa fa-user',
                'name'=>['user'],
                'subModule' =>[
                    [
                        'title' => 'QL Thành viên',
                        'route' => 'admin/user/list'
                    ],
                    [
                        'title' => 'QL Nhóm thành viên',
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
                        'title' => 'QL Bài viết',
                        'route' => 'admin/post/list'
                    ],
                    [
                        'title' => 'QL Nhóm bài viết',
                        'route' => 'admin/post/catalogue/list'
                    ]
                ]
            ],
            [
                'title'=>'Cấu hình chung',
                'icon' => 'fa fa-language',
                'name'=>['language'],
                'subModule' =>[
                    [
                        'title' => 'QL Ngôn ngữ',
                        'route' => 'admin/language/list'
                    ]
                ]
            ],
        ]
    ];