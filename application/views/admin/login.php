<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'Sign In | TeknoLite Admin Portal'; ?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.ico'); ?>" type="image/x-icon">

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --admin-primary: #04308c;
            --admin-primary-hover: #03256c;
            --admin-primary-light: rgba(4, 48, 140, 0.12);
            --admin-dark: #1e2530;
            --admin-slate: #0f172a;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: linear-gradient(135deg, #0b1120 0%, #1e2530 50%, #0f172a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            color: #1e293b;
            position: relative;
            overflow-x: hidden;
        }

        /* Subtle background glowing orbs */
        body::before {
            content: '';
            position: absolute;
            top: -120px;
            left: -120px;
            width: 420px;
            height: 420px;
            background: radial-gradient(circle, rgba(4, 48, 140, 0.18) 0%, rgba(4, 48, 140, 0) 70%);
            border-radius: 50%;
            z-index: 0;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: absolute;
            bottom: -150px;
            right: -150px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.12) 0%, rgba(59, 130, 246, 0) 70%);
            border-radius: 50%;
            z-index: 0;
            pointer-events: none;
        }

        .auth-container {
            width: 100%;
            max-width: 460px;
            position: relative;
            z-index: 1;
        }

        .auth-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.35);
            border: 1px solid rgba(255, 255, 255, 0.08);
            overflow: hidden;
        }

        .auth-card-body {
            padding: 40px 36px 36px;
        }

        .brand-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
            text-decoration: none;
        }

        .brand-icon-box {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(4, 48, 140, 0.12);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .brand-name {
            font-size: 22px;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #0f172a;
        }

        .brand-portal-tag {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            background: #f1f5f9;
            color: #64748b;
            padding: 3px 8px;
            border-radius: 6px;
            margin-left: 6px;
        }

        .form-floating-custom {
            position: relative;
            margin-bottom: 20px;
        }

        .form-floating-custom .form-control {
            height: 50px;
            padding: 12px 16px 12px 42px;
            font-size: 14px;
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            transition: all 0.2s ease-in-out;
            color: #0f172a;
        }

        .form-floating-custom .form-control:focus {
            border-color: var(--admin-primary);
            box-shadow: 0 0 0 4px var(--admin-primary-light);
            outline: none;
        }

        .form-floating-custom .input-icon {
            position: absolute;
            top: 50%;
            left: 14px;
            transform: translateY(-50%);
            font-size: 18px;
            color: #94a3b8;
            pointer-events: none;
            transition: color 0.2s ease;
        }

        .form-floating-custom .form-control:focus ~ .input-icon {
            color: var(--admin-primary);
        }

        .password-toggle-btn {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            background: none;
            border: none;
            padding: 6px;
            color: #94a3b8;
            cursor: pointer;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            transition: color 0.2s ease;
        }

        .password-toggle-btn:hover {
            color: #1e293b;
        }

        .btn-Teknolite-primary {
            background-color: var(--admin-primary);
            color: #ffffff;
            border: none;
            font-weight: 600;
            font-size: 15px;
            height: 48px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(4, 48, 140, 0.35);
        }

        .btn-Teknolite-primary:hover {
            background-color: var(--admin-primary-hover);
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(4, 48, 140, 0.45);
        }

        .btn-Teknolite-primary:active {
            transform: translateY(0);
        }

        .demo-credential-box {
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 10px;
            padding: 12px 14px;
            margin-top: 24px;
        }

        .demo-badge {
            cursor: pointer;
            transition: all 0.15s ease;
            user-select: none;
        }

        .demo-badge:hover {
            background-color: #e2e8f0 !important;
            transform: scale(1.02);
        }

        .back-link {
            color: #94a3b8;
            text-decoration: none;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: #ffffff;
        }
    </style>
</head>
<body>

    <div class="auth-container">
        <!-- Logo & Header -->
        <div class="text-center mb-3">
            <a href="<?= base_url(); ?>" class="brand-badge">
                <div class="brand-icon-box">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 10H20L18.2 20.2C18.086 20.665 17.671 21 17.193 21H6.807C6.329 21 5.914 20.665 5.8 20.2L4 10Z" fill="#04308c"/>
                        <path d="M8.5 13V18M15.5 13V18M12 13V18" stroke="#ffffff" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M8 10L12 4L16 10" stroke="#04308c" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                        <rect x="3" y="9" width="18" height="2.2" rx="1.1" fill="#4a7ad8"/>
                    </svg>
                </div>
                <span class="brand-name">TeknoLite</span>
                <span class="brand-portal-tag">Admin</span>
            </a>
        </div>

        <div class="auth-card">
            <div class="auth-card-body">
                <div class="text-center mb-4">
                    <h4 class="fw-bold text-dark mb-1">Sign In</h4>
                    <p class="text-muted fs-14 mb-0">Enter your credentials to access the admin dashboard</p>
                </div>

                <!-- Alert Messages -->
                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger d-flex align-items-center gap-2 py-2 px-3 mb-3 fs-13 border-0 shadow-sm" role="alert">
                        <i class="bx bx-error-circle fs-18 flex-shrink-0"></i>
                        <div><?= $this->session->flashdata('error'); ?></div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($logout_notice)): ?>
                    <div class="alert alert-info d-flex align-items-center gap-2 py-2 px-3 mb-3 fs-13 border-0 shadow-sm" role="alert">
                        <i class="bx bx-info-circle fs-18 flex-shrink-0"></i>
                        <div><?= html_escape($logout_notice); ?></div>
                    </div>
                <?php elseif ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success d-flex align-items-center gap-2 py-2 px-3 mb-3 fs-13 border-0 shadow-sm" role="alert">
                        <i class="bx bx-check-circle fs-18 flex-shrink-0"></i>
                        <div><?= $this->session->flashdata('success'); ?></div>
                    </div>
                <?php endif; ?>

                <!-- Login Form -->
                <form action="<?= base_url('admin/login'); ?>" method="POST" id="adminLoginForm" novalidate>
                    <?php if ($this->config->item('csrf_protection')): ?>
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                    <?php endif; ?>

                    <!-- Username / Email Field -->
                    <div class="mb-3">
                        <label for="identityInput" class="form-label fs-13 fw-semibold text-dark mb-1">Username or Email</label>
                        <div class="form-floating-custom">
                            <input 
                                type="text" 
                                class="form-control" 
                                id="identityInput" 
                                name="identity" 
                                placeholder="admin or admin@teknolite.com"
                                value="<?= html_escape(set_value('identity', '')); ?>" 
                                required 
                                autofocus 
                                autocomplete="username"
                            >
                            <i class="bx bx-user input-icon"></i>
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="mb-3">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <label for="passwordInput" class="form-label fs-13 fw-semibold text-dark mb-0">Password</label>
                            <span class="text-muted fs-12">Protected Area</span>
                        </div>
                        <div class="form-floating-custom" style="position: relative;">
                            <input 
                                type="password" 
                                class="form-control" 
                                id="passwordInput" 
                                name="password" 
                                placeholder="Enter password"
                                style="padding-right: 46px;" 
                                required 
                                autocomplete="current-password"
                            >
                            <i class="bx bx-lock-alt input-icon"></i>
                            <button type="button" class="password-toggle-btn" id="togglePasswordBtn" aria-label="Toggle password visibility" title="Show/Hide Password">
                                <i class="bx bx-show" id="togglePasswordIcon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me Option -->
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="form-check mb-0">
                            <input class="form-check-input" type="checkbox" name="remember_me" id="rememberMeCheck" value="1" style="cursor: pointer;">
                            <label class="form-check-label fs-13 text-muted user-select-none" for="rememberMeCheck" style="cursor: pointer;">
                                Remember me for 30 days
                            </label>
                        </div>
                        <small class="text-muted fs-12">
                            <i class="bx bx-shield-quarter text-success me-1"></i>256-bit Encrypted
                        </small>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-Teknolite-primary w-100" id="loginSubmitBtn">
                        <i class="bx bx-log-in fs-18"></i>
                        <span>Sign In to Dashboard</span>
                    </button>
                </form>

                <!-- Demo Credentials Helper Pill -->
                <div class="demo-credential-box">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="fs-12 fw-bold text-dark text-uppercase letter-spacing-1">
                            <i class="bx bx-key text-warning me-1"></i>Quick Login Credentials
                        </span>
                        <span class="badge bg-light text-secondary border fs-11">Click to Fill</span>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="button" class="badge bg-white text-dark border demo-badge text-start p-2 text-decoration-none" onclick="fillCredentials('admin', 'Admin@123')">
                            <div class="fw-semibold fs-12 text-primary">Super Admin</div>
                            <div class="text-muted fs-11">User: <code>admin</code> | Pass: <code>Admin@123</code></div>
                        </button>
                        <button type="button" class="badge bg-white text-dark border demo-badge text-start p-2 text-decoration-none" onclick="fillCredentials('manager', 'Admin@123')">
                            <div class="fw-semibold fs-12 text-dark">Store Manager</div>
                            <div class="text-muted fs-11">User: <code>manager</code> | Pass: <code>Admin@123</code></div>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back to Website Footer -->
        <div class="text-center mt-3">
            <a href="<?= base_url(); ?>" class="back-link">
                <i class="bx bx-arrow-back"></i>
                <span>Return to TeknoLite Website</span>
            </a>
            <div class="mt-2 text-muted fs-12" style="opacity: 0.7;">
                &copy; <?= date('Y'); ?> TeknoLite Lighting Solutions. All rights reserved.
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Show / Hide Password
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const passwordInput = document.getElementById('passwordInput');
        const toggleIcon = document.getElementById('togglePasswordIcon');

        if (toggleBtn && passwordInput && toggleIcon) {
            toggleBtn.addEventListener('click', function () {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                toggleIcon.className = isPassword ? 'bx bx-hide' : 'bx bx-show';
            });
        }

        // Quick Credentials Filler
        function fillCredentials(identity, password) {
            const idInput = document.getElementById('identityInput');
            const passInput = document.getElementById('passwordInput');
            if (idInput && passInput) {
                idInput.value = identity;
                passInput.value = password;
                passInput.focus();
            }
        }

        // Form Submission visual state
        const loginForm = document.getElementById('adminLoginForm');
        const submitBtn = document.getElementById('loginSubmitBtn');
        if (loginForm && submitBtn) {
            loginForm.addEventListener('submit', function (e) {
                const idInput = document.getElementById('identityInput');
                const passInput = document.getElementById('passwordInput');
                
                if (!idInput.value.trim() || !passInput.value) {
                    return;
                }

                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Authenticating...';
                setTimeout(function() {
                    submitBtn.disabled = true;
                }, 20);
            });
        }
    </script>
</body>
</html>
