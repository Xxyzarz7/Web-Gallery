@extends('yield/user/layout')

@section('body')
    {{-- Testimonial Section --}}
    <section id="testimonial" class="position-relative py-5">
        <div class="testimonial-pattern-overlay pattern-left position-absolute">
            <img src="images/pattern-testimonial.png" alt="pattern">
        </div>
        <div class="testimonial-pattern-overlay pattern-right position-absolute">
            <img src="images/right-pattern-testimonial.png" alt="pattern">
        </div>

        {{-- user profile --}}
        <div class="container py-5">
            <h2 class="text-white fw-bold display-4 mb-4">Profil Web Media</h2>
            <div class="swiper testimonial-swiper mb-4">
                <div class="swiper-wrapper">
                    <div class="swiper-slide testimonial-content p-5">
                        <p>{{ Auth::user()->alamat }}</p>
                        <div class="row">
                            <div class="col-md-3">
                                <img src="images/profil.png" alt="image" class="img-fluid">
                            </div>
                            <div class="col-md-9">
                                <h5>{{ Auth::user()->name }}</h5>
                                <h6><b>{{ Auth::user()->email }}</b></h6>
                                <h6><b>{{ Auth::user()->username }}</b></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Blog Section --}}
    <section id="blog" class="my-5">
        <div class="container py-5">
            <div class="row align-items-center">

                {{-- button tambah content --}}
                <div class="col-md-6 col-lg-3">
                    <div class="mb-3">
                        <h6>Unggah konten Anda</h6>
                        <h2 class="fw-bold display-4 mb-3">Klik Di Sini</h2>
                        <button type="button" class="btn btn-primary mb-5 mb-md-0" data-bs-toggle="modal" data-bs-target="#contentModal">Tambah Konten</button>
                    </div>
                </div>
                {{-- Scrollable Pop-up Modal --}}
                <div class="modal fade" id="contentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="contentModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-dark" id="contentModalLabel">Tambah Konten</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="max-height: 45vh; overflow-y: auto;">
                                <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="foto" class="form-label">Foto</label>
                                        <input type="file" class="form-control  @error('image') is-invalid @enderror" id="foto" name="image">
                                        @error('image')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="judul" class="form-label">Judul</label>
                                        <input type="text" class="form-control  @error('judul') is-invalid @enderror" id="judul" name="judul">
                                        @error('judul')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                        <input type="text" class="form-control  @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi">
                                        @error('deskripsi')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="kategori" class="form-label">Kategori</label>
                                        <input type="text" class="form-control  @error('kategori') is-invalid @enderror" id="kategori" name="kategori">
                                        @error('kategori')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>                   
                                    <button type="submit" class="btn btn-primary w-100">Tambah</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Content --}}
                @forelse ( $contents as $content )
                    <div class="col-md-6 col-lg-3 {{ $content->kategori }}">
                        <div class="mb-3">
                            <a href="" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('/storage/contents/'.$content->image) }}" alt="image" class="img-fluid" style="width: 250px; height: 250px; object-fit: cover;">
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><h5 class="dropdown-header">Aksi</h5></li>
                                <li><a class="dropdown-item" href="{{ route('content.edit', $content->id) }}">Perbarui Konten</a></li>
                                <form id="delete-form-{{ $content->id }}" action="{{ route('content.delete', $content->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <li>
                                        <button type="button" class="dropdown-item" onclick="sweetalert({{ $content->id }})">Hapus Konten</button>
                                    </li>
                                </form>
                            </ul>                                                     
                            <h6 class="my-3">{{ $content->tanggal }}</h6>
                            <h5 class="mb-3">{{ $content->judul }}</h5>
                            <h6>{{ $content->user->username }}</h6>
                            <p>{{ Str::limit( $content->deskripsi, 20) }}</p>
                            <div class="d-flex align-items-center justify-content-start mt-1 mb-3">
                                {{-- Button Love --}}
                                <form action="{{ route('like', $content->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-primary me-1">
                                        <i class="bi {{ auth()->user()->hasLiked($content) ? 'bi-heart-fill' : 'bi-heart' }}"></i> 
                                        {{ $content->likes()->count() }}
                                    </button>
                                </form>

                                {{-- Button Chat --}}
                                <button class="btn btn-primary me-1" data-bs-toggle="modal" data-bs-target="#showContentModal-{{ $content->id }}">
                                    <i class="bi bi-chat"></i> 
                                    {{ $content->comments->count() }}
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Modal for comments --}}
                    <div class="modal fade" id="showContentModal-{{ $content->id }}" tabindex="-1" aria-labelledby="showContentModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="showContentModalLabel">Komentar</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="max-height: 260px; overflow-y: auto;">
                                    <h3>{{ $content->judul }}</h3>
                                    <img src="{{ asset('/storage/contents/'.$content->image) }}" alt="Image" class="img-fluid mb-3">
                                    <h5>{{ $content->user->username }}</h5>
                                    <p><b>Kategori : {{ $content->kategori }}</b></p>
                                    <p>{{ $content->deskripsi }}</p>
                                    <h5>Komentar :</h5> <hr>
                                    <div class="accordion col-md-13" id="accordionPanelsStayOpenExample">
                                        @if ($content->comments && $content->comments->isNotEmpty())
                                            @foreach ($content->comments as $comment)
                                                <div class="accordion-item mt-3">
                                                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                                        <button class="accordion-button fs-5 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo-{{ $comment->id }}" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo-{{ $comment->id }}">
                                                            {{ $comment->user->username }}
                                                        </button>
                                                    </h2>
                                                    <div id="panelsStayOpen-collapseTwo-{{ $comment->id }}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                                                        <div class="accordion-body">
                                                            <p>{{ $comment->komentar }}</p>
                                                            @if ($comment->id_users == Auth::id())
                                                                <form action="{{ route('comments.delete', $comment->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash3"></i></button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="alert alert-danger">Belum ada komentar. Jadilah yang pertama untuk berkomentar!</p>
                                        @endif
                                    </div>
                                    <hr>
                                    {{-- Form untuk menambah komentar --}}
                                    <form action="{{ route('comment', $content->id) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="komentar" class="form-label"><b>Komentar</b></label>
                                            <input type="text" class="form-control @error('komentar') is-invalid @enderror" id="komentar" name="komentar" placeholder="Tambahkan komentar...">
                                            @error('komentar')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Tambah</button>
                                    </form>
                                </div>                                
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-danger"><b>Kamu belum memiliki Kontent</b></p>
                @endforelse
                {{-- End Content --}}
            </div>
        </div>
    </section>
    @parent
@endsection