@extends('yield/user/layout')

@section('body')
    <section id="about">
        <div class="container py-5">
            <div class="row align-items-center py-5">
                <div class="col-md-6 ps-md-5">
                    <img src="{{ asset('storage/contents/' . $content->image) }}" alt="Current Image" class="img-fluid">
                </div>
                <div class="col-md-6 px-4 py-5">
                    <h6 class="">Perbarui Konten</h6>
                    <h2 class="fw-bold display-4 mb-3">Perbarui Konten</h2>

                    <div class="bg-light p-4">
                        <form action="{{ route('content.update', $content->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="loginjudul" class="form-label mb-0">Judul</label>
                                <input type="text" class="form-control border-0 @error('judul') is-invalid @enderror" id="loginjudul" name="judul" value="{{ old('judul', $content->judul) }}">
                                @error('judul')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="logindeskripsi" class="form-label mb-0">Deskripsi</label>
                                <textarea class="form-control border-0 @error('deskripsi') is-invalid @enderror" id="logindeskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $content->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="loginkategori" class="form-label mb-0">Kategori</label>
                                <select class="form-control border-0 @error('kategori') is-invalid @enderror" id="loginkategori" name="kategori">
                                    <option value="">Pilih Kategori</option>
                                    <option value="karya" {{ old('kategori', $content->kategori) == 'karya' ? 'selected' : '' }}>Karya Seni</option>
                                    <option value="game" {{ old('kategori', $content->kategori) == 'game' ? 'selected' : '' }}>Game</option>
                                    <option value="meme" {{ old('kategori', $content->kategori) == 'meme' ? 'selected' : '' }}>Meme</option>
                                    <option value="foto" {{ old('kategori', $content->kategori) == 'foto' ? 'selected' : '' }}>Foto</option>
                                    <option value="random" {{ old('kategori', $content->kategori) == 'random' ? 'selected' : '' }}>Random</option>
                                    <option value="design" {{ old('kategori', $content->kategori) == 'design' ? 'selected' : '' }}>Design</option>
                                    <option value="berita" {{ old('kategori', $content->kategori) == 'berita' ? 'selected' : '' }}>Berita</option>
                                    <option value="color" {{ old('kategori', $content->kategori) == 'color' ? 'selected' : '' }}>Color</option>
                                    <option value="wallpaper" {{ old('kategori', $content->kategori) == 'wallpaper' ? 'selected' : '' }}>Wallpaper</option>
                                    <option value="animasi" {{ old('kategori', $content->kategori) == 'animasi' ? 'selected' : '' }}>Animasi</option>
                                </select>
                                @error('kategori')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary service-btn mt-3">Perbarui</button>
                        </form>                        
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
