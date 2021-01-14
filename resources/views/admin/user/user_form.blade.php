@extends('admin.admin_template') @push('main')

<div class="box">
    <form action="" method="POST">
        @method($method) @csrf
        {{-- name --}}
        <div class="field">
            <label class="label">Name</label>
            <div class="control">
                <input
                    type="text"
                    class="input"
                    name="name"
                    placeholder="name"
                    @isset($user)
                    value="{{ old('name', $user->name) }}"
                    @else
                    value="{{ old('name') }}"
                    @endisset
                />
                @error('name')
                    <span class="help is-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="columns">
            <div class="column">
                {{-- username --}}
                <div class="field">
                    <label class="label">Username</label>
                    <div class="control">
                        <input
                            type="text"
                            class="input"
                            name="username"
                            placeholder="username"
                            @isset($user)
                            value="{{ old('username', $user->username) }}"
                            @else
                            value="{{ old('username') }}"
                            @endisset
                        />

                    @error('username')
                        <span class="help is-danger">{{ $message }}</span>
                    @enderror
                    </div>
                </div>
            </div>

            <div class="column">
                {{-- email --}}
                <div class="field">
                    <label class="label">Email</label>
                    <div class="control">
                        <input
                            type="email"
                            class="input"
                            name="email"
                            placeholder="email"
                            @isset($user)
                            value="{{ old('email', $user->email) }}"
                            @else
                            value="{{ old('email') }}"
                            @endisset
                        />

                    @error('email')
                        <span class="help is-danger">{{ $message }}</span>
                    @enderror
                    </div>
                </div>
            </div>
        </div>
        {{-- role --}}
        <div class="field">
            <label class="label">Role</label>
            <div class="control select is-fullwidth">
                <select name="role_id">
                    <option value="" selected disabled>Select</option>
                    @foreach ($roles as $role)
                    <option value="{{ $role->id }}" @isset($user) @if ($role->
                        id == old('role_id', $user->role_id)) selected @endif
                        @else @if ($role->id == old('role_id')) selected @endif
                        @endisset>{{ $role->name }}
                    </option>
                    @endforeach
                </select>

            </div>

            @error('role_id')
                <span class="help is-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="field">
            @if ($method == "POST")
                <button class="button is-success is-fullwidth">Add</button>
            @endif
            @if ($method == "PUT")
                <button class="button is-success is-fullwidth">Update</button>
            @endif
        </div>
    </form>
</div>

@endpush

@push('script')
    <script>
        document.addEventListener("DOMContentLoaded",()=>{
            let method = "{{ $method }}";
            if (!method) {
                document.querySelectorAll('input,select').forEach((item)=>{
                    item.setAttribute('disabled','disabled');
                });
            }
        });
    </script>
@endpush
