@extends('admin.admin_template') @push('main')
    <div class="container p-3">
        <div class="box">
            <form action="" method="POST">
                @csrf
                @method($method)
                {{-- job_name --}}
                <div class="field">
                    <label class="label">Job Name</label>
                    <div class="control">
                        <input type="text" class="input" name="job_name" placeholder="Name" @isset($job)
                        value="{{ old('job_name', $job->name) }}" @else value="{{ old('job_name') }}" @endisset />

                    @error('job_name')
                        <span class="help is-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- job_salary --}}
            <div class="field">
                <label class="label">Job Salary</label>
                <div class="control">
                    <input type="number" class="input" name="job_salary" placeholder="Salary" @isset($job)
                    value="{{ old('job_salary', $job->salary) }}" @else value="{{ old('job_salary') }}" @endisset />

                @error('job_salary')
                    <span class="help is-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Company --}}
        <div class="field">
            <label class="label">Company</label>
            <div class="columns">
                <div class="column">
                    <div class="control select is-fullwidth">
                        <select name="company_id">
                            <option value="" selected disabled>Select</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}" @isset($job) @if ($company->id == old('company_id', $job->company_id))
                                    selected
                                    @endif @else @if ($company->id == old('company_id'))
                                        selected @endif @endisset>{{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('company_id')
                        <span class="help is-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="column is-1">
                    <a href="{{ url('admin/company/add') }}" type="button" class="button is-primary is-inverted"
                        data-tooltip="Add New Company">
                        <span class="icon is-size-3">
                            <i class="fas fa-plus-circle"></i>
                        </span>
                    </a>
                </div>
            </div>
        </div>

        {{-- job_location --}}
        <div class="field">
            <label class="label">Job Location</label>
            <div class="control">
                <input type="text" class="input" name="job_location" placeholder="Location" @isset($job)
                    value="{{ old('job_location', $job->location) }}" @else value="{{ old('job_location') }}"
                    @endisset />
                @error('job_location')
                    <span class="help is-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- job_description --}}
        <div class="field">
            <label class="label">Job Description</label>
            <div class="control">
                <textarea name="job_description" rows="5" class="textarea"
                    style="resize: none">@isset($job){{ old('job_description', $job->description) }}@else{{ old('job_description') }}@endisset</textarea>
                @error('job_description')
                    <span class="help is-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="control">
            @switch($method)
                @case("POST")
                <button class="button is-primary is-fullwidth"> Add Job </button>
                @break
                @case("PUT")
                <button class="button is-primary is-fullwidth"> Update Job </button>
                @break
                @default
            @endswitch
        </div>
    </form>

</div>
</div>
@endpush
