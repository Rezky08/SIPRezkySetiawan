@extends('admin.admin_template')
@push('main')
    <div class="container p-3">
        <div class="box">
            <div class="columns">
                <div class="column is-one-third">
                    <img class="image" src="{{ url($company->image) }}" alt="{{ $company->name }} Image">
                </div>
                <div class="column">
                    <div class="block m-0">
                        <div class="columns">
                            <div class="column">
                                <span class="is-size-5 has-text-weight-bold">{{ $company->name }}</span>
                            </div>
                            <div class="column is-one-fifth has-text-right">
                                <a href="{{ url('admin/company/' . $company->id . '/edit') }}"
                                    class="button is-primary is-inverted" data-tooltip="Edit Company">
                                    <span class="icon">
                                        <i class="fas fa-edit"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush
