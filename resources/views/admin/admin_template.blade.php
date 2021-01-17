@extends('template.main_template')
{{-- @include('admin.admin_sidebar') --}}
@php
$menus = [
    [
        'menu_name' => 'Role',
        'menu_items' => [
            [
                'item_name' => 'Role List',
                'item_link' => url('admin/role')
            ]
        ]
    ],
    [
        'menu_name' => 'User',
        'menu_items' => [
            [
                'item_name' => 'User List',
                'item_link' => url('admin/user')
            ]
        ]
    ],
    [
        'menu_name' => 'Job',
        'menu_items' => [
            [
                'item_name' => 'Job List',
                'item_link' => url('admin/job')
            ],
            [
                'item_name' => 'Company List',
                'item_link' => url('admin/company')
            ]
        ]
    ],

];
@endphp
