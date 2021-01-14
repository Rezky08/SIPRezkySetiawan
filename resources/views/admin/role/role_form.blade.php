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
                    @isset($role)
                    value="{{ old('name', $role->name) }}"
                    @else
                    value="{{ old('name') }}"
                    @endisset
                />
                @error('name')
                <span class="help is-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="field">
            @if ($method == 'POST')
            <button class="button is-success is-fullwidth">Add</button>
            @endif @if ($method == 'PUT')
            <button class="button is-success is-fullwidth">Update</button>
            @endif
        </div>
    </form>
</div>

@endpush @push('script')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        let method = "{{ $method }}";
        if (!method) {
            document.querySelectorAll("input,select").forEach((item) => {
                item.setAttribute("disabled", "disabled");
            });
        }
    });
</script>
@endpush
