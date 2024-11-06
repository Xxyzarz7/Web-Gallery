<section id="footer">
    <div class="container footer-container mt-5 pt-3">
        <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 my-5 py-5">
            <div class="col-md-4 mt-5 mt-md-0">
                <h3>WEB MEDIA</h3>
                <p>{{ Str::limit('Web media adalah sebuah platform sosial yang berfokus pada berbagi foto dan media visual, memungkinkan pengguna untuk terhubung, berinteraksi, dan berbagi momen secara bebas. Website ini dirancang dengan tampilan yang modern dan intuitif, sehingga memudahkan pengguna dalam mengunggah dan menikmati berbagai foto dari pengguna lain.', 100) }}</p>
            </div>

            <div class="col-md-2 offset-md-1">
                <h5 class="py-3">Fitur</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-3"><a href="#" class="nav-link fw-normal p-0">Unggah foto</a></li>
                    <li class="nav-item mb-3"><a href="#" class="nav-link fw-normal p-0">Suka & komentar</a></li>
                    <li class="nav-item mb-3"><a href="#" class="nav-link fw-normal p-0">Unduh</a></li>
                </ul>
            </div>

            <div class="col-md-2">
                <h5 class="py-3">Tautan</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-3"><a href="/" class="nav-link fw-normal p-0">Home</a></li>
                    <li class="nav-item mb-3"><a href="/profile" class="nav-link fw-normal p-0">Profil</a></li>
                    <li class="nav-item mb-3"><a href="{{ route('like.index') }}" class="nav-link fw-normal p-0">Like</a></li>
                </ul>
            </div>

            <div class="col-md-3">
                <h5 class="py-3">Kontak</h5>
                <ul class="nav flex-column">
                    <li class="nav-item d-flex mb-3">
                        <iconify-icon class="contact-icon pe-3" icon="ion:location"></iconify-icon>
                        <a href="#" class="nav-link p-0">KEC Cileunyi, KAB Bandung, Jawa Barat, Indonesia</a>
                    </li>
                    <li class="nav-item d-flex mb-3">
                        <iconify-icon class="contact-icon pe-3" icon="ion:call"></iconify-icon>
                        <a href="https://wa.me/62895708462226" class="nav-link p-0" target="_blank">(+62) 895-7084-62226</a>
                    </li>
                    <li class="nav-item d-flex mb-3">
                        <iconify-icon class="contact-icon pe-3" icon="ion:mail"></iconify-icon>
                        <a href="mailto:zamzamhidayattullah27@gmail.com" class="nav-link p-0">zamzamhidayattullah27@gmail.com</a>
                    </li>
                </ul>
            </div>
        </footer>
    </div>

    <footer class="d-flex flex-wrap justify-content-between align-items-center border-top"></footer>

    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-2 pt-4">
            <div class="col-md-6 d-flex align-items-center">
                <p>© 2024 Web Media - Semua hak dilindungi</p>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-end">
                <p>© 2023 Website Oleh:
                    <a href="#" class="website-link" target="_blank">
                        <b><u>Zamzam</u></b>
                    </a>
                </p>
            </div>
        </footer>
    </div>
</section>
