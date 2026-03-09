<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru</title>

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        /* --- Custom Styles --- */
        body {
            font-family: 'Poppins', sans-serif;
            /* animated gradient background for visual interest */
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #ff6a88 100%);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            min-height: 100vh;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Card Styling */
        .custom-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            background: rgba(255, 255, 255, 0.98);
            animation: fadeInUp 0.8s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Header Text */
        .text-dark-custom {
            color: #333;
        }

        /* Input Styling */
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15);
            outline: none;
        }

        /* Input Group Icon Styling */
        .input-group-text {
            background: transparent;
            border: none;
            border-right: 1px solid #e0e0e0;
            border-radius: 10px 0 0 10px;
            color: #667eea;
            width: 45px;
            justify-content: center;
        }

        /* Focus effect for input group */
        .input-group-focus {
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15);
            border-radius: 10px;
            border-color: #667eea;
        }

        /* Tombol Register */
        .btn-custom-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 10px 25px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            color: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-custom-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 20px rgba(118, 75, 162, 0.4);
            color: #fff;
        }

        /* Link Styling */
        .text-primary {
            color: #667eea !important;
            font-weight: 500;
        }

        a.text-primary:hover {
            text-decoration: underline !important;
        }

        /* Alert Styling */
        .custom-alert {
            border: none;
            border-radius: 10px;
            font-size: 0.9rem;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-12 col-sm-9 col-md-6 col-lg-5">

            <div class="card custom-card">
                <div class="card-body p-5">

                    <!-- Header -->
                    <div class="text-center mb-4">
                        <h3 class="font-weight-bold text-dark-custom">Buat Akun Baru</h3>
                        <p class="text-muted small">Isi data di bawah untuk mendaftar</p>
                    </div>

                    <!-- ALERT MESSAGES -->
                    <?php
                    echo validation_errors(
                        '<div class="alert alert-danger custom-alert alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle mr-2"></i>',
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></div>'
                    );

                    if ($this->session->flashdata('pesan')) {
                        echo '<div class="alert alert-success custom-alert alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle mr-2"></i>';
                        echo $this->session->flashdata('pesan');
                        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></div>';
                    }

                    echo form_open('pelanggan/login');
                    ?>

                    <!-- Nama Lengkap -->
                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-muted small mb-1">Nama Lengkap</label>
                        <div class="input-group" id="namaGroup">
                            <input type="text" name="nama_pelanggan" value="<?= set_value('nama_pelanggan') ?>"
                                class="form-control border-left-0" placeholder="Nama User"
                                onfocus="focusInput('namaGroup')" onblur="blurInput('namaGroup')">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white h-100 rounded-right">
                                    <i class="fas fa-user"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-muted small mb-1">Alamat Email</label>
                        <div class="input-group" id="emailGroup">
                            <input type="email" name="email" value="<?= set_value('email') ?>"
                                class="form-control border-left-0" placeholder="Masukan Email"
                                onfocus="focusInput('emailGroup')" onblur="blurInput('emailGroup')">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white h-100 rounded-right">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-muted small mb-1">Password</label>
                        <div class="input-group" id="passGroup">
                            <input type="password" name="password" id="password"
                                class="form-control border-left-0 border-right-0" placeholder="Minimal 8 karakter"
                                onfocus="focusInput('passGroup')" onblur="blurInput('passGroup')">
                            <div class="input-group-append cursor-pointer" onclick="togglePassword('password', 'toggleIcon1')">
                                <span class="input-group-text bg-white h-100 rounded-right">
                                    <i class="fas fa-eye text-secondary" id="toggleIcon1"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Ulangi Password -->
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-muted small mb-1">Konfirmasi Password</label>
                        <div class="input-group" id="repassGroup">
                            <input type="password" name="ulangi_password" id="ulangi_password"
                                class="form-control border-left-0 border-right-0" placeholder="Masukkan ulang password"
                                onfocus="focusInput('repassGroup')" onblur="blurInput('repassGroup')">
                            <div class="input-group-append cursor-pointer" onclick="togglePassword('ulangi_password', 'toggleIcon2')">
                                <span class="input-group-text bg-white h-100 rounded-right">
                                    <i class="fas fa-eye text-secondary" id="toggleIcon2"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Button & Link -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <small class="text-muted">
                            Sudah punya akun?
                            <a href="<?= base_url('pelanggan/login') ?>" class="font-weight-bold text-primary text-decoration-none">
                                Login
                            </a>
                        </small>

                        <button type="submit" class="btn btn-custom-register px-4 shadow-sm">
                            <i class="fas fa-user-plus mr-2"></i> Daftar
                        </button>
                    </div>

                    <?php echo form_close(); ?>

                </div>
            </div>

        </div>
    </div>

    <!-- JavaScript for UX -->
    <script>
        // Fitur Tampilkan/Sembunyikan Password
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(iconId);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
                toggleIcon.classList.replace('text-secondary', 'text-primary');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
                toggleIcon.classList.replace('text-primary', 'text-secondary');
            }
        }

        // Efek Border Highlight saat Input Di Klik
        function focusInput(id) {
            document.getElementById(id).classList.add('input-group-focus');
        }

        function blurInput(id) {
            document.getElementById(id).classList.remove('input-group-focus');
        }
    </script>

</body>

</html>