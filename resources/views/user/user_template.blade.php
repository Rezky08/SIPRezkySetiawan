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
    ]

];
@endphp
