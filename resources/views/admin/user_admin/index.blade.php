@extends('admin.layout.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tabel User</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">Username</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $orang)
                            <tr>
                                <td>{{ $orang->username }}</td>
                                <td>{{ $orang->email }}</td>
                                <td>{{ $orang->created_at }}</td>

                                @php $mark = $orang->id @endphp

                                <td class="p-1">
                                    <div class="btn-group">

                                        <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>

                                        <div class="dropdown-menu" role="menu">

                                            <a class="dropdown-item" data-toggle="modal" data-target="#edit-modal{{ $mark }}">
                                                <i class="fas fa-pen"></i> Edit
                                            </a>

                                            <a class="dropdown-item" token="{{ csrf_token() }}" method="DELETE" set="sweet-alert-delete" url="{{ route('admin.UsersAdmin.destroy', $orang->id) }}">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </div>
                                    </div>

                                </td>

                            </tr>

                            <div class="modal fade" id="edit-modal{{ $mark }}" aria-modal="true" role="dialog" aria-hidden="true">

                                <div class="modal-dialog">
                                    <div class="modal-content modal-warning">

                                        <div class="modal-header">
                                            <h4 class="modal-title">Form Edit</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>

                                        <form method="POST" action="{{ route('admin.UsersAdmin.update', $mark) }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label for="username">Username</label>

                                                    <input type="text" value="{{ $orang->username }}" name="username{{ $mark }}" class="@error('username' . $mark) is-invalid @enderror form-control" id="username" placeholder="Enter username">
                                                    @error('username' . $mark)
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="email">Email address</label>
                                                    <input type="email" value="{{ $orang->email }}" name="email{{ $mark }}" class="@error('username' . $mark) is-invalid @enderror form-control" id="email" placeholder="Enter email">
                                                    @error('email' . $mark)
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <hr>

                                                <h6>Isi untuk mengganti password</h6>

                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" name="password{{ $mark }}" class="@error('password' . $mark) is-invalid @enderror form-control" id="password" placeholder="Password">
                                                    @error('password' . $mark)
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="password_confirmation">Password Confirm</label>
                                                    <input type="password" name="password{{ $mark }}_confirmation" class="form-control" id="password_confirmation" placeholder="Password Confirm">


                                                </div>

                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

                            @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>


        <div class="col-sm-6">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Admin</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="card-body">

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" value="{{ old('username') }}" class="@error('username') is-invalid @enderror form-control" id="username" placeholder="Enter username">
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror form-control" id="email" placeholder="Enter email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="@error('password') is-invalid @enderror form-control" id="password" placeholder="Password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Password Confirm</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Password Confirm">


                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </form>
            </div>

        </div>

    </div>
</div>
@endsection