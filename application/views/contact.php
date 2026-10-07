<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>

	<meta charset="utf-8">

	<title>Contact Us | TeknoLite Lighting Solutions</title>

	<meta name="description"
		content="Contact TeknoLite for LED lighting product enquiries, project requirements, support and business opportunities.">

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


	<?php $this->load->view('components/head'); ?>


	<link rel="stylesheet" href="<?= base_url('assets/css/contact.css'); ?>">

</head>


<body class="preload-wrapper">


	<!-- SCROLL TOP -->

	<button id="scroll-top">

		<svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">

			<path
				d="M3 11.9175L12 2.91748L21 11.9175H16.5V20.1675C16.5 20.3664 16.421 20.5572 16.2803 20.6978C16.1397 20.8385 15.9489 20.9175 15.75 20.9175H8.25C8.05109 20.9175 7.86032 20.8385 7.71967 20.6978C7.57902 20.5572 7.5 20.3664 7.5 20.1675V11.9175H3Z"
				stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
			</path>

		</svg>

	</button>



	<!-- PRELOADER -->

	<div class="preload preload-container">

		<div class="preload-logo">

			<div class="spinner"></div>

		</div>

	</div>



	<!-- WRAPPER -->

	<div id="wrapper">


		<!-- HEADER -->

		<?php $this->load->view('components/header'); ?>



		<!-- =====================================================
             PAGE BANNER
        ====================================================== -->

		<div class="page-title relative">

			<div class="paralaximg" data-parallax="scroll"
				data-image-src="<?= base_url('assets/images/page-title/page-title-1.jpg'); ?>">
			</div>


			<div class="content">

				<div class="container">

					<div class="row">

						<div class="col-12">


							<h3 class="title">
								Contact Us
							</h3>


							<ul class="breadcrumb">

								<li>

									<a href="<?= base_url(); ?>">
										Home
									</a>

								</li>


								<li>
									Contact Us
								</li>

							</ul>


						</div>

					</div>

				</div>

			</div>

		</div>
		<!-- /.page-title -->



		<!-- =====================================================
             MAIN CONTENT
        ====================================================== -->

		<div class="main-content">



			<!-- =================================================
                 INTRO
            ================================================== -->

			<section class="flat-spacing teknolite-contact-intro">

				<div class="container">


					<div class="heading-section text-center">

						<span class="text-caption-1">
							GET IN TOUCH
						</span>


						<h3>
							Let’s Talk About Your Lighting Requirement
						</h3>


						<p class="text_secondary">

							Whether you need product information,
							project support, quotations or business
							assistance, our team is ready to help.

						</p>

					</div>


				</div>

			</section>



			<!-- =================================================
                 CONTACT DETAILS + FORM
            ================================================== -->

			<section class="teknolite-contact-section">

				<div class="container">


					<div class="contact-us-content">


						<div class="row">


							<!-- =====================================
                                 CONTACT INFORMATION
                            ====================================== -->

							<div class="col-lg-4 mb-lg-30">


								<div class="teknolite-contact-info">


									<span class="text-caption-1">
										CONTACT INFORMATION
									</span>


									<h4 class="mb_30">

										Connect With TeknoLite

									</h4>



									<!-- ADDRESS -->
									<div class="teknolite-contact-item">
										<div class="contact-item-icon">
											<i class="fa fa-map-marker"></i>
										</div>

										<div>
											<h6>Location</h6>

											<p class="text-body-default">
												<?php 
            $cAddress = get_setting('address', 'Plot No. 42, Marol Industrial Area, Andheri East');
            $cCity = get_setting('city', 'Mumbai');
            $cState = get_setting('state', 'Maharashtra');
            $cZip = get_setting('zipcode', '400059');
            $cCountry = get_setting('country', 'India');

            $locationParts = array_filter([
                $cAddress,
                $cCity,
                $cState,
                $cZip,
                $cCountry
            ]);

            echo html_escape(implode(', ', $locationParts));
            ?>
											</p>
										</div>
									</div>

									<!-- PHONE -->
									<?php $cPhone = get_setting('contact_phone', '+91 7021247619'); ?>
									<div class="teknolite-contact-item">
										<div class="contact-item-icon">
											<i class="icon icon-phone"></i>
										</div>
										<div>
											<h6>Phone</h6>
											<a href="tel:<?= html_escape(clean_phone_number($cPhone)); ?>"
												class="text-body-default link">
												<?= html_escape($cPhone); ?>
											</a>
										</div>
									</div>

									<!-- EMAIL -->
									<?php 
									$cEmail = get_setting('contact_email', 'teknolite@gmail.com');
									$cEmailSupport = get_setting('contact_email_support', '');
									?>
									<div class="teknolite-contact-item">
										<div class="contact-item-icon">
											<i class="icon icon-envelope"></i>
										</div>
										<div>
											<h6>Email</h6>
											<a href="mailto:<?= html_escape($cEmail); ?>"
												class="text-body-default link d-block">
												<?= html_escape($cEmail); ?>
											</a>
											<?php if (!empty($cEmailSupport) && $cEmailSupport !== $cEmail): ?>
											<a href="mailto:<?= html_escape($cEmailSupport); ?>"
												class="text-body-default link d-block text-muted"
												style="font-size: 13px;">
												<?= html_escape($cEmailSupport); ?> (Support)
											</a>
											<?php endif; ?>
										</div>
									</div>

									<!-- WEBSITE -->
									<?php $cWebsite = get_setting('contact_website', 'https://teknolite.in'); ?>
									<div class="teknolite-contact-item">
										<div class="contact-item-icon">
											<i class="icon icon-globe"></i>
										</div>
										<div>
											<h6>Website</h6>
											<a href="<?= html_escape($cWebsite); ?>" target="_blank" rel="noopener"
												class="text-body-default link">
												<?= html_escape(preg_replace('#^https?://#', '', rtrim($cWebsite, '/'))); ?>
											</a>
										</div>
									</div>

									<!-- WORKING HOURS -->
									<?php if ($cHours = get_setting('contact_working_hours', '')): ?>
									<div class="teknolite-contact-item">
										<div class="contact-item-icon">
											<i class="icon icon-clock"></i>
										</div>
										<div>
											<h6>Working Hours</h6>
											<p class="text-body-default mb-0">
												<?= html_escape($cHours); ?>
											</p>
										</div>
									</div>
									<?php endif; ?>

									<!-- WHATSAPP -->
									<?php $cWhatsapp = clean_phone_number(get_setting('contact_whatsapp', '917021247619')); ?>
									<div class="teknolite-contact-whatsapp">
										<a href="https://wa.me/<?= html_escape($cWhatsapp); ?>?text=<?= urlencode('Hello TeknoLite, I would like to discuss a lighting requirement.'); ?>"
											target="_blank" rel="noopener" class="tf-btn btn-onsurface w-full">
											WhatsApp Enquiry
											<i class="icon-arrow-up-right"></i>
										</a>
									</div>

									<!-- SOCIAL MEDIA -->
									<div class="teknolite-social">
										<h6>Follow Us</h6>
										<ul class="tf-social-icon style-1">
											<?php if ($cFacebook = get_setting('social_facebook', 'https://www.facebook.com/TeknoliteIndia')): ?>
											<li>
												<a href="<?= html_escape($cFacebook); ?>" target="_blank" rel="noopener"
													class="social-facebook" aria-label="Facebook">
													<i class="icon icon-facebook"></i>
												</a>
											</li>
											<?php endif; ?>

											<?php if ($cInstagram = get_setting('social_instagram', 'https://www.instagram.com/teknolite_india')): ?>
											<li>
												<a href="<?= html_escape($cInstagram); ?>" target="_blank"
													rel="noopener" class="social-instagram" aria-label="Instagram">
													<i class="icon icon-instagram"></i>
												</a>
											</li>
											<?php endif; ?>

											<?php if ($cLinkedin = get_setting('social_linkedin', 'https://www.linkedin.com/company/teknovision-pvt-ltd')): ?>
											<li>
												<a href="<?= html_escape($cLinkedin); ?>" target="_blank" rel="noopener"
													aria-label="LinkedIn">
													<i class="icon icon-linkedin"></i>
												</a>
											</li>
											<?php endif; ?>

											<?php if ($cTwitter = get_setting('social_twitter', '')): ?>
											<li>
												<a href="<?= html_escape($cTwitter); ?>" target="_blank" rel="noopener"
													aria-label="Twitter / X">
													<i class="icon icon-twitter"></i>
												</a>
											</li>
											<?php endif; ?>

											<?php if ($cYoutube = get_setting('social_youtube', '')): ?>
											<li>
												<a href="<?= html_escape($cYoutube); ?>" target="_blank" rel="noopener"
													aria-label="YouTube">
													<i class="icon icon-youtube"></i>
												</a>
											</li>
											<?php endif; ?>

											<?php if ($cPinterest = get_setting('social_pinterest', '')): ?>
											<li>
												<a href="<?= html_escape($cPinterest); ?>" target="_blank"
													rel="noopener" aria-label="Pinterest">
													<i class="icon icon-pinterest"></i>
												</a>
											</li>
											<?php endif; ?>
										</ul>
									</div>


								</div>

							</div>



							<!-- =====================================
                                 CONTACT FORM
                            ====================================== -->

							<div class="col-lg-7 offset-lg-1">


								<div class="teknolite-contact-form-wrap">


									<span class="text-caption-1">
										SEND AN ENQUIRY
									</span>


									<h4 class="mb_7">

										How Can We Help You?

									</h4>


									<p class="text_secondary mb_24">

										Fill in the form and our team will
										get in touch regarding your requirement.

									</p>



									<!--
                                        Change contact/submit according
                                        to your actual controller route.
                                    -->
									<?php if ($this->session->flashdata('contact_success')): ?>
									<div class="alert alert-success mb-4">
										<?= $this->session->flashdata('contact_success'); ?>
									</div>
									<?php endif; ?>

									<?php if ($this->session->flashdata('contact_error')): ?>
									<div class="alert alert-danger mb-4">
										<?= $this->session->flashdata('contact_error'); ?>
									</div>
									<?php endif; ?>


									<form id="contactForm" action="<?= site_url('welcome/submit'); ?>" method="post"
										class="form-leave-comment">

										<div class="wrap">

											<!-- NAME + MOBILE -->
											<div class="cols">

												<fieldset>
													<label for="contactName">
														Name *
													</label>

													<input type="text" id="contactName" name="name"
														placeholder="Enter your name" maxlength="100"
														pattern="[A-Za-z .'-]{2,100}" autocomplete="name" required>
												</fieldset>


												<fieldset>
													<label for="contactMobile">
														Mobile *
													</label>

													<input type="tel" id="contactMobile" name="mobile"
														placeholder="Enter mobile number" inputmode="numeric"
														maxlength="20" pattern="[0-9+() .-]{7,20}" autocomplete="tel"
														required>
												</fieldset>

											</div>


											<!-- EMAIL + COMPANY -->
											<div class="cols">

												<fieldset>
													<label for="contactEmail">
														Email *
													</label>

													<input type="email" id="contactEmail" name="email"
														placeholder="Enter email address" maxlength="150"
														autocomplete="email" required>
												</fieldset>


												<fieldset>
													<label for="contactCompany">
														Company
													</label>

													<input type="text" id="contactCompany" name="company"
														placeholder="Company name" maxlength="150">
												</fieldset>

											</div>


											<!-- SUBJECT -->
											<fieldset>

												<label for="contactSubject">
													Enquiry Type *
												</label>

												<select id="contactSubject" name="subject" required>

													<option value="">
														Select enquiry type
													</option>

													<option value="Product Availability">
														Product Availability
													</option>

													<option value="Bulk Order Enquiry">
														Bulk Order Enquiry
													</option>

													<option value="Project Consultation">
														Project Consultation
													</option>

													<option value="Custom Lighting Solution">
														Custom Lighting Solution
													</option>

													<option value="Architect / Interior Designer Enquiry">
														Architect / Interior Designer Enquiry
													</option>

													<option value="Dealer / Partnership Enquiry">
														Dealer / Partnership Enquiry
													</option>

													<option value="Catalogue / Brochure Request">
														Catalogue / Brochure Request
													</option>

													<option value="Experience Centre Appointment">
														Experience Centre Appointment
													</option>

													<option value="Existing Order / Support">
														Existing Order / Support
													</option>

													<option value="General Enquiry">
														General Enquiry
													</option>

												</select>

											</fieldset>


											<!-- MESSAGE -->
											<fieldset>

												<label for="contactMessage">
													Message *
												</label>

												<textarea id="contactMessage" name="message" rows="5"
													placeholder="Tell us about your lighting requirement..."
													minlength="10" maxlength="2000" required></textarea>

											</fieldset>

										</div>


										<!-- SUBMIT -->
										<div class="button-submit send-wrap">

											<button class="tf-btn btn-onsurface" type="submit">

												Send Enquiry

												<i class="icon-arrow-up-right"></i>

											</button>

										</div>

									</form>

								</div>


							</div>


						</div>


					</div>


				</div>

			</section>



			<!-- =================================================
                 MAP
            ================================================== -->

			<section class="teknolite-map-section">


				<div class="container">


					<div class="teknolite-map-heading">


						<div>

							<span class="text-caption-1">
								OUR LOCATION
							</span>

							<h3>
								Visit Our Office
							</h3>

						</div>


						<p class="text_secondary">

							Find us on Google Maps for directions
							to our office.

						</p>


					</div>


				</div>



				<div class="teknolite-google-map">
					<?php
						$mapSetting = function_exists('get_setting') ? get_setting('google_map_iframe', '') : '';
						if (!empty($mapSetting)) {
							if (preg_match('/src=[\'"]([^\'"]+)[\'"]/', $mapSetting, $matches)) {
								$mapSrc = $matches[1];
							} else {
								$mapSrc = $mapSetting;
							}
						} else {
							$fullAddress = function_exists('get_setting') ? get_setting('address', 'Plot No. 42, Marol Industrial Area, Andheri East, Mumbai') : 'Plot No. 42, Marol Industrial Area, Andheri East, Mumbai';
							$mapSrc = 'https://maps.google.com/maps?q=' . urlencode($fullAddress) . '&output=embed';
						}
					?>
					<iframe src="<?= htmlspecialchars($mapSrc); ?>" width="100%"
						height="500" style="border:0;" allowfullscreen="" loading="lazy"
						referrerpolicy="no-referrer-when-downgrade" title="TeknoLite Office Location">
					</iframe>
				</div>


			</section>



			<!-- =================================================
                 BOTTOM CTA
            ================================================== -->

			<section class="flat-spacing teknolite-contact-cta">


				<div class="container">


					<div class="teknolite-contact-cta-box">


						<div>


							<span class="text-caption-1">
								NEED LIGHTING FOR A PROJECT?
							</span>


							<h3>
								Let’s Find the Right Lighting Solution
							</h3>


							<p>

								Explore our products or speak with our
								team about your project requirements.

							</p>


						</div>



						<div class="teknolite-contact-cta-buttons">


							<a href="<?= base_url('product'); ?>" class="tf-btn btn-onsurface">

								Explore Products

								<i class="icon-arrow-up-right"></i>

							</a>


							<a href="https://wa.me/<?= html_escape(clean_phone_number(get_setting('contact_whatsapp', '917021247619'))); ?>"
								target="_blank" rel="noopener" class="tf-btn btn-white has-border">
								WhatsApp Us
								<i class="icon-arrow-up-right"></i>
							</a>


						</div>


					</div>


				</div>


			</section>


		</div>
		<!-- /main-content -->



		<!-- FOOTER -->

		<?php $this->load->view('components/footer'); ?>


	</div>
	<!-- /wrapper -->



	<?php $this->load->view('components/offcanvas'); ?>



	<?php $this->load->view('components/script'); ?>


</body>

</html>
