@extends('template.main_template')
{{-- @include('admin.admin_sidebar') --}}
@php
$menus = [
    [
        'menu_name' => 'Home',
        'menu_items' => [
            [
                'item_name' => 'Home',
                'item_link' => url('/')
            ]
        ]
    ],
    [
        'menu_name' => 'Job',
        'menu_items' => [
            [
                'item_name' => 'Job',
                'item_link' => url('/job')
            ],
            [
                'item_name' => 'Company',
                'item_link' => url('/company')
            ]
        ]
    ]

];
@endphp
