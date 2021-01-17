@extends('template.out_template')
@push('main')
    <div class="block has-text-centered">
        <span class="has-text-weight-bold is-size-4">Register</span>
    </div>
    <form action="" method="POST">
        @csrf
        {{-- name --}}
        <div class="field">
            <label class="label">Name</label>
            <div class="control">
                <input type="text" class="input" name="name" value="{{ old('name') }}">
            </div>
            @error('name')
                <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>
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
        {{-- email --}}
        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input type="email" class="input" name="email" value="{{ old('email') }}">
            </div>
            @error('email')
                <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="columns">
            {{-- password --}}
            <div class="column">
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
                </div>
                @error('password')
                    <span class="help is-danger">{{ $message }}</span>
                @enderror
            </div>
            {{-- password Confirmation--}}
            <div class="column">
                <label class="label">Password Confirmation</label>
                <div class="field has-addons">
                    <div class="control is-expanded">
                        <input type="password" class="input" name="password_confirmation"
                            value="{{ old('password_confirmation') }}">
                    </div>
                    <div class="control">
                        <button type="button" class="button is-inverted">
                            <span class="icon is-right is-clickable">
                                <i class="fas fa-eye"></i>
                            </span>
                        </button>
                    </div>
                </div>
                @error('password_confirmation')
                    <span class="help is-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- button submit --}}
        <div class="control">
            <button class="button is-primary is-fullwidth">register</button>
        </div>
    </form>
@endpush
