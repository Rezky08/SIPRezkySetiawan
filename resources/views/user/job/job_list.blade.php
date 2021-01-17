@extends('admin.admin_template')

@push('main')

    <div class="container p-3">
        <div class="box">
            <table class="table is-fullwidth">
                <tbody>
                    @forelse ($jobs as $job)
                        <tr>
                            <td width="5%" class="is-vcentered">
                                {{ $number++ }}
                            </td>
                            <td width="20%" class="is-vcentered">
                                <div class="image">
                                    <img src="{{ asset($job->company_image) }}" alt="{{ $job->company_name . ' Image' }}">
                                </div>
                            </td>
                            <td>
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
                            </td>
                            <td class="is-vcentered">
                                <a href="{{ url('job/' . $job->id . '/apply') }}" class="button is-primary">Apply</a>
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
