 <section id="contact" class="py-5" style="background-color: #f1f5f9; min-height: 85vh;">
        <div class="container py-5">
            <div class="text-center mb-5">
                <h2 class="font-weight-bold text-dark section-title">Contact Me</h2>
                <p class="text-muted">If you have any questions or project offers, feel free to reach out!</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card shadow border-0 p-4 p-md-5 bg-white rounded-lg">

                        <div id="alert-container"></div>

                        <form id="contactForm" action="backend/simpan-pesan.php" method="POST">
                            <div class="form-group">
                                <label for="nama" class="font-weight-bold text-dark">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Masukkan nama Anda" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="font-weight-bold text-dark">Alamat Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="nama@email.com" required>
                            </div>
                            <div class="form-group">
                                <label for="pesan" class="font-weight-bold text-dark">Pesan</label>
                                <textarea class="form-control" id="pesan" name="pesan" rows="4"
                                    placeholder="Tuliskan pesan atau penawaran proyek..." required></textarea>
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit"
                                    class="btn btn-primary btn-lg px-5 font-weight-bold shadow-sm">Kirim Pesan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>