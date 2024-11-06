@extends('yield/user/layout')

@section('body')
    {{-- body --}}
    <section id="cta" class="position-relative my-5">
        <div class="cta-pattern-overlay pattern-left position-absolute top-50 start-0 translate-middle-y">
            <img src="images/cta-pattern.png" alt="pola">
        </div>
        <div class="container my-5 py-5">
            <div class="row align-items-center my-5">
                <div class="col-md-6 offset-md-2">
                    <h6 class="text-white">Like Anda</h6>
                    <h2 class="text-white fw-bold display-4">Tingkatkan jumlah Like Anda Di Sini</h2>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('home') }}" class="btn btn-primary cta-button">home</a>
                </div>
            </div>
        </div>
    </section>

    {{-- content --}}
    <section id="blog" class="my-5">
        <div class="container py-5">
            <div class="row align-items-center">
                {{-- Content --}}
                @forelse($contents as $content)
                    <div class="col-md-6 col-lg-3 {{ $content->kategori }}">
                        <div class="mb-3">
                            <img src="{{ asset('/storage/contents/'.$content->image) }}" alt="image" class="img-fluid" style="width: 250px; height: 250px;  object-fit:cover;">
                            <h6 class="my-3">{{ $content->tanggal }}</h6>
                                <h5 class="mb-3">{{ $content->judul }}</h5>
                                <h6>{{ $content->user->username }}</h6>
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
                    <p class="text-danger"><b>content kosong</b></p>
                @endforelse
                {{-- End Content --}}
            </div>
        </div>
    </section>
@endsection