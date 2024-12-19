    @extends('yield/user/layout')

    @section('body')
        {{-- body --}}
        <section id="blog" class="my-5">
            {{-- kategori --}}
            <section id="projects">
                <div class="container-fluid my-5 pt-5 p-0 ">
                    <h6 class="text-center text-white mt-5">Selamat Datang <b class="text-dark">{{ Auth::user()->username }}</b></h6>
                    <h2 class="text-center text-white fw-bold display-4 mb-5">Home Web Media</h2>
                    <div class="mb-4">
                        <p class="text-center">
                            <button class="filter-button px-3 me-2 mb-3 active" data-filter=".all">All</button>
                            <button class="filter-button px-3 me-2 mb-3" data-filter=".karya">Karya Seni</button>
                            <button class="filter-button px-3 me-2 mb-3" data-filter=".game">Game</button>
                            <button class="filter-button px-3 me-2 mb-3" data-filter=".meme">Meme</button>
                            <button class="filter-button px-3 me-2 mb-3" data-filter=".foto">foto</button>
                            <button class="filter-button px-3 me-2 mb-3" data-filter=".random">random</button>
                            <button class="filter-button px-3 me-2 mb-3" data-filter=".design">design</button>
                            <button class="filter-button px-3 me-2 mb-3" data-filter=".berita">berita</button>
                            <button class="filter-button px-3 me-2 mb-3" data-filter=".color">color</button>
                            <button class="filter-button px-3 me-2 mb-3" data-filter=".wallpaper">wallpaper</button>
                            <button class="filter-button px-3 me-2 mb-3" data-filter=".animasi">animasi</button>
                        </p>
                    </div>
                </div>
            </section>
            
            {{-- contents --}}
            <div class="container py-5">
                <div class="row align-items-center">
                    {{-- Content --}}
                    @forelse($contents as $content)
                        <div class="col-md-6 col-lg-3 {{ $content->kategori }}">
                            <div class="mb-3">
                                <a href="" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('/storage/contents/'.$content->image) }}" alt="image" class="img-fluid" style="width: 250px; height: 250px; object-fit: cover;">
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><h5 class="dropdown-header">Aksi</h5></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ asset('/storage/contents/'.$content->image) }}" download="{{ $content->judul }}">Download Foto</a>
                                    </li>
                                </ul>  
                                <h6 class="my-3">{{ $content->tanggal }}</h6>
                                    <h5 class="mb-3">{{ Str::limit( $content->judul, 15) }}</h5>
                                    <h6>
                                        <a href="{{ route('content.showprofile', $content->user->username) }}" class="text-decoration-none text-dark">
                                            {{ $content->user->username }}  
                                            @if ($content->user->verify)
                                                <i class="bi bi-patch-check-fill text-info"></i>
                                            @endif
                                        </a>
                                    </h6>
                                <p>{{ Str::limit( $content->deskripsi, 20) }}</p>
                                <div class="d-flex justify-content-start">
                                    <div class="row">
                                        <div class="col">
                                            <form action="{{ route('like', $content->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-primary mt-1 mb-3">
                                                    <i class="bi {{ auth()->user()->hasLiked($content) ? 'bi-heart-fill' : 'bi-heart' }}" style="margin-right: 5px;"></i>{{ $content->likes()->count() }}
                                                </button>
                                            </form>
                                        </div>
                                        {{-- button komen --}}
                                        <div class="col">
                                            <button class="btn btn-primary mt-1 mb-3" data-bs-toggle="modal" data-bs-target="#showContentModal-{{ $content->id }}">
                                                <i class="bi bi-chat" style="margin-right: 5px;"></i>{{ $content->comments->count() }}
                                            </button>
                                        </div>
                                        {{-- Modal for comments --}}
                                        <div class="modal fade" id="showContentModal-{{ $content->id }}" tabindex="-1" aria-labelledby="showContentModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="showContentModalLabel">Komentar</h5>
                                                    </div>
                                                    <div class="modal-body" style="max-height: 260px; overflow-y: auto;">
                                                        <h3>{{ $content->judul }}</h3>
                                                        <img src="{{ asset('/storage/contents/'.$content->image) }}" alt="Image" class="img-fluid d-block mx-auto mb-3">
                                                        <h5>{{ $content->user->username }}</h5>
                                                        <p><b>Kategori : {{ $content->kategori }}</b></p>
                                                        <p>{{ $content->deskripsi }}</p>
                                                        <h5>Like:</h5>
                                                        <hr>
                                                        @forelse($content->likes as $like)
                                                            <p class="alert alert-primary">{{ $like->user->username }}</p>
                                                        @empty
                                                            <p class="alert alert-danger">Belum ada yang menyukai konten ini.</p>
                                                        @endforelse
                                                        <h5>Komentar :</h5> <hr>
                                                        <div class="accordion col-md-13" id="accordionPanelsStayOpenExample">
                                                            {{-- Check if content has comments --}}
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
                                        {{-- end pop-up --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-danger"><b>Konten kosong</b></p>
                    @endforelse
                    {{-- End Content --}}
                </div>
            </div>
        </section>
    @endsection
