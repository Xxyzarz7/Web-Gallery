@extends('yield/admin/layout')

@section('body')
<section id="services" class="my-5 pt-5">
    <div class="container pt-5">
        <h6>Hello <span class="text-danger">{{ Auth::guard('admin')->user()->name }}</span></h6>
        <h2 class="fw-bold display-4 mb-4">Manage <span class="text-danger">Content</span>
        </h2>
        <div class="bg-light p-4">
            <div class="table-responsive">
                <table id="myTable" class="display table table-bordered text-dark">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Image</th>
                            <th scope="col">Username</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $contents as $index => $content )    
                        <tr>
                            <th scope="row">{{ $index + 1 }}</th>
                            <td><img src="{{ asset('/storage/contents/'.$content->image) }}" alt="image" class="img-fluid" style="width: 100px; height: 100px;  object-fit:cover;"></td>
                            <td>{{ $content->user->username }}</td>
                            <td>{{ $content->judul }}</td>
                            <td>{{ Str::limit( $content->deskripsi, 20) }}</td>
                            <td>{{ $content->kategori }}</td>
                            <td>
                                <form id="delete-form-{{ $content->id }}" action="{{ route('admin.content.delete', $content->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" onclick="sweetalert({{ $content->id }})">
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
