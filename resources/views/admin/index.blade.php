@extends('layouts.main')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Users</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Administrate users
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>Name
                                <a href="{{ route('admin.index', ['sortingBy' => 'name' , 'key' => 'ASC' ]) }}">
                                    <i class="fa fa-sort-alpha-asc"></i>
                                </a>
                                <a href="{{ route('admin.index', ['sortingBy' => 'name' , 'key' => 'DESC' ]) }}">
                                    <i class="fa fa-sort-alpha-desc"></i>
                                </a>
                            </th>
                            <th>Email
                                <a href="{{ route('admin.index', ['sortingBy' => 'email' , 'key' => 'ASC' ]) }}">
                                    <i class="fa fa-sort-alpha-asc"></i>
                                </a>
                                <a href="{{ route('admin.index', ['sortingBy' => 'email' , 'key' => 'DESC' ]) }}">
                                    <i class="fa fa-sort-alpha-desc"></i>
                                </a>
                            </th>
                            <th>Role</th>
                            <th>Registered
                                <a href="{{ route('admin.index', ['sortingBy' => 'created_at' , 'key' => 'ASC' ]) }}">
                                    <i class="fa fa-sort-alpha-asc"></i>
                                </a>
                                <a href="{{ route('admin.index', ['sortingBy' => 'created_at' , 'key' => 'DESC' ]) }}">
                                    <i class="fa fa-sort-alpha-desc"></i>
                                </a>
                            </th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="center">
                                @foreach($user->roles as $role)
                                    {{ $role->name }}
                                @endforeach
                            </td>
                            <td class="center">
                                {{ $user->created_at }}
                            </td>
                            <td>

                            </td>
                        </tr>
                        @empty
                            <p>Users not found</p>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
@endsection