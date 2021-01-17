@extends('template.main_template')
@push('main')
    <div class="container p-3">
        <div class="box">
            <div class="columns">
                <div class="column">
                    <img class="image" src="{{ $job->company_image }}" alt="{{ $job->company_name }} Image">
                </div>
                <div class="column">
                    <div class="block m-0">
                        <span class="is-size-5 has-text-weight-bold">{{ $job->job_name }}</span>
                    </div>
                    <div class="block ">
                        <span class="icon has-text-primary-dark">
                            <i class="fas fa-dollar-sign"></i>
                        </span>
                        <span class="is-size-6 is-italic">@money($job->job_salary)</span>
                    </div>
                    <span>
                        <span class="icon has-text-primary-dark">
                            <i class="fas fa-user-tie"></i>
                        </span>
                        <span class="is-size-7">{{ $job->company_name }}</span>
                    </span>
                    <br>
                    <span>
                        <span class="icon has-text-primary-dark"> <i class="fas fa-map-marker"></i></span>
                        <span class="is-size-7">{{ $job->job_location }}</span>
                    </span>
                </div>
            </div>
            <span class="is-size-6 is-italic">Job Description</span>
            <p>
                {{ $job->job_description }}
            </p>
        </div>
    </div>
@endpush
