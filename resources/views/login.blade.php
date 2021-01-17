@extends('template.out_template')

@push('main')
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
        </div>
        @error('password')
            <span class="help is-danger">{{ $message }}</span>
        @enderror
        <div class="block">
            <a href="{{ url('register') }}" class="has-text-grey-light is-italic">Doesn't have an account?</a>
        </div>
        {{-- button submit --}}
        <div class="control">
            <button class="button is-primary is-fullwidth">login</button>
        </div>
    </form>
@endpush
