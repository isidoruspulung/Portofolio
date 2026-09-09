<section id="services" class="py-5" style="background-color: #f8f9fa; min-height: 90vh;">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="font-weight-bold text-dark section-title">Services</h2>
            <p class="text-muted">Solution in the field of mechatronics.</p>
        </div>

        <div class="row">
            <?php
            $queryServices = mysqli_query($conn, "SELECT * FROM services");
            while ($service = mysqli_fetch_assoc($queryServices)) {
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card card-custom h-100 shadow-sm bg-white p-4 border-top border-warning border-4">
                        <div class="card-body">
                            <h4 class="font-weight-bold text-dark mb-3"><?= $service['judul']; ?></h4>
                            <p class="text-muted"><?= $service['keterangan']; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>