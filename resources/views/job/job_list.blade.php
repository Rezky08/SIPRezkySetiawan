@extends('admin.admin_template')

@push('head')
    <style>
        .position-fixed {
            position: fixed;
            left: 10%;
            bottom: 10px;
        }

    </style>
@endpush

@push('main')
    <div class="buttons is-right px-3">
        <a href="{{ url('admin/job/add') }}" class="button is-primary">Add Job</a>
    </div>
    <div class="container p-3">
        <div class="box">
            <table class="table is-fullwidth">
                <tbody>
                    @forelse ($jobs as $job)
                        <tr>
                            <td class="is-vcentered">
                                <div class="field">
                                    <div class="control">
                                        <input type="checkbox" name="job_id" class="is-checkradio"
                                            id="check_radio_{{ $job->id }}" value="{{ $job->id }}">
                                        <label for="check_radio_{{ $job->id }}"></label>
                                    </div>
                                </div>
                            </td>
                            <td width="5%" class="is-vcentered">
                                {{ $number++ }}
                            </td>
                            <td width="20%" class="is-vcentered">
                                <div class="image">
                                    <img src="{{ asset($job->company->image) }}" alt="{{ $job->name . ' Image' }}">
                                </div>
                            </td>
                            <td>
                                <div class="block m-0">
                                    <span class="is-size-5 has-text-weight-bold">{{ $job->name }}</span>
                                </div>
                                <div class="block m-0">
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
                            </td>
                            <td class="is-vcentered">
                                <div class="buttons is-centered">
                                    <a href="{{ url('admin/job/' . $job->id) }}" class="button is-success is-inverted"
                                        data-tooltip="Show Job Detail">
                                        <span class="icon">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </a>
                                    <a href="{{ url('admin/job/' . $job->id . '/edit') }}" class="button is-info is-inverted"
                                        data-tooltip="Edit Job">
                                        <span class="icon">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                    </a>
                                    <form action="{{ url('admin/job/' . $job->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="button is-inverted is-danger" data-tooltip="Delete Job">
                                            <span class="icon">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <div class="columns">
                            <div class="column has-text-centered">
                                <div class="block">
                                    <span class="is-size-5 is-italic">Job Not Found</span>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </tbody>
            </table>

            @if ($jobs)
                <nav class="pagination is-centered">
                    <a class="pagination-previous" href="{{ $jobs->previousPageUrl() }}">Previous</a>
                    <a class="pagination-next" href="{{ $jobs->nextPageUrl() }}">Next page</a>

                    <ul class="pagination-list">
                        @foreach ($pagination as $key => $item)
                            <li>
                                <a class="pagination-link" href="{{ $item }}">{{ $key }}</a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            @endif
        </div>
    </div>
    @component('components.delete-form')
        @slot('input_name')
            job_id
        @endslot
        @slot('action_url')
            {{ url('admin/job') }}
        @endslot
    @endcomponent
@endpush

@push('script')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // pagination handle
            let current_page = "{{ Request::get('page') }}" ? "{{ Request::get('page') }}" : '1';
            document.querySelectorAll('.pagination-link').forEach((item) => {
                page = item.innerHTML;
                if (page == current_page) {
                    item.classList.add('is-current');
                }
            });
        })

    </script>
@endpush
