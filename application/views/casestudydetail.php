<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <meta charset="utf-8">
    <title><?= !empty($case_study['meta_title']) ? html_escape($case_study['meta_title']) : (!empty($case_study['title']) ? html_escape($case_study['title']) . ' | TeknoLite Case Study' : 'Case Study | TeknoLite Architectural Lighting'); ?></title>

    <meta name="description" content="<?= !empty($case_study['meta_description']) ? html_escape($case_study['meta_description']) : (!empty($case_study['short_description']) ? html_escape($case_study['short_description']) : (!empty($case_study['overview']) ? html_escape(substr(strip_tags($case_study['overview']), 0, 160)) : 'Explore TeknoLite architectural lighting case studies.')); ?>">

    <?php if (!empty($case_study['meta_keywords'])): ?>
    <meta name="keywords" content="<?= html_escape($case_study['meta_keywords']); ?>">
    <?php endif; ?>

    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <?php $this->load->view('components/head'); ?>

    <style>
        /* =========================================================
           Case Study Detail Scoped Styles
        ========================================================= */
        .teknolite-case-header {
            padding-top: 60px;
            padding-bottom: 40px;
        }

        .case-detail-category {
            display: inline-flex;
            align-items: center;
            padding: 6px 16px;
            background: rgba(4, 48, 140, 0.08);
            color: #04308c;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 16px;
        }

        .case-project-name {
            font-size: 40px;
            font-weight: 700;
            line-height: 1.2;
            color: #0f172a;
            margin-bottom: 18px;
        }

        .case-short-description {
            font-size: 17px;
            line-height: 1.75;
            color: #4b5563;
            max-width: 720px;
            margin-bottom: 0;
        }

        /* Project Details Box */
        .case-detail-meta-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 24px 28px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.02);
        }

        .case-detail-meta-box .meta-box-header {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b;
            margin-bottom: 18px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e2e8f0;
        }

        .case-meta-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px 24px;
        }

        .case-meta-item .meta-label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #94a3b8;
            margin-bottom: 4px;
        }

        .case-meta-item .meta-value {
            display: block;
            font-size: 15px;
            font-weight: 600;
            color: #0f172a;
            line-height: 1.45;
        }

        /* Hero Image (Square and Centered) */
        .teknolite-case-hero {
            padding-top: 15px;
            padding-bottom: 60px;
            text-align: center;
        }

        .teknolite-case-hero .container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .case-hero-image {
            width: 100%;
            max-width: 580px;
            aspect-ratio: 1 / 1;
            margin-left: auto;
            margin-right: auto;
            overflow: hidden;
            border-radius: 18px;
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.08);
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .case-hero-image img {
            display: block;
            width: 100%;
            height: 100%;
            aspect-ratio: 1 / 1;
            object-fit: cover;
            object-position: center;
        }

        /* Project Overview */
        .teknolite-case-content-section {
            padding-top: 20px;
            padding-bottom: 80px;
        }

        .case-section-label > span {
            display: inline-block;
            margin-bottom: 10px;
            letter-spacing: 1px;
            color: #04308c;
            font-weight: 600;
        }

        .case-section-label h3 {
            font-size: 30px;
            font-weight: 700;
            line-height: 1.3;
            color: #0f172a;
        }

        .case-overview-content {
            font-size: 17px;
            line-height: 1.85;
            color: #374151;
        }

        .case-overview-content p {
            margin-bottom: 20px;
        }

        .case-overview-content p:last-child {
            margin-bottom: 0;
        }

        /* Cards for Other Projects */
        .teknolite-related-cases {
            padding-top: 20px;
            padding-bottom: 90px;
            border-top: 1px solid #f1f5f9;
        }

        .teknolite-related-cases .heading-section {
            margin-bottom: 35px;
        }

        .related-case-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 28px;
        }

        .related-case-card {
            background: #ffffff;
            border: 1px solid #eef2f6;
            border-radius: 14px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .related-case-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.07);
        }

        .related-case-image {
            position: relative;
            overflow: hidden;
            aspect-ratio: 16 / 11;
            background: #f1f5f9;
        }

        .related-case-image > a {
            display: block;
            width: 100%;
            height: 100%;
        }

        .related-case-image img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .related-case-card:hover .related-case-image img {
            transform: scale(1.05);
        }

        .related-case-image > span {
            position: absolute;
            top: 14px;
            left: 14px;
            padding: 5px 12px;
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.95);
            color: #0f172a;
            font-size: 12px;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .related-case-content {
            padding: 22px 24px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .related-case-content h4 {
            font-size: 19px;
            font-weight: 700;
            line-height: 1.35;
            margin-bottom: 10px;
        }

        .related-case-content h4 a {
            color: #0f172a;
            transition: color 0.2s ease;
        }

        .related-case-content h4 a:hover {
            color: #04308c;
        }

        .related-case-content p {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 16px;
            flex-grow: 1;
        }

        @media (max-width: 991px) {
            .case-project-name {
                font-size: 32px;
            }
            .case-hero-image {
                max-width: 480px;
                aspect-ratio: 1 / 1;
            }
            .related-case-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 20px;
            }
        }

        @media (max-width: 767px) {
            .teknolite-case-header {
                padding-top: 40px;
                padding-bottom: 30px;
            }
            .case-project-name {
                font-size: 27px;
            }
            .case-short-description {
                font-size: 15px;
            }
            .case-meta-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }
            .case-hero-image {
                max-width: 100%;
                aspect-ratio: 1 / 1;
                border-radius: 12px;
            }
            .case-section-label h3 {
                font-size: 24px;
            }
            .case-overview-content {
                font-size: 15px;
            }
            .related-case-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body class="preload-wrapper">

    <!-- SCROLL TOP -->
    <button id="scroll-top">
        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3 11.9175L12 2.91748L21 11.9175H16.5V20.1675C16.5 20.3664 16.421 20.5572 16.2803 20.6978C16.1397 20.8385 15.9489 20.9175 15.75 20.9175H8.25C8.05109 20.9175 7.86032 20.8385 7.71967 20.6978C7.57902 20.5572 7.5 20.3664 7.5 20.1675V11.9175H3Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </button>

    <!-- PRELOADER -->
    <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>

    <div id="wrapper">

        <!-- HEADER -->
        <?php $this->load->view('components/header'); ?>

        <?php
        if (!function_exists('resolve_cs_img')) {
            function resolve_cs_img($path, $fallback = 'assets/images/project/project2.jpeg') {
                if (empty($path)) return base_url($fallback);
                if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) return $path;
                if (strpos($path, 'assets/') === 0 || strpos($path, 'uploads/') === 0) return base_url($path);
                return base_url($path);
            }
        }

        $projTitle = !empty($case_study['title']) ? $case_study['title'] : 'TeknoLite Project';
        $projIndustry = !empty($case_study['industry']) ? $case_study['industry'] : 'Commercial';
        $projClient = !empty($case_study['client']) ? $case_study['client'] : 'TeknoLite Project';
        $projLocation = !empty($case_study['location']) ? $case_study['location'] : 'India';
        $projSolution = !empty($case_study['solution']) ? $case_study['solution'] : 'Architectural LED Lighting';
        $projShortDesc = !empty($case_study['short_description']) 
            ? $case_study['short_description'] 
            : (!empty($case_study['meta_description']) 
                ? $case_study['meta_description'] 
                : (!empty($case_study['overview']) 
                    ? substr(strip_tags($case_study['overview']), 0, 220) . (strlen(strip_tags($case_study['overview'])) > 220 ? '...' : '') 
                    : 'A practical lighting solution designed to create comfortable, balanced and functional illumination across spaces.'));
        $projOverview = !empty($case_study['overview']) ? $case_study['overview'] : 'The project required a comprehensive lighting solution that could support different architectural zones while maintaining a clean and consistent visual environment.';
        $heroImg = resolve_cs_img($case_study['featured_image'] ?? '', 'assets/images/project/project2.jpeg');

        // Filter other projects from recent studies
        $otherProjects = [];
        $currentId = $case_study['numeric_id'] ?? ($case_study['id'] ?? null);
        $currentSlug = $case_study['slug'] ?? '';
        if (!empty($recent_studies)) {
            foreach ($recent_studies as $rs) {
                $rsId = $rs['numeric_id'] ?? ($rs['id'] ?? null);
                $rsSlug = $rs['slug'] ?? '';
                if ($rsId != $currentId && $rsSlug !== $currentSlug) {
                    $otherProjects[] = $rs;
                }
            }
        }
        $otherProjects = array_slice($otherProjects, 0, 3);
        ?>

        <!-- =====================================================
             PAGE BANNER & BREADCRUMB
        ====================================================== -->
        <div class="page-title relative">
            <div class="paralaximg" data-parallax="scroll" data-image-src="<?= base_url('assets/images/page-title/page-title-9.jpg'); ?>"></div>
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="title">Case Study</h3>
                            <ul class="breadcrumb">
                                <li><a href="<?= base_url(); ?>">Home</a></li>
                                <li><a href="<?= base_url('casestudy'); ?>">Case Studies</a></li>
                                <li><?= html_escape($projTitle); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- =====================================================
             MAIN CONTENT
        ====================================================== -->
        <main class="main-content">

            <!-- =================================================
                 PROJECT HEADER: NAME, SHORT DESC & DETAILS
            ================================================== -->
            <section class="teknolite-case-header">
                <div class="container">
                    <div class="row align-items-center g-4">

                        <!-- LEFT: Name of Project & Short Description -->
                        <div class="col-lg-7 col-xl-8">
                            <div class="case-detail-heading">
                                <span class="case-detail-category">
                                    <?= html_escape($projIndustry); ?>
                                </span>

                                <h1 class="case-project-name">
                                    <?= html_escape($projTitle); ?>
                                </h1>

                                <p class="case-short-description">
                                    <?= html_escape($projShortDesc); ?>
                                </p>
                            </div>
                        </div>

                        <!-- RIGHT: Details (Industry, Client, Location, Solution) -->
                        <div class="col-lg-5 col-xl-4">
                            <div class="case-detail-meta-box">
                                <div class="meta-box-header">
                                    Project Details
                                </div>
                                <div class="case-meta-grid">
                                    <div class="case-meta-item">
                                        <span class="meta-label">Industry</span>
                                        <strong class="meta-value"><?= html_escape($projIndustry); ?></strong>
                                    </div>

                                    <div class="case-meta-item">
                                        <span class="meta-label">Client</span>
                                        <strong class="meta-value"><?= html_escape($projClient); ?></strong>
                                    </div>

                                    <div class="case-meta-item">
                                        <span class="meta-label">Location</span>
                                        <strong class="meta-value"><?= html_escape($projLocation); ?></strong>
                                    </div>

                                    <div class="case-meta-item">
                                        <span class="meta-label">Solution</span>
                                        <strong class="meta-value"><?= html_escape($projSolution); ?></strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!-- =================================================
                 PROJECT IMAGE
            ================================================== -->
            <section class="teknolite-case-hero">
                <div class="container">
                    <div class="case-hero-image">
                        <img class="lazyload" data-src="<?= $heroImg; ?>" src="<?= $heroImg; ?>" alt="<?= html_escape($projTitle); ?>" loading="lazy" decoding="async">
                    </div>
                </div>
            </section>

            <!-- =================================================
                 PROJECT OVERVIEW
            ================================================== -->
            <section class="teknolite-case-content-section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 mb-4 mb-lg-0">
                            <div class="case-section-label">
                                <span class="text-caption-1">PROJECT OVERVIEW</span>
                                <h3>About This Project</h3>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="case-overview-content">
                                <?= nl2br(html_escape($projOverview)); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- =================================================
                 CARDS FOR OTHER PROJECTS
            ================================================== -->
            <?php if (!empty($otherProjects)): ?>
            <section class="teknolite-related-cases">
                <div class="container">
                    <div class="heading-section">
                        <span class="text-caption-1">EXPLORE MORE</span>
                        <h3>Other Projects</h3>
                    </div>

                    <div class="related-case-grid">
                        <?php foreach ($otherProjects as $other): 
                            $otherSlug = $other['slug'] ?? ($other['id'] ?? '');
                            $otherUrl = base_url('casestudydetail/' . $otherSlug);
                            $otherImg = resolve_cs_img($other['featured_image'] ?? '', 'assets/images/project/project1.jpeg');
                            $otherTitle = $other['title'] ?? 'TeknoLite Project';
                            $otherIndustry = $other['industry'] ?? 'Lighting';
                            $otherExcerpt = !empty($other['short_description']) 
                                ? $other['short_description'] 
                                : (!empty($other['overview']) ? substr(strip_tags($other['overview']), 0, 110) . (strlen(strip_tags($other['overview'])) > 110 ? '...' : '') : '');
                        ?>
                        <article class="related-case-card">
                            <div class="related-case-image">
                                <a href="<?= $otherUrl; ?>">
                                    <img class="lazyload" data-src="<?= $otherImg; ?>" src="<?= $otherImg; ?>" alt="<?= html_escape($otherTitle); ?>" loading="lazy" decoding="async">
                                </a>
                                <span><?= html_escape($otherIndustry); ?></span>
                            </div>

                            <div class="related-case-content">
                                <h4>
                                    <a href="<?= $otherUrl; ?>" class="link">
                                        <?= html_escape($otherTitle); ?>
                                    </a>
                                </h4>

                                <?php if (!empty($otherExcerpt)): ?>
                                <p>
                                    <?= html_escape($otherExcerpt); ?>
                                </p>
                                <?php endif; ?>

                                <a href="<?= $otherUrl; ?>" class="tf-btn-link">
                                    <span>View Case Study</span>
                                    <i class="icon-arrow-up-right"></i>
                                </a>
                            </div>
                        </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <?php endif; ?>

        </main>

        <!-- FOOTER -->
        <?php $this->load->view('components/footer'); ?>

    </div>

    <!-- MOBILE OFFCANVAS -->
    <?php $this->load->view('components/offcanvas'); ?>

    <!-- SCRIPTS -->
    <?php $this->load->view('components/script'); ?>

</body>
</html>
