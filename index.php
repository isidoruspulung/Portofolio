<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isidorus Pulung — Portofolio Mekatronika</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/myStyle.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        html {
            scroll-behavior: smooth;
        }

        section {
            scroll-margin-top: 85px;
        }

        .navbar-dark .navbar-nav .nav-link {
            transition: all 0.3s ease-in-out;
            border-bottom: 20px solid transparent;
            position: relative;
        }

        .navbar-dark .navbar-nav .nav-link.active,
        .navbar-dark .navbar-nav .nav-link:hover {
            color: #ffc107 !important;
            border-bottom: 2px solid #ffc107;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <?php include 'home.php'; ?>

    <?php include 'services.php'; ?>
    <?php include 'project.php'; ?>
    <?php include 'about.php'; ?>
    <?php include 'contact.php'; ?>

    <footer class="py-4 text-center text-white" style="background-color: #080f17;">
        <div class="container">
            <p class="mb-0 small">&copy; 2026 Isidorus Pulung — Mechatronics Engineering Polytechnic ATMI Surakarta. All
                Rights Reserved.</p>
        </div>
    </footer>

    <script src="assets/js/jquery-3.5.1.slim.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <?php

    $querySkills = mysqli_query($conn, "SELECT * FROM skills");
    $labels = [];
    $data_percentage = [];
    $bg_colors = [];
    $border_colors = [];

    while ($row = mysqli_fetch_assoc($querySkills)) {
        $labels[] = $row['skill_name'];
        $data_percentage[] = $row['percentage'];
        $bg_colors[] = $row['bg_color'];
        $border_colors[] = $row['border_color'];
    }
    ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('mechatronicsSkillChart').getContext('2d');

        var mechatronicsSkillChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: 'Tingkat Penguasaan (%)',
                    data: [],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true, max: 100 }
                },
                responsive: true,
                plugins: { legend: { display: false } }
            }
        });

        function updateChartRealtime() {
            fetch('backend/get-skills.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('File get-skills.php tidak ditemukan');
                    }
                    return response.json();
                })
                .then(resData => {
                    mechatronicsSkillChart.data.labels = resData.labels;
                    mechatronicsSkillChart.data.datasets[0].data = resData.data;
                    mechatronicsSkillChart.data.datasets[0].backgroundColor = resData.bgColors;
                    mechatronicsSkillChart.data.datasets[0].borderColor = resData.borderColors;
                    
                    mechatronicsSkillChart.update();
                })
                .catch(error => console.error('Gagal memuat data grafik:', error));
        }

        updateChartRealtime();
        setInterval(updateChartRealtime, 3000);


        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
        const sections = document.querySelectorAll('section[id]');

        const observerOptions = {
            root: null,
            rootMargin: '-20% 0px -70% 0px',
            threshold: 0
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const currentId = entry.target.getAttribute('id');

                    navLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href') === `#${currentId}`) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        }, observerOptions);

        sections.forEach(section => observer.observe(section));


        const contactForm = document.getElementById('contactForm');
        if (contactForm) {
            contactForm.addEventListener('submit', function (e) {
                e.preventDefault();

                let formData = new FormData(this);

                fetch('backend/simpan-pesan.php', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    const alertContainer = document.getElementById('alert-container');
                    if (data.trim() === 'success') {
                        alertContainer.innerHTML = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Terima Kasih!</strong> Pesan berhasil dikirim dan disimpan ke database.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`;
                        contactForm.reset();
                    } else {
                        alertContainer.innerHTML = `
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Maaf!</strong> Terjadi kesalahan, pesan gagal dikirim.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>`;
                    }
                });
            });
        }
    });
</script>
</body>

</html>