<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>

	<meta charset="utf-8">

	<title>About Us | TeknoLite - Premium LED Lighting Solutions</title>

	<meta name="description"
		content="Learn about TeknoLite, our lighting expertise, capabilities, values and commitment to quality LED lighting solutions.">

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<?php $this->load->view('components/head')?>


</head>


<body class="preload-wrapper">


	<!-- ==================================================
         SCROLL TOP
    =================================================== -->

	<button id="scroll-top">

		<svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">

			<path
				d="M3 11.9175L12 2.91748L21 11.9175H16.5V20.1675C16.5 20.3664 16.421 20.5572 16.2803 20.6978C16.1397 20.8385 15.9489 20.9175 15.75 20.9175H8.25C8.05109 20.9175 7.86032 20.8385 7.71967 20.6978C7.57902 20.5572 7.5 20.3664 7.5 20.1675V11.9175H3Z"
				stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />

		</svg>

	</button>


	<!-- ==================================================
         PRELOADER
    =================================================== -->

	<div class="preload preload-container">

		<div class="preload-logo">

			<div class="spinner"></div>

		</div>

	</div>


	<div id="wrapper">


		<!-- ==================================================
             HEADER
        =================================================== -->

		<?php $this->load->view('components/header')?>



		<!-- ==================================================
             1. INNER BANNER
        =================================================== -->

		<div class="page-title relative">

			<div class="paralaximg" data-parallax="scroll" data-image-src="assets/images/page-title/page-title-2.jpg">
			</div>

			<div class="content">

				<div class="container">

					<div class="row">

						<div class="col-12">

							<h3 class="title">
								About Us
							</h3>

							<ul class="breadcrumb">

								<li>
									<a href="<?= base_url(); ?>">
										Home
									</a>
								</li>

								<li>
									About Us
								</li>

							</ul>

						</div>

					</div>

				</div>

			</div>

		</div>



		<!-- ==================================================
             2. ABOUT COMPANY
        =================================================== -->
				<style>
			/* === About Redesign === */
			.about-section {
				padding: 100px 0;
				background: linear-gradient(180deg, #ffffff, #fafafa);
			}

			.about-tag {
				display: inline-block;
				font-size: 11px;
				font-weight: 700;
				letter-spacing: 0.18em;
				text-transform: uppercase;
				color: #0d6efd;
				background: rgba(224, 123, 26, 0.09);
				border: 1px solid rgba(224, 123, 26, 0.22);
				border-radius: 50px;
				padding: 5px 16px;
				margin-bottom: 22px;
			}

			.about-new-title {
				font-size: clamp(28px, 4vw, 48px);
				font-weight: 600;
				line-height: 1.25;
				color: #111;
				letter-spacing: -0.5px;
				margin-bottom: 50px;
			}

			.about-new-title span {
				color: #999;
				font-weight: 400;
			}

			.about-new-desc {
				font-size: 15px;
				line-height: 1.85;
				color: #666;
				margin-bottom: 0;
			}

			.about-new-desc strong {
				color: #111;
			}

			.about-new-img-wrap {
				border-radius: 10px;
				width: 100%;
				height: 100%;
				min-height: 100%;
				overflow: hidden;
				position: relative;
				box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
			}

			@media (max-width: 991px) {
				.about-new-img-wrap {
					height: 350px;
					min-height: auto;
				}
			}

			.about-new-img-wrap img,
			.about-new-img-wrap video {
				width: 100%;
				height: 140%;
				object-fit: cover;
				position: absolute;
				top: -20%;
				left: 0;
				will-change: transform;
				transition: transform 0.1s ease-out;
			}

			.about-stats {
				display: flex;
				justify-content: space-between;
				align-items: center;
				margin-top: 60px;
				padding-top: 40px;
				border-top: 1px solid #e8e8e8;
			}

			.about-stat {
				text-align: center;
				flex: 1;
			}

			.about-stat:not(:last-child) {
				border-right: 1px solid #ececec;
			}

			.about-stat h3 {
				font-size: 42px;
				font-weight: 700;
				color: #0d6efd;
				margin-bottom: 8px;
			}

			.about-stat p {
				margin: 0;
				color: #666;
				font-size: 13px;
				text-transform: uppercase;
				letter-spacing: 1px;
				font-weight: 500;
			}

			@media (max-width: 991px) {
				.about-section {
					padding: 60px 0;
				}

				.about-new-title {
					margin-bottom: 30px;
				}

				.about-stats {
					margin-top: 40px;
					padding-top: 30px;
				}
			}

			@media (max-width: 767px) {
				.about-stats {
					flex-direction: column;
					gap: 30px;
				}

				.about-stat {
					width: 100%;
				}

				.about-stat:not(:last-child) {
					border-right: none;
					border-bottom: 1px solid #ececec;
					padding-bottom: 20px;
				}
			}

			/* === Who We Serve === */
			.who-we-serve-section {
				padding: 90px 0;
				background: linear-gradient(160deg, #0a0a0a 0%, #111827 55%, #0d0d0d 100%);
				position: relative;
				overflow: hidden;
			}

			.who-we-serve-section::before {
				content: '';
				position: absolute;
				top: 0;
				left: 10%;
				right: 10%;
				height: 1px;
				background: linear-gradient(90deg, transparent, rgba(224, 123, 26, 0.5), transparent);
			}

			.who-we-serve-section::after {
				content: '';
				position: absolute;
				inset: 0;
				background: radial-gradient(ellipse at 50% 0%, rgba(224, 123, 26, 0.06) 0%, transparent 60%);
				pointer-events: none;
			}

			.wws-section-badge {
				display: inline-block;
				font-size: 11px;
				font-weight: 700;
				letter-spacing: 0.18em;
				text-transform: uppercase;
				color: #0d6efd;
				background: rgba(224, 123, 26, 0.1);
				border: 1px solid rgba(224, 123, 26, 0.25);
				border-radius: 50px;
				padding: 5px 18px;
				margin-bottom: 18px;
			}

			.wws-heading {
				font-size: clamp(30px, 4vw, 44px);
				font-weight: 700;
				color: #fff;
				margin-bottom: 10px;
				letter-spacing: -0.3px;
			}

			.wws-heading span {
				color: #0d6efd;
			}

			.wws-subtitle {
				color: rgba(255, 255, 255, 0.5);
				font-size: 15px;
				margin-bottom: 0;
			}

			/* Flip card structure */
			.flip-card-wrapper {
				perspective: 1100px;
				height: 300px;
				opacity: 0;
				transform: translateY(36px);
				transition: opacity 0.55s ease, transform 0.55s ease;
			}

			.flip-card-wrapper.wws-visible {
				opacity: 1;
				transform: translateY(0);
			}

			.flip-card-inner {
				position: relative;
				width: 100%;
				height: 100%;
				transform-style: preserve-3d;
				transition: transform 0.65s cubic-bezier(0.4, 0.2, 0.2, 1);
			}

			.flip-card-wrapper:hover .flip-card-inner {
				transform: rotateY(180deg);
			}

			.flip-card-front,
			.flip-card-back {
				position: absolute;
				inset: 0;
				background-color: #3b82f62e;
				border: 1px solid #3b82f62e;
				border-radius: 10px;
				backface-visibility: hidden;
				-webkit-backface-visibility: hidden;
				display: flex;
				flex-direction: column;
				align-items: center;
				justify-content: center;
				padding: 36px 28px;
				text-align: center;
				overflow: hidden;
			}

			/* Subtle glow corner on front */
			.flip-card-front::before {
				content: '';
				position: absolute;
				top: -40px;
				right: -40px;
				width: 100px;
				height: 100px;
				/* background: radial-gradient(circle, rgba(224,123,26,0.18) 0%, transparent 70%); */
				border-radius: 50%;
				pointer-events: none;
			}

			.flip-card-back {
				transform: rotateY(180deg);
				background: linear-gradient(to right, #3b82f6, #1e3a8a);
				border-color: transparent;
			}

			/* Icon circle on front */
			.flip-icon-wrap {
				width: 76px;
				height: 76px;
				border-radius: 50%;
				background: linear-gradient(to right, #3b82f64f, #1e3a8a8a);
				border: 1px solid rgba(224, 123, 26, 0.2);
				display: flex;
				align-items: center;
				justify-content: center;
				margin-bottom: 22px;
				transition: background 0.3s ease, transform 0.3s ease;
			}

			.flip-card-wrapper:hover .flip-icon-wrap {
				background: linear-gradient(to right, #3b82f64f, #1e3a8a8a);
				transform: scale(1.1);
			}

			.flip-icon-wrap img {
				width: 40px;
				height: 40px;
				object-fit: contain;
				filter: brightness(0) invert(1);
			}

			.flip-card-front h5 {
				font-size: 15px;
				font-weight: 700;
				letter-spacing: 0.06em;
				color: #fff;
				margin: 0;
			}

			.flip-card-front .flip-hint {
				font-size: 11px;
				color: rgba(255, 255, 255, 0.35);
				margin-top: 10px;
				letter-spacing: 0.05em;
				text-transform: uppercase;
				display: flex;
				align-items: center;
				gap: 5px;
			}

			.flip-hint-arrow {
				display: inline-block;
				animation: hint-nudge 1.6s ease-in-out infinite;
			}

			@keyframes hint-nudge {

				0%,
				100% {
					transform: translateX(0);
				}

				50% {
					transform: translateX(4px);
				}
			}

			/* Back content */
			.flip-back-icon {
				font-size: 36px;
				color: rgba(255, 255, 255, 0.9);
				margin-bottom: 16px;
			}

			.flip-card-back h5 {
				font-size: 16px;
				font-weight: 700;
				color: #fff;
				margin-bottom: 12px;
				letter-spacing: 0.04em;
			}

			.flip-card-back p {
				font-size: 14px;
				color: rgba(255, 255, 255, 0.88);
				line-height: 1.7;
				margin: 0;
			}

			.flip-card-back .flip-divider {
				width: 36px;
				height: 2px;
				background: rgba(255, 255, 255, 0.4);
				border-radius: 2px;
				margin: 12px auto;
			}

			/* === Responsive === */
			@media (max-width: 991px) {
				.about-hero {
					padding: 60px 0 50px;
				}

				.about-story,
				.about-vision-mission {
					padding: 50px 0;
				}

				.about-lifestyle {
					padding: 0 0 50px;
				}

				.about-lifestyle-img {
					height: 320px;
				}

				.about-story-img-wrap img {
					height: 300px;
				}

				.who-we-serve-section {
					padding: 50px 0;
				}

				.vm-card {
					padding: 28px 22px;
				}

				.flip-card-wrapper {
					height: 270px;
				}

				.tf-counter-section {
					padding: 50px 0;
				}

				.tf-counter-section .counter-box {
					padding: 24px 12px;
				}

				.tf-counter-section .counter-icon {
					font-size: 26px;
					width: 52px;
					height: 52px;
					margin-bottom: 14px;
				}

				.tf-counter-section .counter-number {
					font-size: 2rem;
				}
			}

			@media (max-width: 575.98px) {
				.about-hero-heading {
					font-size: 32px;
				}

				.about-hero-lead {
					font-size: 15px;
				}

				.about-lifestyle-img {
					height: 230px;
					border-radius: 16px;
				}

				.about-story-img-wrap img {
					height: 240px;
				}

				.about-story-stats {
					flex-wrap: wrap;
				}

				.about-story-stat {
					flex: 0 0 50%;
					border-right: none;
					border-bottom: 1px solid #ececec;
				}

				.about-story-stat:nth-child(odd) {
					border-right: 1px solid #ececec;
				}

				.flip-card-wrapper {
					height: 260px;
				}

				.flip-card-front,
				.flip-card-back {
					padding: 28px 18px;
				}
			}

			/* === Read More / Collapse Section === */
			.about-collapse-content {
				max-height: 0;
				overflow: hidden;
				opacity: 0;
				transition: max-height 0.4s cubic-bezier(0.25, 1, 0.5, 1), opacity 0.35s ease-out;
			}

			.btn-readmore {

				color: #0d6efd;
				font-weight: 600;
				font-size: 13px;
				letter-spacing: 0.05em;
				text-transform: uppercase;
				padding: 8px 20px;
				margin-top: 15px;
				border-radius: 50px;
				display: inline-flex;
				align-items: center;
				cursor: pointer;
				transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
				gap: 8px;
				outline: none;
			}

			.btn-readmore:hover {
				color: #0d6efd;
				transform: translateY(-1px);
			}

			.btn-readmore:active {
				transform: translateY(0);
			}

			.btn-readmore .icon-arrow {
				width: 6px;
				height: 6px;
				border-right: 2px solid currentColor;
				border-bottom: 2px solid currentColor;
				transform: rotate(45deg);
				transition: transform 0.3s cubic-bezier(0.25, 0.8, 0.25, 1), margin-bottom 0.3s ease;
				display: inline-block;
				margin-bottom: 2px;
			}

			.btn-readmore[aria-expanded="true"] .icon-arrow {
				transform: rotate(-135deg);
				margin-bottom: -1px;
			}

			/* Responsive behavior for mobile & laptop Read More states */

			/* Laptop (>= 768px): make paragraph 2 always visible */
			@media (min-width: 768px) {
				.about-collapse-mobile {
					max-height: none !important;
					opacity: 1 !important;
					overflow: visible !important;
				}
			}

		</style>
		<script>
			(function () {
				var cards = document.querySelectorAll('.flip-card-wrapper');
				if (!cards.length) return;

				if ('IntersectionObserver' in window) {
					var obs = new IntersectionObserver(function (entries) {
						entries.forEach(function (entry) {
							if (entry.isIntersecting && !entry.target.dataset.wwsIn) {
								entry.target.dataset.wwsIn = '1';
								var delay = parseInt(entry.target.getAttribute('data-wws-delay') || '0', 10);
								setTimeout(function () {
									entry.target.classList.add('wws-visible');
								}, delay);
								obs.unobserve(entry.target);
							}
						});
					}, {
						threshold: 0.2
					});
					cards.forEach(function (c) {
						obs.observe(c);
					});
				} else {
					cards.forEach(function (c) {
						c.classList.add('wws-visible');
					});
				}
			}());

		</script>

		<script>
			function initAboutFeatures() {
				/* Counter animation */
				function animateCounter(element, to, duration) {
					var suffix = element.getAttribute('data-suffix') || '';
					var startTime = performance.now();

					function update(now) {
						var elapsed = now - startTime;
						var progress = Math.min(elapsed / duration, 1);
						var eased = 1 - Math.pow(1 - progress, 3);
						var current = Math.floor(eased * to);
						element.innerHTML = current + (suffix ? '<span class="counter-suffix">' + suffix + '</span>' : '');
						if (progress < 1) requestAnimationFrame(update);
					}
					requestAnimationFrame(update);
				}

				var counters = document.querySelectorAll('.about-stat .stat-number');

				if ('IntersectionObserver' in window) {
					var counterObs = new IntersectionObserver(function (entries) {
						entries.forEach(function (entry) {
							if (entry.isIntersecting && !entry.target.dataset.animated) {
								entry.target.dataset.animated = 'true';
								var target = parseInt(entry.target.getAttribute('data-count'), 10);
								animateCounter(entry.target, target, 1600);
								counterObs.unobserve(entry.target);
							}
						});
					}, {
						threshold: 0.4
					});
					counters.forEach(function (c) {
						counterObs.observe(c);
					});
				} else {
					counters.forEach(function (c) {
						animateCounter(c, parseInt(c.getAttribute('data-count'), 10), 1600);
					});
				}

				/* Progress bar animation */
				var progressBars = document.querySelectorAll('.about-progress-bar');

				if ('IntersectionObserver' in window) {
					var progObs = new IntersectionObserver(function (entries) {
						entries.forEach(function (entry) {
							if (entry.isIntersecting && !entry.target.dataset.animated) {
								entry.target.dataset.animated = 'true';
								entry.target.style.width = entry.target.getAttribute('data-width') + '%';
								progObs.unobserve(entry.target);
							}
						});
					}, {
						threshold: 0.3
					});
					progressBars.forEach(function (bar) {
						progObs.observe(bar);
					});
				} else {
					progressBars.forEach(function (bar) {
						bar.style.width = bar.getAttribute('data-width') + '%';
					});
				}

				/* Parallax effect for About image/video */
				var parallaxMedia = document.querySelector('.about-new-img-wrap img, .about-new-img-wrap video');
				if (parallaxMedia) {
					window.addEventListener('scroll', function () {
						var rect = parallaxMedia.parentElement.getBoundingClientRect();
						var viewHeight = window.innerHeight;
						if (rect.top < viewHeight && rect.bottom > 0) {
							var total = viewHeight + rect.height;
							var current = viewHeight - rect.top;
							var pct = current / total;
							var y = (pct - 0.5) * 50; // Shift range +/- 25px
							parallaxMedia.style.transform = 'translateY(' + y + 'px)';
						}
					});
				}

				/* Read More toggles for Mobile and Laptop */
				var btnReadMore = document.getElementById('btnReadMore');
				var collapseMobile = document.getElementById('aboutCollapseMobile');
				var collapseLaptop = document.getElementById('aboutCollapseLaptop');

				if (btnReadMore && collapseMobile && collapseLaptop) {
					btnReadMore.addEventListener('click', function () {
						var isExpanded = btnReadMore.getAttribute('aria-expanded') === 'true';
						var isMobile = window.innerWidth < 768;

						if (isExpanded) {
							// Collapse
							if (isMobile) {
								collapseMobile.style.maxHeight = '0px';
								collapseMobile.style.opacity = '0';
							}
							collapseLaptop.style.maxHeight = '0px';
							collapseLaptop.style.opacity = '0';

							btnReadMore.setAttribute('aria-expanded', 'false');
							btnReadMore.querySelector('span').textContent = 'Read More';

							// Scroll back to the button
							var rect = btnReadMore.getBoundingClientRect();
							var absoluteTop = (window.scrollY || window.pageYOffset) + rect.top;
							if ('scrollBehavior' in document.documentElement.style) {
								window.scrollTo({
									top: absoluteTop - 200,
									behavior: 'smooth'
								});
							} else {
								window.scrollTo(0, absoluteTop - 200);
							}
						} else {
							// Expand
							if (isMobile) {
								collapseMobile.style.maxHeight = collapseMobile.scrollHeight + 'px';
								collapseMobile.style.opacity = '1';
							}
							collapseLaptop.style.maxHeight = collapseLaptop.scrollHeight + 'px';
							collapseLaptop.style.opacity = '1';

							btnReadMore.setAttribute('aria-expanded', 'true');
							btnReadMore.querySelector('span').textContent = 'Read Less';
						}
					});

					// Update max-height on window resize if currently expanded
					window.addEventListener('resize', function () {
						var isExpanded = btnReadMore.getAttribute('aria-expanded') === 'true';
						var isMobile = window.innerWidth < 768;

						if (isExpanded) {
							if (isMobile) {
								collapseMobile.style.maxHeight = collapseMobile.scrollHeight + 'px';
							} else {
								collapseMobile.style.maxHeight = ''; // reset inline so CSS overrides it
							}
							collapseLaptop.style.maxHeight = collapseLaptop.scrollHeight + 'px';
						} else {
							if (!isMobile) {
								collapseMobile.style.maxHeight = ''; // reset inline style
								collapseMobile.style.opacity = '';
							} else {
								collapseMobile.style.maxHeight = '0px';
								collapseMobile.style.opacity = '0';
							}
						}
					});
				}
			}

			if (document.readyState === 'loading') {
				document.addEventListener('DOMContentLoaded', initAboutFeatures);
			} else {
				initAboutFeatures();
			}

		</script>

		<!-- 1. NEW ABOUT SECTION -->
		<section class="about-section">
			<div class="container">

				<!-- Tag -->
				<!-- <span class="about-tag">About Us</span> -->

				<!-- Large Statement Title -->
				<!-- <h2 class="about-new-title">
			Find out how TeknoLite got its start <span>with the simple goal of making</span> long-lasting, high-performance LED lighting <span>that add</span> style and brilliance <span>to every space.</span>
		    </h2> -->

				<div class="heading-section">
					<h3 class="wow fadeInUp mb-2 header" style="font-weight:600;"><span class="text-primary">
							TeknoLite</span> India's Trusted LED Lighting Manufacturer</h3>
				</div>

				<!-- Two text columns + Image Column -->
				<div class="row align-items-stretch mt-5">
					<div class="col-lg-6 col-md-6 mb-4 mb-lg-0">
						<!-- Paragraph 1 -->
						<p class="about-new-desc text-justify">
							With over 45 years of industry experience, TeknoLite has established itself as one of
							India's
							leading LED lighting manufacturers, delivering innovative, energy-efficient, and
							high-performance
							lighting solutions for commercial, architectural, industrial, hospitality, retail, and
							residential
							projects.</p>

						<!-- Mobile Collapse Block (Paragraph 2) -->
						<div class="about-collapse-content about-collapse-mobile" id="aboutCollapseMobile"
							style="max-height: 0px; opacity: 0; overflow: hidden;">
							<!-- Paragraph 2 -->
							<p class="about-new-desc text-justify"> Backed by 3 state-of-the-art manufacturing plants,
								12+ offices across India, a strong network
								of 500+ authorised dealers, and the successful completion of 1,000+ lighting projects,
								TeknoLite has
								earned the trust of architects, builders, developers, MEP consultants, interior
								designers,
								electrical contractors, and infrastructure professionals nationwide.
								As a trusted lighting manufacturing company, we design and manufacture a comprehensive
								range of
								premium LED lighting solutions, including indoor lighting, outdoor lighting,
								architectural lighting,
								facade lighting, commercial lighting, office lighting, retail lighting, hospitality
								lighting, and
								landscape lighting.</p>
						</div>

						<!-- Laptop Collapse Block (Paragraphs 3-6) -->
						<div class="about-collapse-content about-collapse-laptop" id="aboutCollapseLaptop"
							style="max-height: 0px; opacity: 0; overflow: hidden;">
							<p class="about-new-desc text-justify"> Every product is developed using advanced
								engineering, precision manufacturing, and strict
								quality standards to ensure exceptional illumination, durability, energy efficiency, and
								longevity.</p>
							<p class="about-new-desc text-justify"> Whether it's a corporate office, luxury residence,
								hotel, retail showroom, healthcare facility,
								educational institution, or large-scale commercial development, TeknoLite delivers
								lighting
								solutions that combine performance, design, and sustainability.</p>
							<p class="about-new-desc text-justify">Our commitment to quality, innovation, and customer
								satisfaction has made TeknoLite a preferred commercial lighting manufacturer and
								architectural lighting solutions provider for projects across India.</p>
							<p class="about-new-desc text-justify">More than a manufacturer, TeknoLite is your trusted
								lighting partner—committed to innovation, quality and delivering excellence in every
								project.</p>
						</div>

						<!-- Single Toggle Button -->
						<button type="button" class="btn-readmore" id="btnReadMore" aria-expanded="false"
							aria-controls="aboutCollapseMobile aboutCollapseLaptop">
							<span>Read More</span> <span class="icon-arrow"></span>
						</button>
					</div>
					<div class="col-lg-6">
						<div class="about-new-img-wrap">
							<video autoplay loop muted playsinline>
								<source src="<?php echo base_url() ?>assets/images/banner/about.mp4" type="video/mp4">
								Your browser does not support the video tag.
							</video>
						</div>
					</div>
				</div>

				<!-- Clean horizontal statistics strip -->
				<div class="about-stats">
					<div class="about-stat">
						<h3 class="stat-number" data-count="45" data-suffix="+">0</h3>
						<p>Years Experience</p>
					</div>
					<div class="about-stat">
						<h3 class="stat-number" data-count="3">0</h3>
						<p>Plants</p>
					</div>
					<div class="about-stat">
						<h3 class="stat-number" data-count="12" data-suffix="+">0</h3>
						<p>Offices</p>
					</div>
					<div class="about-stat">
						<h3 class="stat-number" data-count="500" data-suffix="+">0</h3>
						<p>Dealers</p>
					</div>
					<div class="about-stat">
						<h3 class="stat-number" data-count="1000" data-suffix="+">0</h3>
						<p>Projects</p>
					</div>
				</div>

			</div>
		</section>
		<!-- ==================================================
             3. VISION + MISSION
        =================================================== -->

		<section class="flat-spacing-2 pt-0 vision-mission-section">

			<div class="container">

				<div class="row g-4">


					<!-- VISION -->

					<div class="col-lg-6">

						<div class="vision-mission-box wow fadeInUp">

							<span class="small-title">
								Our Vision
							</span>

							<h3>
								Lighting a Smarter Tomorrow
							</h3>

							<p class="text-body-1 text_secondary">

								To create dependable and innovative lighting
								solutions that enhance spaces while supporting
								energy efficiency, long-term performance
								and modern design.

							</p>

						</div>

					</div>



					<!-- MISSION -->

					<div class="col-lg-6">

						<div class="vision-mission-box wow fadeInUp" data-wow-delay="0.1s">

							<span class="small-title">
								Our Mission
							</span>

							<h3>
								Delivering Light with Purpose
							</h3>

							<p class="text-body-1 text_secondary">

								To provide quality LED lighting products,
								professional guidance and responsive support
								for different applications and project
								requirements.

							</p>

						</div>

					</div>

				</div>

			</div>

		</section>

		<!-- ==================================================
             4. CORE VALUES
        =================================================== -->

		<section class="flat-spacing-2 core-values-section">

			<div class="container">


				<div class="heading-section text-center core-heading">

					<h3 class="wow fadeInUp">
						Our Core Values
					</h3>

					<p class="text-body-default text_secondary wow fadeInUp" data-wow-delay="0.1s">

						The principles that guide the way we develop,
						recommend and deliver lighting solutions.

					</p>

				</div>



				<div dir="ltr" class="swiper tf-sw-iconbox" data-preview="4" data-tablet="3" data-mobile-sm="2"
					data-mobile="1" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1"
					data-pagination-sm="2" data-pagination-md="3" data-pagination-lg="4">


					<div class="swiper-wrapper">


						<!-- VALUE 1 -->

						<div class="swiper-slide">

							<div class="tf-box-icon">

								<div class="icon">
									<i class="icon-frame-3"></i>
								</div>

								<div class="content">

									<h5 class="title">
										Quality
									</h5>

									<p>
										Reliable lighting products focused
										on performance and durability.
									</p>

								</div>

							</div>

						</div>



						<!-- VALUE 2 -->

						<div class="swiper-slide">

							<div class="tf-box-icon">

								<div class="icon">
									<i class="icon-frame-2"></i>
								</div>

								<div class="content">

									<h5 class="title">
										Innovation
									</h5>

									<p>
										Modern lighting technology developed
										around evolving requirements.
									</p>

								</div>

							</div>

						</div>



						<!-- VALUE 3 -->

						<div class="swiper-slide">

							<div class="tf-box-icon">

								<div class="icon">
									<i class="icon-lifebuoy"></i>
								</div>

								<div class="content">

									<h5 class="title">
										Reliability
									</h5>

									<p>
										Dependable products and responsive
										support for every requirement.
									</p>

								</div>

							</div>

						</div>



						<!-- VALUE 4 -->

						<div class="swiper-slide">

							<div class="tf-box-icon">

								<div class="icon">
									<i class="icon-package"></i>
								</div>

								<div class="content">

									<h5 class="title">
										Customer Focus
									</h5>

									<p>
										Solutions recommended according to
										real customer and project needs.
									</p>

								</div>

							</div>

						</div>


					</div>


					<div class="sw-pagination-iconbox sw-dots type-circle d-flex justify-content-center">
					</div>

				</div>

			</div>

		</section>

		<!-- ==================================================
             6. WHY CHOOSE US
        =================================================== -->

		<section class="why-section">

			<div class="container text-center">

				<!-- Heading -->
				<div class="heading-section text-center">

					<h3 class="wow fadeInUp mb-2 header" style="font-weight:600;">
						Why Choose
						<span class="text-primary">TeknoLite</span>
					</h3>

					<p class="text-body-default text_secondary wow fadeInUp" data-wow-delay="0.1s">
						Lighting That Delivers Performance, Innovation & Reliability.
					</p>

				</div>


				<!-- 3-column feature grid -->
				<div class="row gy-4 text-start">


					<!-- 1. Premium Quality -->
					<div class="col-md-6 col-lg-4 why-item-col" data-why-delay="0">

						<div class="why-item tf-box-icon">

							<!-- 1. Premium Quality -->
							<div class="icon">
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
									stroke-linecap="round" stroke-linejoin="round">
									<circle cx="12" cy="12" r="10"></circle>
									<path d="m9 12 2 2 4-4"></path>
								</svg>
							</div>

							<div class="why-content">

								<h4>Premium Quality</h4>

								<p>
									Manufactured using high-quality components and
									strict quality standards for long-lasting performance.
								</p>

							</div>

						</div>

					</div>


					<!-- 2. Custom Lighting Solutions -->
					<div class="col-md-6 col-lg-4 why-item-col" data-why-delay="100">

						<div class="why-item tf-box-icon">

							<!-- 2. Custom Lighting Solutions -->
							<div class="icon">
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
									stroke-linecap="round" stroke-linejoin="round">
									<path d="M9 18h6"></path>
									<path d="M10 22h4"></path>
									<path d="M8.5 15.5A7 7 0 1 1 15.5 15.5
                 C14.5 16.4 14 17 14 18h-4
                 c0-1-.5-1.6-1.5-2.5z"></path>
								</svg>
							</div>

							<div class="why-content">

								<h4>Custom Lighting Solutions</h4>

								<p>
									Tailored lighting solutions for commercial,
									architectural and residential projects of every scale.
								</p>

							</div>

						</div>

					</div>


					<!-- 3. In-house Manufacturing -->
					<div class="col-md-6 col-lg-4 why-item-col" data-why-delay="200">

						<div class="why-item tf-box-icon">

							<!-- 3. In-house Manufacturing -->
							<div class="icon">
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
									stroke-linecap="round" stroke-linejoin="round">
									<path d="M3 21V9l6 3V9l6 3V5h6v16z"></path>
									<path d="M7 21v-4"></path>
									<path d="M11 21v-4"></path>
									<path d="M15 21v-4"></path>
								</svg>
							</div>

							<div class="why-content">

								<h4>In-house Manufacturing</h4>

								<p>
									Advanced manufacturing facilities ensuring
									consistency, quality and faster production timelines.
								</p>

							</div>

						</div>

					</div>


					<!-- 4. Timely Delivery -->
					<div class="col-md-6 col-lg-4 why-item-col" data-why-delay="0">

						<div class="why-item tf-box-icon">

							<!-- 4. Timely Delivery -->
							<div class="icon">
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
									stroke-linecap="round" stroke-linejoin="round">
									<circle cx="12" cy="12" r="9"></circle>
									<path d="M12 7v5l3 2"></path>
								</svg>
							</div>

							<div class="why-content">

								<h4>Timely Delivery</h4>

								<p>
									Strong logistics network delivering projects
									across India reliably and on schedule.
								</p>

							</div>

						</div>

					</div>


					<!-- 5. Expert Consultation -->
					<div class="col-md-6 col-lg-4 why-item-col" data-why-delay="100">

						<div class="why-item tf-box-icon">

							<!-- 5. Expert Consultation -->
							<div class="icon">
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
									stroke-linecap="round" stroke-linejoin="round">
									<path d="M8 12l3 3 5-5"></path>
									<path d="M3 10l4-4 4 3"></path>
									<path d="M21 10l-4-4-3 3"></path>
									<path d="M7 14l4 4c1 1 2 1 3 0l3-3"></path>
								</svg>
							</div>

							<div class="why-content">

								<h4>Expert Consultation</h4>

								<p>
									Professional lighting guidance from planning
									through to final project completion.
								</p>

							</div>

						</div>

					</div>


					<!-- 6. Energy Efficient -->
					<div class="col-md-6 col-lg-4 why-item-col" data-why-delay="200">

						<div class="why-item tf-box-icon">

							<!-- 6. Energy Efficient -->
							<div class="icon">
								<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
									stroke-linecap="round" stroke-linejoin="round">
									<path d="M20 4c-7 0-13 3-13 9 0 3 2 5 5 5 6 0 8-7 8-14z"></path>
									<path d="M4 20c3-5 7-8 12-10"></path>
								</svg>
							</div>

							<div class="why-content">

								<h4>Energy Efficient</h4>

								<p>
									Sustainable LED solutions designed to reduce
									energy consumption and cut maintenance costs.
								</p>

							</div>

						</div>

					</div>


				</div>
				<!-- /row -->

			</div>
			<!-- /container -->

		</section>



		<!-- ==================================================
             7. INFRASTRUCTURE
        =================================================== -->

		<!-- Experience Section -->
		<section class="experience-section">
			<div class="container">

				<div class="heading-section text-center">
					<h3 class="wow fadeInUp mb-2 header" style="font-weight:600;">Experience <span
							class="text-primary">Premium
							Lighting</span> Before You Buy</h3>
					<p class="text-body-default text_secondary wow fadeInUp" data-wow-delay="0.1s">Walk through our
						Experience
						Centres and see our LED lighting collections live. Compare products, explore finishes, and get
						expert
						guidance for your project.</p>
				</div>

				<?php 
				$activeBranches = !empty($branches) ? $branches : [];
				if (empty($activeBranches) && class_exists('CI_Controller')) {
					$CI =& get_instance();
					if (!isset($CI->branch_model)) {
						$CI->load->model('Branch_model', 'branch_model');
					}
					$activeBranches = $CI->branch_model->getActiveBranches();
				}
				?>
				<?php if (!empty($activeBranches)): ?>
					<?php foreach ($activeBranches as $idx => $b): 
						$isReverse = ($idx % 2 !== 0) ? ' reverse' : '';
						$branchImg = !empty($b['image']) 
							? (strpos($b['image'], 'http') === 0 ? $b['image'] : base_url($b['image'])) 
							: base_url('assets/images/shop/exp-andheri.jpeg');
						$branchName = !empty($b['name']) ? $b['name'] : 'TeknoLite Experience Centre';
						$branchCity = !empty($b['city_or_badge']) ? $b['city_or_badge'] : '';
						$branchAddress = !empty($b['address']) ? nl2br(htmlspecialchars($b['address'])) : '';
						$mapUrl = !empty($b['map_link']) ? $b['map_link'] : '#!';
					?>
					<div class="experience-row<?= $isReverse; ?>">
						<div class="experience-image">
							<img src="<?= $branchImg; ?>" alt="<?= htmlspecialchars($branchName . ($branchCity ? ' ' . $branchCity : '')); ?>">
							<?php if (!empty($branchCity)): ?>
								<h2><?= htmlspecialchars($branchCity); ?></h2>
							<?php endif; ?>
						</div>
						<div class="experience-content">
							<h3><?= htmlspecialchars($branchName); ?></h3>
							<?php if (!empty($branchAddress)): ?>
								<p><?= $branchAddress; ?></p>
							<?php endif; ?>
							<a href="<?= htmlspecialchars($mapUrl); ?>" target="_blank" rel="noopener noreferrer" class="tf-btn btn-white">
								Visit Showroom
							</a>
						</div>
					</div>
					<?php endforeach; ?>
				<?php endif; ?>

			</div><!-- /container -->
			<div class="mt-5 center-btn-wrap">
				<a href="#!" class="tf-btn btn-white wow fadeInUp" data-bs-toggle="modal"
					data-bs-target="#enquiryForm">Explore Collection</a>
			</div>
		</section>

    <!-- =========================================
     TRUSTED CLIENTS / BRANDS
========================================= -->
<section class="flat-spacing-2 trusted-brands-section">

    <div class="container">

        <div class="heading-section text-center mb-4">

            <h3 class="wow fadeInUp mb-2 header" style="font-weight:600;">
                Trusted by
                <span class="text-primary">Leading Brands</span>
            </h3>

            <p class="text-body-default text_secondary wow fadeInUp"
               data-wow-delay="0.1s">
                Lighting solutions trusted by leading hospitality,
                corporate and real estate brands.
            </p>

        </div>

    </div>


    <div class="swiper tf-sw-cls swiper-auto">

        <div class="swiper-wrapper">

            <!-- Radisson -->
            <div class="swiper-slide">
                <div class="cls-item">
                    <div class="image">

                        <img class="lazyload"
                             data-src="<?= base_url('assets/images/company/radisan_hotel.png'); ?>"
                             src="<?= base_url('assets/images/company/radisan_hotel.png'); ?>"
                             alt="Radisson Hotel">

                    </div>
                </div>
            </div>


            <!-- Hyatt -->
            <div class="swiper-slide">
                <div class="cls-item">
                    <div class="image">

                        <img class="lazyload"
                             data-src="<?= base_url('assets/images/company/hyatt.png'); ?>"
                             src="<?= base_url('assets/images/company/hyatt.png'); ?>"
                             alt="Hyatt">

                    </div>
                </div>
            </div>


            <!-- Home Town -->
            <div class="swiper-slide">
                <div class="cls-item">
                    <div class="image">

                        <img class="lazyload"
                             data-src="<?= base_url('assets/images/company/home_town.png'); ?>"
                             src="<?= base_url('assets/images/company/home_town.png'); ?>"
                             alt="Home Town">

                    </div>
                </div>
            </div>


            <!-- Hiranandani -->
            <div class="swiper-slide">
                <div class="cls-item">
                    <div class="image">

                        <img class="lazyload"
                             data-src="<?= base_url('assets/images/company/hiranandani.png'); ?>"
                             src="<?= base_url('assets/images/company/hiranandani.png'); ?>"
                             alt="Hiranandani">

                    </div>
                </div>
            </div>


            <!-- World Bank -->
            <div class="swiper-slide">
                <div class="cls-item">
                    <div class="image">

                        <img class="lazyload"
                             data-src="<?= base_url('assets/images/company/the_world_bank.png'); ?>"
                             src="<?= base_url('assets/images/company/the_world_bank.png'); ?>"
                             alt="The World Bank">

                    </div>
                </div>
            </div>

        </div>

    </div>

</section>

		<!-- ==================================================
             8. CERTIFICATIONS
             
             ONLY ENABLE AFTER CONFIRMING REAL CERTIFICATES
        =================================================== -->

		<!--

        <section class="flat-spacing-2 certification-section">

            <div class="container">

                <div class="heading-section text-center">

                    <h3>
                        Certifications & Quality Standards
                    </h3>

                    <p class="text_secondary">
                        Recognized standards supporting our
                        commitment to quality.
                    </p>

                </div>


                <div class="row g-4 justify-content-center">


                    <div class="col-lg-3 col-md-4 col-6">

                        <div class="certification-card">

                            <img
                                src="<?= base_url('assets/images/certification/certificate-1.png'); ?>"
                                loading="lazy"
                                decoding="async"
                                alt="Certification">

                        </div>

                    </div>


                    <div class="col-lg-3 col-md-4 col-6">

                        <div class="certification-card">

                            <img
                                src="<?= base_url('assets/images/certification/certificate-2.png'); ?>"
                                loading="lazy"
                                decoding="async"
                                alt="Certification">

                        </div>

                    </div>


                </div>

            </div>

        </section>

        -->



		<!-- ==================================================
             CTA Section is loaded globally via components/footer.php
        =================================================== -->



		<!-- ==================================================
             FOOTER
        =================================================== -->

		<?php $this->load->view('components/footer')?>


	</div>



	<!-- ==================================================
         MOBILE MENU
    =================================================== -->

	<?php $this->load->view('components/offcanvas')?>



	<!-- ==================================================
         COMMON TEMPLATE JS
    =================================================== -->

	<?php $this->load->view('components/script')?>


	<script>
		document.addEventListener("DOMContentLoaded", function () {

			const section = document.getElementById("teknoliteStats");

			if (!section) {
				console.log("TeknoLite stats section not found");
				return;
			}

			const counters = section.querySelectorAll(".teknolite-counter");

			if (!counters.length) {
				console.log("TeknoLite counters not found");
				return;
			}

			let hasStarted = false;


			function animateCounter(counter) {

				const target = Number(counter.getAttribute("data-count"));

				if (!target) {
					counter.textContent = "0";
					return;
				}

				const duration = 1500;

				const startTime = performance.now();


				function update(currentTime) {

					const elapsed = currentTime - startTime;

					const progress = Math.min(
						elapsed / duration,
						1
					);

					/*
					 * Smooth counter animation
					 */
					const value = Math.floor(
						progress * target
					);

					counter.textContent = value;


					if (progress < 1) {

						requestAnimationFrame(update);

					} else {

						counter.textContent = target;

					}

				}


				requestAnimationFrame(update);

			}


			function startCounters() {

				if (hasStarted) {
					return;
				}


				const rect =
					section.getBoundingClientRect();

				const windowHeight =
					window.innerHeight ||
					document.documentElement.clientHeight;


				/*
				 * Start when stats section
				 * enters the browser screen
				 */
				if (
					rect.top < windowHeight - 50 &&
					rect.bottom > 0
				) {

					hasStarted = true;


					counters.forEach(function (counter) {

						animateCounter(counter);

					});


					window.removeEventListener(
						"scroll",
						startCounters
					);

				}

			}


			/*
			 * Check immediately
			 */
			startCounters();


			/*
			 * Check during scrolling
			 */
			window.addEventListener(
				"scroll",
				startCounters, {
					passive: true
				}
			);

		});

	</script>

</body>

</html>
