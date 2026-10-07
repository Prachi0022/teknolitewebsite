<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta charset="utf-8">
    <title>Set New Password | TeknoLite Architectural Lighting</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php $this->load->view('components/head'); ?>
</head>

<body class="preload-wrapper">
    <div id="wrapper">
        <!-- Header -->
        <?php $this->load->view('components/header'); ?>

        <!-- .page-title -->
        <div class="page-title relative">
            <div class="paralaximg" data-parallax="scroll" data-image-src="<?= base_url('assets/images/page-title/page-title-5.jpg'); ?>"></div>
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="title">Set New Password</h3>
                            <ul class="breadcrumb">
                                <li><a href="<?= base_url(); ?>">Home</a></li>
                                <li>Account</li>
                                <li>Reset Password</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.page-title -->

        <section class="flat-spacing">
            <div class="container">
                <div class="login-wrap">
                    <div class="left">
                        <div class="heading">
                            <h4>Create New Password</h4>
                            <p class="text_secondary mb-3">
                                Resetting password for <strong><?= htmlspecialchars($customer['email'] ?? ''); ?></strong>.
                            </p>
                        </div>

                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= html_escape($this->session->flashdata('error')); ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= site_url('resetpassword/' . htmlspecialchars($token)); ?>" method="post" class="form-login form-has-password">
                            <input type="hidden" name="token" value="<?= htmlspecialchars($token); ?>">
                            <div class="wrap">
                                <fieldset class="position-relative password-item">
                                    <input class="input-password" type="password" placeholder="New Password (min 8 characters)*"
                                        name="password" minlength="8" maxlength="72" autocomplete="new-password" required>
                                    <span class="toggle-password unshow">
                                        <i class="icon-eye-hide"></i>
                                    </span>
                                </fieldset>
                                <fieldset class="position-relative password-item">
                                    <input class="input-password" type="password" placeholder="Confirm New Password*"
                                        name="password_confirm" minlength="8" maxlength="72" autocomplete="new-password" required>
                                    <span class="toggle-password unshow">
                                        <i class="icon-eye-hide"></i>
                                    </span>
                                </fieldset>
                            </div>
                            <div class="button-submit">
                                <button class="tf-btn btn-onsurface w-100" type="submit">
                                    Update Password
                                </button>
                            </div>
                            <div class="text-center mt-3">
                                <a href="<?= site_url('login'); ?>" class="text-button link">
                                    <i class="icon-arrow-left me-1"></i> Back to Login
                                </a>
                            </div>
                        </form>
                    </div>

                    <div class="right">
                        <h4 class="mb_8">Password Requirements</h4>
                        <ul class="list-text type-disc gap-6 text-secondary text-body-default mb_24">
                            <li>Minimum 8 characters length</li>
                            <li>Include uppercase &amp; lowercase letters</li>
                            <li>Include numbers or special symbols</li>
                            <li>Do not reuse old passwords</li>
                        </ul>
                        <a href="<?= base_url('login'); ?>" class="tf-btn btn-white has-border">
                            Cancel &amp; Sign In
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <?php $this->load->view('components/footer'); ?>
        <?php $this->load->view('components/offcanvas'); ?>
        <?php $this->load->view('components/script'); ?>
    </div>
</body>
</html>
