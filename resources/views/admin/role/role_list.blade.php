@extends('admin.admin_template')

@push('main')

    <div class="buttons is-right">
        <a href="{{ url('admin/role/add') }}" class="button is-success">
            <span>Add Role</span>
        </a>
    </div>

    <div class="container p-3">
        <div class="box">
            <table class="table is-fullwidth">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>Name</th>
                        <th width="20%"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $role)
                        <tr>
                            <td>{{ $number++ }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <div class="buttons is-centered">
                                    <a href="{{ url('admin/role/' . $role->id) }}" class="button is-success is-inverted"
                                        data-tooltip="Show Role Detail">
                                        <span class="icon">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </a>
                                    <a href="{{ url('admin/role/' . $role->id . '/edit') }}" class="button is-info is-inverted"
                                        data-tooltip="Edit Role">
                                        <span class="icon">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                    </a>
                                    <form action="{{ url('admin/role/' . $role->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="button is-inverted is-danger" data-tooltip="Delete Role">
                                            <span class="icon">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Data Not Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @if ($roles)
                <nav class="pagination is-centered">
                    <a class="pagination-previous" href="{{ $roles->previousPageUrl() }}">Previous</a>
                    <a class="pagination-next" href="{{ $roles->nextPageUrl() }}">Next page</a>

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
