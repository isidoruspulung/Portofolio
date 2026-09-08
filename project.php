<section id="projects" class="py-5" style="background-color: #ffffff; min-height: 90vh;">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="font-weight-bold text-dark section-title">Project Gallery</h2>
            <p class="text-muted">Some of My Mechatronics Projects.</p>
        </div>

        <div class="row">
            <?php
            $queryProjects = mysqli_query($conn, "SELECT * FROM projects");
            
            while ($project = mysqli_fetch_assoc($queryProjects)) {
            ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 h-100 bg-light">
                    <img src="<?= $project['image']; ?>" class="card-img-top" alt="<?= $project['judul']; ?>" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="font-weight-bold text-dark mb-2"><?= $project['judul']; ?></h5>
                        <p class="text-muted small mb-3"><?= $project['keterangan']; ?></p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>