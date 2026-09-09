<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isidorus Pulung — Portofolio Mekatronika</title>

    <!-- CSS Dependencies -->
    <script src="assets/js/cdn.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/myStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS Inline -->
    <style>
        html {
            scroll-behavior: smooth;
        }

        section {
            scroll-margin-top: 85px;
        }

        .navbar-dark .navbar-nav .nav-link {
            transition: all 0.3s ease-in-out;
            position: relative;
        }

        .navbar-nav .nav-link {
            padding-top: 0.3rem !important;
            padding-bottom: 0.3rem !important;
        }

        .navbar-dark .navbar-nav .nav-link.active,
        .navbar-dark .navbar-nav .nav-link:hover {
            color: #ffc107 !important;
        }

        /* Efek animasi saat kursor mendekati card project */
        .project-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .project-card:hover {
            transform: translateY(-8px);
            /* Membuat kartu naik ke atas sedikit */
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
            /* Mempertebal bayangan */
        }

        /* Efek tambahan opsional untuk memperbesar gambar secara halus saat di-hover */
        .project-card overflow-hidden {
            overflow: hidden;
        }

        .project-card:hover .card-img-top {
            transform: scale(1.05);
            transition: transform 0.5s ease;
        }

        .card-img-top {
            transition: transform 0.5s ease;
        }

        .skill-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .skill-card:hover {
            transform: translateX(8px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }

        footer a i {
            transition: color 0.3s ease;
        }

        footer a:hover i {
            color: #ffc107 !important;
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
            <div class="mb-3">
                <a href="https://wa.me/6281392036029" target="_blank" class="text-white mx-2 fs-4" title="WhatsApp">
                    <i class="fab fa-whatsapp fa-lg"></i>
                </a>
                <a href="https://instagram.com/isidorusspulungg" target="_blank" class="text-white mx-2 fs-4"
                    title="Instagram">
                    <i class="fab fa-instagram fa-lg"></i>
                </a>
                <a href="https://linkedin.com/in/isidorus-aprilla-pulung-anggoro" target="_blank"
                    class="text-white mx-2 fs-4" title="LinkedIn">
                    <i class="fab fa-linkedin-in fa-lg"></i>
                </a>
            </div>

            <p class="mb-0 small">&copy; 2026 Isidorus Pulung — Mechatronics Engineering Polytechnic ATMI Surakarta. All
                Rights Reserved.</p>
        </div>
    </footer>

    <!-- JavaScript Dependencies (jQuery harus dimuat sebelum Bootstrap) -->
    <script src="assets/js/jquery-3.5.1.slim.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
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
            const navbarCollapse = document.getElementById('navbarNav'); // Elemen penampung menu collapse

            // Fungsi otomatis menutup navbar saat menu diklik (khusus mobile)
            navLinks.forEach(function (link) {
                link.addEventListener('click', function () {
                    if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                        let bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                            toggle: false
                        });
                        bsCollapse.hide();
                    }
                });
            });

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