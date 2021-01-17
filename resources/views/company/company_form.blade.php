@extends('admin.admin_template') @push('main')
    <div class="container p-3">
        <div class="box">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method($method)
                {{-- Company Name --}}
                <div class="field">
                    <label class="label">Company Name</label>
                    <div class="control">
                        <input type="text" class="input" name="company_name" placeholder="Name" @isset($company)
                            value="{{ old('company_name', $company->name) }}" @else value="{{ old('company_name') }}"
                            @endisset />

                        @error('company_name')
                            <span class="help is-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Compa Image --}}
                <label class="label">Company Image</label>
                <div class="file has-name is-fullwidth my-3">
                    <label class="file-label">
                        <input class="file-input" type="file" name="image">
                        <span class="file-cta">
                            <span class="file-icon">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="file-label">
                                Choose an image…
                            </span>
                        </span>
                        <span class="file-name">
                            @isset($company)
                                {{ old('image_name', $company->image_name) }}
                            @else
                                {{ old('image_name') }}
                            @endisset
                        </span>
                    </label>
                    @error('image')
                        <span class="help is-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="control">
                    @switch($method)
                        @case("POST")
                        <button class="button is-primary is-fullwidth"> Add Company </button>
                        @break
                        @case("PUT")
                        <button class="button is-primary is-fullwidth"> Update Company </button>
                        @break
                        @default
                    @endswitch
                </div>
            </form>

        </div>
    </div>
@endpush

@push('script')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let input_field = document.querySelector('input[type=file][name=image]')
            input_field.addEventListener("change", () => {
                if (input_field.value) {
                    let filepath = input_field.value.split(/(\\|\/)/g).pop()
                    document.querySelector('.file-name').innerHTML = filepath
                }
            })
        })

    </script>
@endpush
