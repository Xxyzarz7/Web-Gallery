@extends('yield/admin/layout')

@section('body')
    {{-- Body --}}
    <section id="hero" class="position-relative overflow-hidden py-4" style="background: url({{ asset('images/banner-img.png') }});">
        <div class="container py-5 mt-5">
            <div class="row align-items-center py-5 mt-5">
                <div class="col-md-6 mb-5 mb-md-0">
                    <h6 class="text-white">Web Gallery</h6>
                    <h2 class="text-white fw-bold display-2">Web media</h2>
                    <p class="text-white">
                        WEB MEDIA adalah sebuah platform sosial yang berfokus pada berbagi foto dan media visual, 
                        memungkinkan pengguna untuk terhubung, berinteraksi, dan berbagi momen secara bebas. Website ini 
                        dirancang dengan tampilan yang modern dan intuitif, sehingga memudahkan pengguna dalam mengunggah 
                        dan menikmati berbagai foto dari pengguna lain.
                    </p>
                    <ul class="list-unstyled">
                        <li class="text-white fw-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                                <g clip-path="url(#clip0_1_359)">
                                    <path d="M11.5 0.359375C5.34719 0.359375 0.359375 5.34719 0.359375 11.5C0.359375 17.6528 5.34719 22.6406 11.5 22.6406C17.6528 22.6406 22.6406 17.6528 22.6406 11.5C22.6406 5.34719 17.6528 0.359375 11.5 0.359375ZM11.5 2.51562C16.4653 2.51562 20.4844 6.53393 20.4844 11.5C20.4844 16.4653 16.4661 20.4844 11.5 20.4844C6.5347 20.4844 2.51562 16.4661 2.51562 11.5C2.51562 6.5347 6.53393 2.51562 11.5 2.51562ZM17.7982 8.36746L16.7859 7.34693C16.5762 7.13557 16.2349 7.13418 16.0235 7.34387L9.67375 13.6426L6.98778 10.9349C6.77813 10.7235 6.43681 10.7221 6.22545 10.9318L5.20487 11.9441C4.99352 12.1538 4.99212 12.4951 5.20182 12.7065L9.27987 16.8176C9.48952 17.0289 9.83084 17.0303 10.0422 16.8206L17.7952 9.12983C18.0065 8.92014 18.0079 8.57882 17.7982 8.36746Z" fill="white" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_1_359">
                                        <rect width="23" height="23" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                            Web Media non toxic
                        </li>
                    </ul>
                </div>
                <div class="col-md-5 offset-md-1">
                    {{-- Login Form --}}
                    <form action="{{ route('admin.process.login') }}" class="hero-form p-5 form-transition" method="POST">
                        @if (Session::has('success'))
                            <p class="text-primary">{{ Session::get('success') }}</p>
                        @endif
                        @if (Session::has('error'))
                            <p class="text-danger">{{ Session::get('error') }}</p>
                        @endif
                        @csrf
                        <h3>Login Admin</h3>
                        <div class="mb-4">
                            <label for="loginEmail" class="form-label mb-0">Email</label>
                            <input type="text" class="form-control border-0 @error('email') is-invalid @enderror" id="loginEmail" name="email" value="{{ old('email') }}">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="loginPassword" class="form-label mb-0">Password</label>
                            <input type="password" class="form-control border-0 @error('password') is-invalid @enderror" id="loginPassword" name="password">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg w-100">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @parent
@endsection
