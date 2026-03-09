<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Modern</title>

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
            /* Animated background gradient */
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

        /* Card Styling dengan Animasi Masuk */
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

        /* Input Styling */
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15);
        }

        /* Input Group Icon Styling */
        .input-group-text {
            background: transparent;
            border: none;
            border-right: 1px solid #e0e0e0;
            border-radius: 10px 0 0 10px;
        }

        /* Efek Highlight Seluruh Input Group saat Fokus */
        .input-group-focus {
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15);
            border-radius: 10px;
            border-color: #667eea;
        }

        /* Tombol Login */
        .btn-custom-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-custom-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 15px rgba(118, 75, 162, 0.4);
            color: #fff;
        }

        /* Alert Styling */
        .custom-alert {
            border: none;
            border-radius: 10px;
            font-size: 0.9rem;
        }

        /* Link Styling */
        .text-primary {
            color: #667eea !important;
        }

        .text-decoration-none:hover {
            text-decoration: underline !important;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-12 col-sm-9 col-md-6 col-lg-5">

            <div class="card custom-card">
                <div class="card-body p-5">

                    <!-- Header with toggle buttons -->
                    <div class="text-center mb-4">
                        <h3 id="formTitle" class="font-weight-bold text-dark">Selamat Datang</h3>
                        <p id="formSubtitle" class="text-muted small">Silakan login untuk melanjutkan</p>
                    </div>
                    <div class="d-flex justify-content-center mb-3">
                        <button id="btnLogin" class="btn btn-link font-weight-bold">Login</button>
                        <span class="mx-2 text-muted">|</span>
                        <button id="btnRegister" class="btn btn-link font-weight-bold">Register</button>
                    </div>

                    <!-- ALERT MESSAGES (PHP Logic) -->
                    <?php
                    // Menampilkan Error Validasi
                    echo validation_errors(
                        '<div class="alert alert-danger custom-alert alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle mr-2"></i>',
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></div>'
                    );

                    // Menampilkan Pesan Sukses
                    if ($this->session->flashdata('pesan')) {
                        echo '<div class="alert alert-success custom-alert alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle mr-2"></i>';
                        echo $this->session->flashdata('pesan');
                        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></div>';
                    }

                    // Menampilkan Pesan Error
                    if ($this->session->flashdata('error')) {
                        echo '<div class="alert alert-danger custom-alert alert-dismissible fade show" role="alert">
                        <i class="fas fa-times-circle mr-2"></i>';
                        echo $this->session->flashdata('error');
                        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></div>';
                    }
                    ?>

                    <!-- login and register forms container -->
                    <div id="form-login">
                        <?php echo form_open('pelanggan/login'); ?>

                    <!-- Email Field -->
                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-muted small mb-1">Alamat Email</label>
                        <div class="input-group" id="emailGroup">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white h-100">
                                    <i class="fas fa-envelope text-primary"></i>
                                </span>
                            </div>
                            <input type="email" name="email" value="<?= set_value('email') ?>"
                                class="form-control border-left-0" placeholder="nama@contoh.com"
                                onfocus="focusInput('emailGroup')" onblur="blurInput('emailGroup')">
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="form-group mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label class="font-weight-bold text-muted small mb-0">Password</label>
                            <a href="#" class="text-decoration-none small text-primary">Lupa Password?</a>
                        </div>
                        <div class="input-group" id="passGroup">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white h-100">
                                    <i class="fas fa-lock text-primary"></i>
                                </span>
                            </div>
                            <input type="password" name="password" id="password"
                                class="form-control border-left-0 border-right-0" placeholder="Masukkan Password"
                                onfocus="focusInput('passGroup')" onblur="blurInput('passGroup')">
                            <div class="input-group-append cursor-pointer" onclick="togglePassword()">
                                <span class="input-group-text bg-white h-100 rounded-right">
                                    <i class="fas fa-eye text-secondary" id="toggleIcon"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Remember Me Checkbox -->
                    <div class="form-group mb-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="rememberMe">
                            <label class="custom-control-label text-muted small" for="rememberMe">Ingat saya</label>
                        </div>
                    </div>

                    <!-- Button Login -->
                    <button type="submit" class="btn btn-custom-login btn-block py-2 shadow-sm">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                    </button>
                    <?php echo form_close(); ?>
                    </div> <!-- end form-login -->

                    <div id="form-register" style="display:none;">
                        <?php echo form_open('pelanggan/register'); ?>
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
                            <div class="input-group" id="emailGroupReg">
                                <input type="email" name="email" value="<?= set_value('email') ?>"
                                    class="form-control border-left-0" placeholder="Masukan Email"
                                    onfocus="focusInput('emailGroupReg')" onblur="blurInput('emailGroupReg')">
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
                            <div class="input-group" id="passGroupReg">
                                <input type="password" name="password" id="passwordReg"
                                    class="form-control border-left-0 border-right-0" placeholder="Minimal 8 karakter"
                                    onfocus="focusInput('passGroupReg')" onblur="blurInput('passGroupReg')">
                                <div class="input-group-append cursor-pointer" onclick="togglePassword('passwordReg', 'toggleIconReg')">
                                    <span class="input-group-text bg-white h-100 rounded-right">
                                        <i class="fas fa-eye text-secondary" id="toggleIconReg"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Ulangi Password -->
                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-muted small mb-1">Ulangi Password</label>
                            <div class="input-group" id="ulangiGroup">
                                <input type="password" name="ulangi_password" id="ulangi_password"
                                    class="form-control border-left-0 border-right-0" placeholder="Ketik ulang password"
                                    onfocus="focusInput('ulangiGroup')" onblur="blurInput('ulangiGroup')">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-custom-login btn-block py-2 shadow-sm">
                            <i class="fas fa-user-plus mr-2"></i> Daftar
                        </button>
                        <?php echo form_close(); ?>
                    </div> <!-- end form-register -->

                </div>
            </div>

        </div>
    </div>

    <!-- JavaScript for UX Improvements -->
    <script>
        // generic password toggle that works for both login & register
        function togglePasswordField(inputId, iconId) {
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

        // switch between login and register forms
        document.addEventListener('DOMContentLoaded', function() {
            const loginDiv = document.getElementById('form-login');
            const regDiv = document.getElementById('form-register');
            const title = document.getElementById('formTitle');
            const subtitle = document.getElementById('formSubtitle');
            document.getElementById('btnLogin').addEventListener('click', function(e) {
                e.preventDefault();
                loginDiv.style.display = 'block';
                regDiv.style.display = 'none';
                title.textContent = 'Selamat Datang';
                subtitle.textContent = 'Silakan login untuk melanjutkan';
            });
            document.getElementById('btnRegister').addEventListener('click', function(e) {
                e.preventDefault();
                loginDiv.style.display = 'none';
                regDiv.style.display = 'block';
                title.textContent = 'Buat Akun Baru';
                subtitle.textContent = 'Isi data di bawah untuk mendaftar';
            });
        });
    </script>

</body>

</html>