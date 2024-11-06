@extends('yield/admin/layout')

@section('body')
<section id="services" class="my-5 pt-5">
    <div class="container pt-5">
        <h6>Hello <span class="text-danger">{{ Auth::guard('admin')->user()->name }}</span></h6>
        <h2 class="fw-bold display-4 mb-4">Manage <span class="text-danger">User</span>
        </h2>
        <div class="bg-light p-4">
            <div class="table-responsive">
                <table id="myTable" class="display table table-bordered text-dark">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $users as $index => $user )    
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ Str::limit( $user->alamat, 20) }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form id="delete-form-{{ $user->id }}" action="{{ route('admin.user.delete', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" onclick="sweetalert({{ $user->id }})">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>                                
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
