@extends('template.template')

@section('title', $title)
    @push('content')
        <div class="hero is-fullheight is-primary">
            <div class="hero-body">
                <div class="container">
                    <div class="columns">
                        <div class="column is-offset-one-quarter is-half">
                            <div class="box">
                                @if (Session::has('error'))
                                    <div class="notification is-danger">
                                        <button class="delete"></button>
                                        {{ Session::get('error') }}
                                    </div>
                                @endif
                                @if (Session::has('success'))
                                    <div class="notification is-success">
                                        <button class="delete"></button>
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                @stack('main')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endpush
    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
                    var $notification = $delete.parentNode;

                    $delete.addEventListener('click', () => {
                        $notification.parentNode.removeChild($notification);
                    });
                });
            });

        </script>
    @endpush
