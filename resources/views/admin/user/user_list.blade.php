@extends('admin.admin_template')

@push('main')

    <div class="buttons is-right">
        <a href="{{ url('admin/user/add') }}" class="button is-success">
            <span>Add User</span>
        </a>
    </div>

    <div class="container p-3">
        <div class="box">
            <table class="table is-fullwidth">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td width="10%">{{ $number++ }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td width="20%">
                                <div class="buttons is-centered">
                                    <a href="{{ url('admin/user/' . $user->id) }}" class="button is-success is-inverted"
                                        data-tooltip="Show User Detail">
                                        <span class="icon">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </a>
                                    <a href="{{ url('admin/user/' . $user->id . '/edit') }}" class="button is-info is-inverted"
                                        data-tooltip="Edit User">
                                        <span class="icon">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                    </a>
                                    <form action="{{ url('admin/user/' . $user->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="button is-inverted is-danger" data-tooltip="Delete User">
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
            @if ($users)
                <nav class="pagination is-centered">
                    <a class="pagination-previous" href="{{ $users->previousPageUrl() }}">Previous</a>
                    <a class="pagination-next" href="{{ $users->nextPageUrl() }}">Next page</a>

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
