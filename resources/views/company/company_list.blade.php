@extends('admin.admin_template')

@push('main')
    <div class="buttons is-right px-3">
        <a href="{{ url('admin/company/add') }}" class="button is-primary">Add Company</a>
    </div>
    <div class="container p-3">
        <div class="box">
            <table class="table is-fullwidth">
                <tbody>
                    @forelse ($companies as $company)
                        <tr>
                            <td class="is-vcentered">
                                <div class="field">
                                    <div class="control">
                                        <input type="checkbox" name="company_id" class="is-checkradio"
                                            id="check_radio_{{ $company->id }}" value="{{ $company->id }}">
                                        <label for="check_radio_{{ $company->id }}"></label>
                                    </div>
                                </div>
                            </td>
                            <td width="5%" class="is-vcentered">
                                {{ $number++ }}
                            </td>
                            <td width="20%" class="is-vcentered">
                                <div class="image">
                                    <img src="{{ asset($company->image) }}" alt="{{ $company->name . ' Image' }}">
                                </div>
                            </td>
                            <td>
                                <div class="block m-0">
                                    <span class="is-size-5 has-text-weight-bold">{{ $company->name }}</span>
                                </div>
                            </td>
                            <td class="is-vcentered">
                                <div class="buttons is-centered">
                                    <a href="{{ url('admin/company/' . $company->id) }}" class="button is-success is-inverted"
                                        data-tooltip="Show Company Detail">
                                        <span class="icon">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </a>
                                    <a href="{{ url('admin/company/' . $company->id . '/edit') }}"
                                        class="button is-info is-inverted" data-tooltip="Edit Company">
                                        <span class="icon">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                    </a>
                                    <form action="{{ url('admin/company/' . $company->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="button is-inverted is-danger" data-tooltip="Delete Company">
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
                                    <span class="is-size-5 is-italic">Company Not Found</span>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </tbody>
            </table>

            @if ($companies)
                <nav class="pagination is-centered">
                    <a class="pagination-previous" href="{{ $companies->previousPageUrl() }}">Previous</a>
                    <a class="pagination-next" href="{{ $companies->nextPageUrl() }}">Next page</a>

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
            company_id
        @endslot
        @slot('action_url')
            {{ url('admin/company') }}
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
