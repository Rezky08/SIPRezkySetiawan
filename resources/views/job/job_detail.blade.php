@extends('admin.admin_template')
@push('main')
    <div class="container p-3">
        <div class="box">
            <div class="columns">
                <div class="column is-one-third">
                    <img class="image" src="{{ $job->company->image }}" alt="{{ $job->company->name }} Image">
                </div>
                <div class="column">
                    <div class="block m-0">
                        <div class="columns">
                            <div class="column">
                                <span class="is-size-5 has-text-weight-bold">{{ $job->name }}</span>
                            </div>
                            <div class="column is-one-fifth has-text-right">
                                <a href="{{ url('admin/job/' . $job->id . '/edit') }}" class="button is-primary is-inverted"
                                    data-tooltip="Edit Job">
                                    <span class="icon">
                                        <i class="fas fa-edit"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="block ">
                        <span class="icon has-text-primary-dark">
                            <i class="fas fa-dollar-sign"></i>
                        </span>
                        <span class="is-size-6 is-italic">@money($job->salary)</span>
                    </div>
                    <span>
                        <span class="icon has-text-primary-dark">
                            <i class="fas fa-user-tie"></i>
                        </span>
                        <span class="is-size-7">{{ $job->company->name }}</span>
                    </span>
                    <br>
                    <span>
                        <span class="icon has-text-primary-dark"> <i class="fas fa-map-marker"></i></span>
                        <span class="is-size-7">{{ $job->location }}</span>
                    </span>
                </div>
            </div>
            <span class="is-size-6 is-italic">Job Description</span>
            <p>
                {{ $job->description }}
            </p>
        </div>
    </div>
@endpush
