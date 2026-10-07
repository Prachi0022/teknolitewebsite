<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta charset="utf-8">
    <title>Forgot Password | TeknoLite Architectural Lighting</title>
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
                            <h3 class="title">Forgot Password</h3>
                            <ul class="breadcrumb">
                                <li><a href="<?= base_url(); ?>">Home</a></li>
                                <li>Account</li>
                                <li>Forgot Password</li>
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
                            <h4>Reset Your Password</h4>
                            <p class="text_secondary mb-3">Enter your registered email address and we will send you a link to reset your password.</p>
                        </div>

                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success">
                                <?= html_escape($this->session->flashdata('success')); ?>
                                <?php if ($this->session->flashdata('reset_url')): ?>
                                    <div class="mt-2 pt-2 border-top">
                                        <strong>Reset Link:</strong> <a href="<?= $this->session->flashdata('reset_url'); ?>" class="link text-decoration-underline fw-bold"><?= $this->session->flashdata('reset_url'); ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= html_escape($this->session->flashdata('error')); ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= site_url('forgetpassword'); ?>" method="post" class="form-login">
                            <div class="wrap">
                                <fieldset>
                                    <input type="email" placeholder="Registered email address*" name="email"
                                        maxlength="150" autocomplete="email" aria-required="true" required>
                                </fieldset>
                            </div>
                            <div class="button-submit">
                                <button class="tf-btn btn-onsurface w-100" type="submit">
                                    Send Reset Link
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
                        <h4 class="mb_8">Remember your password?</h4>
                        <p class="text-secondary text-body-default mb_24">
                            If you already remember your password or have retrieved it, you can return to the login screen and sign in to your TeknoLite account.
                        </p>
                        <a href="<?= base_url('login'); ?>" class="tf-btn btn-onsurface">
                            Sign In
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
