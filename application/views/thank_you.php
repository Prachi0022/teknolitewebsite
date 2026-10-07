<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
	<title>Thank You - Teknolite</title>
	<?php $this->load->view('components/head'); ?>
	
	<!-- Custom styles for Thank You page -->
	<style>
		.thank-you-section {
			min-height: calc(100vh - 120px);
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 100px 20px;
			background: radial-gradient(circle at 10% 20%, rgba(59, 130, 246, 0.05) 0%, rgba(30, 58, 138, 0.02) 90%), #ffffff;
			position: relative;
			overflow: hidden;
		}

		/* Decorative glowing background blobs */
		.bg-glow-1 {
			position: absolute;
			width: 300px;
			height: 300px;
			background: rgba(13, 110, 253, 0.08);
			filter: blur(80px);
			border-radius: 50%;
			top: -50px;
			right: -50px;
			z-index: 1;
		}

		.bg-glow-2 {
			position: absolute;
			width: 400px;
			height: 400px;
			background: rgba(30, 58, 138, 0.05);
			filter: blur(100px);
			border-radius: 50%;
			bottom: -100px;
			left: -100px;
			z-index: 1;
		}

		.thank-you-card {
			background: rgba(255, 255, 255, 0.85);
			backdrop-filter: blur(16px);
			-webkit-backdrop-filter: blur(16px);
			border: 1px solid rgba(255, 255, 255, 0.6);
			border-radius: 24px;
			padding: 60px 40px;
			box-shadow: 0 20px 50px rgba(0, 0, 0, 0.04), 0 4px 12px rgba(13, 110, 253, 0.02);
			max-width: 650px;
			width: 100%;
			text-align: center;
			position: relative;
			z-index: 2;
			transform: translateY(20px);
			opacity: 0;
			animation: fadeInUpCard 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
		}

		@keyframes fadeInUpCard {
			to {
				transform: translateY(0);
				opacity: 1;
			}
		}

		/* Animated checkmark circle */
		.checkmark-wrapper {
			width: 90px;
			height: 90px;
			margin: 0 auto 30px;
			position: relative;
		}

		.checkmark-svg {
			width: 90px;
			height: 90px;
			border-radius: 50%;
			display: block;
			stroke-width: 3;
			stroke: #0d6efd;
			stroke-miterlimit: 10;
			box-shadow: inset 0px 0px 0px rgba(13, 110, 253, 0.1);
			animation: fillCheck 0.4s ease-in-out 0.4s forwards, scaleCheck 0.3s ease-in-out 0.9s;
		}

		.checkmark-circle {
			stroke-dasharray: 166;
			stroke-dashoffset: 166;
			stroke-width: 3;
			stroke-miterlimit: 10;
			stroke: #0d6efd;
			fill: none;
			animation: strokeCircle 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
		}

		.checkmark-check {
			transform-origin: 50% 50%;
			stroke-dasharray: 48;
			stroke-dashoffset: 48;
			animation: strokeCheck 0.35s cubic-bezier(0.65, 0, 0.45, 1) 0.55s forwards;
		}

		@keyframes strokeCircle {
			100% {
				stroke-dashoffset: 0;
			}
		}

		@keyframes strokeCheck {
			100% {
				stroke-dashoffset: 0;
			}
		}

		@keyframes scaleCheck {
			0%, 100% {
				transform: none;
			}
			50% {
				transform: scale3d(1.1, 1.1, 1);
			}
		}

		@keyframes fillCheck {
			100% {
				box-shadow: inset 0px 0px 0px 45px rgba(13, 110, 253, 0.08);
			}
		}

		.thank-you-title {
			font-size: clamp(28px, 4vw, 38px);
			font-weight: 800;
			color: #1e3a8a;
			margin-bottom: 15px;
			letter-spacing: -0.5px;
			line-height: 1.2;
		}

		.thank-you-text {
			font-size: 16px;
			color: #4b5563;
			line-height: 1.6;
			margin-bottom: 35px;
		}

		.action-divider {
			height: 1px;
			background: linear-gradient(to right, rgba(229, 231, 235, 0.1), rgba(229, 231, 235, 1), rgba(229, 231, 235, 0.1));
			margin: 30px 0;
		}

		.catalog-action-box {
			background: rgba(13, 110, 253, 0.04);
			border: 1px dashed rgba(13, 110, 253, 0.25);
			border-radius: 16px;
			padding: 24px;
			margin-bottom: 30px;
			transition: all 0.3s ease;
		}

		.catalog-action-box:hover {
			background: rgba(13, 110, 253, 0.07);
			border-color: rgba(13, 110, 253, 0.4);
		}

		.catalog-title {
			font-size: 16px;
			font-weight: 700;
			color: #1e3a8a;
			margin-bottom: 8px;
			display: flex;
			align-items: center;
			justify-content: center;
			gap: 8px;
		}

		.catalog-desc {
			font-size: 14px;
			color: #555;
			margin-bottom: 16px;
		}

		/* Buttons styling */
		.ty-btn-group {
			display: flex;
			gap: 15px;
			justify-content: center;
			flex-wrap: wrap;
		}

		.ty-btn {
			padding: 14px 28px;
			border-radius: 10px;
			font-size: 15px;
			font-weight: 600;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			gap: 10px;
			transition: all 0.25s ease;
			text-decoration: none;
			cursor: pointer;
		}

		.ty-btn-primary {
			background: #0d6efd;
			color: #ffffff !important;
			border: 2px solid #0d6efd;
			box-shadow: 0 4px 14px rgba(13, 110, 253, 0.3);
		}

		.ty-btn-primary:hover {
			background: #1e3a8a;
			border-color: #1e3a8a;
			box-shadow: 0 6px 20px rgba(30, 58, 138, 0.4);
			transform: translateY(-2px);
		}

		.ty-btn-secondary {
			background: transparent;
			color: #1e3a8a !important;
			border: 2px solid #e2e8f0;
		}

		.ty-btn-secondary:hover {
			background: #f8fafc;
			border-color: #cbd5e1;
			color: #0d6efd !important;
			transform: translateY(-2px);
		}

		.social-connect {
			margin-top: 25px;
			display: flex;
			justify-content: center;
			align-items: center;
			gap: 15px;
		}

		.social-connect span {
			font-size: 14px;
			color: #6b7280;
			font-weight: 500;
		}

		.social-link {
			width: 36px;
			height: 36px;
			border-radius: 50%;
			background: #f1f5f9;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			color: #4b5563;
			font-size: 16px;
			transition: all 0.2s ease;
		}

		.social-link:hover {
			background: #0d6efd;
			color: #fff;
			transform: scale(1.1);
		}

		/* Responsive tweaks */
		@media (max-width: 767px) {
			.thank-you-section {
				padding: 80px 15px;
			}
			.thank-you-card {
				padding: 40px 24px;
			}
			.ty-btn {
				width: 100%;
			}
		}

		@media (max-width: 480px) {
			.thank-you-card {
				padding: 30px 16px;
			}
			.catalog-action-box {
				padding: 16px;
				margin-bottom: 20px;
			}
			.thank-you-title {
				font-size: 24px;
			}
		}
	</style>
</head>



<div id="wrapper">

	<?php $this->load->view('components/header'); ?>

	<main class="thank-you-section">
		<div class="bg-glow-1"></div>
		<div class="bg-glow-2"></div>

		<div class="thank-you-card">
			<!-- Success Animation -->
			<div class="checkmark-wrapper">
				<svg class="checkmark-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
					<circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none" />
					<path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
				</svg>
			</div>

			<!-- Dynamic Message Content -->
			<?php if ($type === 'catalog'): ?>
				<h1 class="thank-you-title">Catalog Request Success!</h1>
				<p class="thank-you-text">
					Thank you for your interest in Teknolite. We have sent the download link for our latest catalog copy directly to your email (please check your spam/junk folder if you do not see it in a few minutes).
				</p>

				<!-- Direct Download box -->
				<div class="catalog-action-box">
					<div class="catalog-title">
						<i class="fa-solid fa-file-pdf text-danger"></i>
						<span>Instant Catalogue Download</span>
					</div>
					<p class="catalog-desc">You can also download the PDF document directly to your device right now.</p>
					<a href="<?php echo base_url('assets/Teknolite_catalogue.pdf'); ?>" target="_blank" class="ty-btn ty-btn-primary">
						<i class="fa-solid fa-download"></i> Download Catalogue (PDF)
					</a>
				</div>

			<?php elseif ($type === 'enquiry'): ?>
				<h1 class="thank-you-title">Enquiry Received!</h1>
				<p class="thank-you-text">
					Thank you for reaching out. We have successfully received your project enquiry details. Our team of expert lighting consultants will review your requirements and contact you within 24 hours to assist with your project needs.
				</p>

			<?php else: ?>
				<h1 class="thank-you-title">Thank You!</h1>
				<p class="thank-you-text">
					Your message has been successfully submitted. We appreciate you contacting us and will get back to you as soon as possible.
				</p>
			<?php endif; ?>

			<div class="action-divider"></div>

			<!-- Navigation controls -->
			<div class="ty-btn-group">
				<a href="<?php echo base_url(); ?>" class="ty-btn ty-btn-secondary">
					<i class="fa-solid fa-arrow-left"></i> Back to Homepage
				</a>
				<?php $tyWhatsapp = clean_phone_number(get_setting('contact_whatsapp', '917021247619')); ?>
				<a href="https://wa.me/<?= html_escape($tyWhatsapp); ?>" target="_blank" class="ty-btn ty-btn-primary" style="background-color: #25D366; border-color: #25D366;">
					<i class="fa-brands fa-whatsapp"></i> Chat on WhatsApp
				</a>
			</div>

			<!-- Social connect links -->
			<div class="social-connect">
				<span>Connect with us:</span>
				<?php if ($tyFb = get_setting('social_facebook', 'https://www.facebook.com/TeknoliteIndia')): ?>
				<a href="<?= html_escape($tyFb); ?>" target="_blank" class="social-link" title="Facebook">
					<i class="fab fa-facebook-f"></i>
				</a>
				<?php endif; ?>
				<?php if ($tyInsta = get_setting('social_instagram', 'https://www.instagram.com/teknolite_india')): ?>
				<a href="<?= html_escape($tyInsta); ?>" target="_blank" class="social-link" title="Instagram">
					<i class="fab fa-instagram"></i>
				</a>
				<?php endif; ?>
				<?php if ($tyIn = get_setting('social_linkedin', 'https://www.linkedin.com/company/teknovision-pvt-ltd')): ?>
				<a href="<?= html_escape($tyIn); ?>" target="_blank" class="social-link" title="LinkedIn">
					<i class="fab fa-linkedin-in"></i>
				</a>
				<?php endif; ?>
				<?php if ($tyTw = get_setting('social_twitter', '')): ?>
				<a href="<?= html_escape($tyTw); ?>" target="_blank" class="social-link" title="Twitter / X">
					<i class="fab fa-x-twitter"></i>
				</a>
				<?php endif; ?>
				<?php if ($tyYt = get_setting('social_youtube', '')): ?>
				<a href="<?= html_escape($tyYt); ?>" target="_blank" class="social-link" title="YouTube">
					<i class="fab fa-youtube"></i>
				</a>
				<?php endif; ?>
			</div>
		</div>
	</main>

	<?php $this->load->view('components/footer'); ?>

</div>

<?php $this->load->view('components/offcanvas'); ?>

<!-- Include modals on Thank You page as well so header/menu links don't break -->
<!-- enquiry form modal -->
<div class="modal fade modal-search" id="enquiryForm">
	<div class="modal-dialog modal-dialog-centered justify-content-center">
		<div class="modal-content">
			<div class="d-flex justify-content-between align-items-center">
				<h5>Enquiry Form</h5>
				<span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
			</div>
			<form class="form-enquiry" id="formEnquiry" action="#" method="post">
				<div class="row">
					<div class="col-md-6 col-12 mb-3">
						<label for="enquiry_name" class="form-label">Name <span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="enquiry_name" name="name" placeholder="Your Name" maxlength="100" pattern="[A-Za-z .'-]{2,100}" autocomplete="name" required>
					</div>
					<div class="col-md-6 col-12 mb-3">
						<label for="enquiry_email" class="form-label">Email <span class="text-danger">*</span></label>
						<input type="email" class="form-control" id="enquiry_email" name="email" placeholder="Your Email" maxlength="150" autocomplete="email" required>
					</div>
					<div class="col-md-6 col-12 mb-3">
						<label for="enquiry_number" class="form-label">Number</label>
						<input type="tel" class="form-control" id="enquiry_number" name="number" placeholder="Your Phone Number" maxlength="20" pattern="[0-9+() .-]{7,20}" autocomplete="tel" required>
					</div>
					<div class="col-md-6 col-12 mb-3">
						<label for="enquiry_are_you" class="form-label">Are you? <span class="text-danger">*</span></label>
						<div class="tf-select">
							<select class="form-control" id="enquiry_are_you" name="are_you" style="padding: 11px 16px; -webkit-appearance: none; appearance: none; background-color: transparent;" required>
								<option value="" disabled selected style="background: #fff; color: #000;">Select Option</option>
								<option value="Individual" style="background: #fff; color: #000;">Individual</option>
								<option value="Architect" style="background: #fff; color: #000;">Architect</option>
								<option value="Builder" style="background: #fff; color: #000;">Builder</option>
								<option value="Other" style="background: #fff; color: #000;">Other</option>
							</select>
						</div>
					</div>
					<div class="col-12 mb-3">
						<label for="enquiry_looking_for" class="form-label">Looking For? <span class="text-danger">*</span></label>
						<div class="tf-select">
							<select class="form-control" id="enquiry_looking_for" name="looking_for" style="padding: 11px 16px; -webkit-appearance: none; appearance: none; background-color: transparent;" required>
								<option value="" disabled selected style="background: #fff; color: #000;">Select Option</option>
								<option value="Product Enquiry" style="background: #fff; color: #000;">Product Enquiry</option>
								<option value="Catalogue" style="background: #fff; color: #000;">Catalogue</option>
								<option value="Dealership" style="background: #fff; color: #000;">Dealership</option>
								<option value="Other" style="background: #fff; color: #000;">Other</option>
							</select>
						</div>
					</div>
					<div class="col-12 mb-3">
						<label for="enquiry_message" class="form-label">Message <span class="text-danger">*</span></label>
						<textarea class="form-control" id="enquiry_message" name="message" rows="4" minlength="10" maxlength="2000" placeholder="Type your enquiry here..." required></textarea>
					</div>
				</div>
				<div class="mb-3">
					<div id="enquiry-form-response" class="alert d-none" role="alert"></div>
				</div>
				<div class="d-flex gap-2">
					<button class="tf-btn btn-primary w-100" id="btnSubmitEnquiry" type="submit">
						<span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true" style="width: 1rem; height: 1rem; border-width: 0.15em; display: inline-block;"></span>
						<span class="btn-text">Enquiry Now</span>
					</button>
					<a href="tel:+917021247619" class="tf-btn btn-primary w-100">
						Call Us
					</a>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- download catalog modal -->
<div class="modal fade modal-search" id="downloadCatalogModal">
	<div class="modal-dialog modal-dialog-centered justify-content-center">
		<div class="modal-content">
			<div class="d-flex justify-content-between align-items-center mb-3">
				<h5 class="header">Download Catalogue</h5>
				<span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
			</div>
			<form id="catalogForm" action="#" method="post">
				<div class="row">
					<div class="col-md-6 col-12 mb-3">
						<label for="catalog_name" class="form-label">Name <span class="text-danger">*</span></label>
						<input type="text" class="form-control" id="catalog_name" name="name" placeholder="Your Name" maxlength="100" pattern="[A-Za-z .'-]{2,100}" autocomplete="name" required>
					</div>
					<div class="col-md-6 col-12 mb-3">
						<label for="catalog_email" class="form-label">Email <span class="text-danger">*</span></label>
						<input type="email" class="form-control" id="catalog_email" name="email" placeholder="Your Email" maxlength="150" autocomplete="email" required>
					</div>
					<div class="col-md-6 col-12 mb-3">
						<label for="catalog_phone" class="form-label">Phone</label>
						<input type="tel" class="form-control" id="catalog_phone" name="phone" placeholder="Your Phone Number" maxlength="20" pattern="[0-9+() .-]{7,20}" autocomplete="tel" required>
					</div>
					<div class="col-md-6 col-12 mb-3">
						<label for="catalog_subject" class="form-label">Subject</label>
						<input type="text" class="form-control" id="catalog_subject" name="subject" placeholder="Subject of interest" maxlength="150" required>
					</div>
					<div class="col-12 mb-3">
						<label for="catalog_message" class="form-label">Message <span class="text-danger">*</span></label>
						<textarea class="form-control" id="catalog_message" name="message" rows="4" minlength="10" maxlength="2000" placeholder="How can we help you?" required></textarea>
					</div>
				</div>
				<div class="mb-3">
					<div id="catalog-form-response" class="alert d-none" role="alert"></div>
				</div>
				<div class="d-flex gap-2">
					<button class="tf-btn btn-primary w-100" id="btnSubmitCatalog" type="submit">
						<span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true" style="width: 1rem; height: 1rem; border-width: 0.15em; display: inline-block;"></span>
						<span class="btn-text">Send Catalogue</span>
					</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php $this->load->view('components/script'); ?>

</body>

</html>
