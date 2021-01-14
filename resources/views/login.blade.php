@extends('template.template')
@section('title', $title)

    @push('content')
        <div class="hero is-fullheight is-primary">
            <div class="hero-body">
                <div class="container">
                    <div class="columns">
                        <div class="column is-offset-one-quarter is-half">
                            <div class="box">
                                <div class="block has-text-centered">
                                    <span class="has-text-weight-bold is-size-4">Login</span>
                                </div>
                                <form action="" method="POST">
                                    @csrf
                                    {{-- username --}}
                                    <div class="field">
                                        <label class="label">Username</label>
                                        <div class="control">
                                            <input type="text" class="input" name="username" value="{{ old('username') }}">
                                        </div>
                                        @error('username')
                                            <span class="help is-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    {{-- password --}}
                                    <label class="label">Password</label>
                                    <div class="field has-addons">
                                        <div class="control is-expanded">
                                            <input type="password" class="input" name="password" value="{{ old('password') }}">
                                        </div>
                                        <div class="control">
                                            <button type="button" class="button is-inverted">
                                                <span class="icon is-right is-clickable">
                                                    <i class="fas fa-eye"></i>
                                                </span>
                                            </button>
                                        </div>
                                        @error('password')
                                            <span class="help is-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    {{-- button submit --}}
                                    <div class="control">
                                        <button class="button is-primary is-fullwidth">login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endpush

    @push('script')
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                let passwordField = document.querySelector('input[name=password]')
                let show_icon = document.querySelector('button .icon')
                let show = false;
                show_icon.addEventListener('click', () => {
                    show = !show;
                    if (show) {
                        passwordField.setAttribute('type', 'text');
                        show_icon.innerHTML = '<i class="fas fa-eye-slash"></i>'
                    } else {
                        passwordField.setAttribute('type', 'password');
                        show_icon.innerHTML = '<i class="fas fa-eye"></i>'
                    }
                })
            });

        </script>
    @endpush
