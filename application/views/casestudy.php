<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml"
      xml:lang="en-US"
      lang="en-US">

<head>

    <meta charset="utf-8">

    <title>Case Studies | TeknoLite Lighting Solutions</title>

    <meta name="description"
          content="Explore TeknoLite lighting projects across residential, commercial and hospitality spaces, featuring premium indoor, commercial and decorative LED lighting solutions.">

    <meta name="robots"
          content="index, follow">

    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1">


    <?php $this->load->view('components/head')?>


</head>


<body class="preload-wrapper">


    <!-- SCROLL TOP -->

    <button id="scroll-top">

        <svg width="24"
             height="25"
             viewBox="0 0 24 25"
             fill="none"
             xmlns="http://www.w3.org/2000/svg">

            <path
                d="M3 11.9175L12 2.91748L21 11.9175H16.5V20.1675C16.5 20.3664 16.421 20.5572 16.2803 20.6978C16.1397 20.8385 15.9489 20.9175 15.75 20.9175H8.25C8.05109 20.9175 7.86032 20.8385 7.71967 20.6978C7.57902 20.5572 7.5 20.3664 7.5 20.1675V11.9175H3Z"
                stroke="white"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round">
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

        <?php $this->load->view('components/header')?>


        <!-- =====================================================
             PAGE TITLE / INNER BANNER
        ====================================================== -->

        <div class="page-title relative">

            <div
                class="paralaximg"
                data-parallax="scroll"
                data-image-src="<?= base_url('assets/images/page-title/page-title-9.jpg'); ?>">
            </div>


            <div class="content">

                <div class="container">

                    <div class="row">

                        <div class="col-12">


                            <h3 class="title">
                                Case Studies
                            </h3>


                            <ul class="breadcrumb">

                                <li>

                                    <a href="<?= base_url(); ?>">
                                        Home
                                    </a>

                                </li>

                                <li>
                                    Case Studies
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
                 PROJECTS INTRO
            ================================================== -->

            <section class="flat-spacing teknolite-case-intro">

                <div class="container">

                    <div class="heading-section text-center">

                        <span class="text-caption-1">
                            OUR PROJECTS
                        </span>

                        <h3 class="wow fadeInUp">
                            Our Latest <span class="text-primary">Projects</span>
                        </h3>

                        <p class="text-body-default text_secondary wow fadeInUp"
                           data-wow-delay="0.1s">

                            Explore our diverse range of lighting solutions crafted for
                            commercial, residential and architectural spaces.

                        </p>

                    </div>

                </div>

            </section>


            <!-- =================================================
                 CASE STUDY / PROJECT LIST
            ================================================== -->

            <section class="teknolite-case-section">

                <div class="container">


                    <!-- =========================================
                         FILTERS
                    ========================================== -->

                    <div class="teknolite-case-filter">

                        <button type="button"
                                class="case-filter-btn active"
                                data-category="all">
                            All Projects
                        </button>

                        <?php if (!empty($industries)): ?>
                            <?php foreach ($industries as $ind): ?>
                                <?php $indKey = strtolower(trim(preg_replace('/[^a-zA-Z0-9]/', '', $ind))); ?>
                                <button type="button"
                                        class="case-filter-btn"
                                        data-category="<?= $indKey; ?>">
                                    <?= html_escape($ind); ?>
                                </button>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <button type="button" class="case-filter-btn" data-category="residential">Residential</button>
                            <button type="button" class="case-filter-btn" data-category="commercial">Commercial</button>
                            <button type="button" class="case-filter-btn" data-category="hospitality">Hospitality</button>
                        <?php endif; ?>

                    </div>


                    <!-- RESULT COUNT -->

                    <div class="teknolite-case-result">

                        <span id="caseResultCount">
                            Showing <?= !empty($casestudies) ? count($casestudies) : 0; ?> projects
                        </span>

                    </div>


                    <!-- =========================================
                         PROJECT GRID
                    ========================================== -->

                    <div class="teknolite-case-grid"
                         id="caseStudyGrid">

                        <?php if (!empty($casestudies)): ?>
                            <?php foreach ($casestudies as $cs): ?>
                                <?php 
                                    $indKey = strtolower(trim(preg_replace('/[^a-zA-Z0-9]/', '', $cs['industry'] ?? 'general'))); 
                                    $csUrl = base_url('casestudydetail/' . ($cs['slug'] ?? ''));
                                    $csImg = base_url($cs['featured_image'] ?? 'assets/images/project/project1.jpeg');
                                ?>
                                <article class="teknolite-case-card"
                                         data-category="<?= $indKey; ?>">

                                    <div class="case-image">

                                        <a href="<?= $csUrl; ?>">

                                            <img class="lazyload"
                                                 data-src="<?= $csImg; ?>"
                                                 src="<?= $csImg; ?>"
                                                 loading="lazy"
                                                 decoding="async"
                                                 alt="<?= html_escape($cs['title'] ?? ''); ?>">

                                        </a>

                                        <div class="case-category">
                                            <?= html_escape($cs['industry'] ?? 'Project'); ?>
                                        </div>

                                    </div>


                                    <div class="case-content">

                                        <h4 class="case-title">

                                            <a href="<?= $csUrl; ?>"
                                               class="link">
                                                <?= html_escape($cs['title'] ?? ''); ?>
                                            </a>

                                        </h4>

                                        <p class="text_secondary">
                                            <?= html_escape(substr(strip_tags($cs['overview'] ?? ''), 0, 140) . (strlen(strip_tags($cs['overview'] ?? '')) > 140 ? '...' : '')); ?>
                                        </p>

                                        <a href="<?= $csUrl; ?>"
                                           class="tf-btn-link">

                                            <span>Know More</span>
                                            <i class="icon-arrow-up-right"></i>

                                        </a>

                                    </div>

                                </article>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </div>


                    <!-- NO RESULT -->

                    <div class="teknolite-case-empty"
                         id="caseNoResult">

                        <h4>No Projects Found</h4>

                        <p class="text_secondary">
                            No projects are available in this category.
                        </p>

                    </div>


                    <!-- PAGINATION -->
                    <ul class="wg-pagination teknolite-case-pagination"
                        id="casePagination">
                    </ul>


                </div>

            </section>


        </div>
        <!-- /main-content -->


        <!-- FOOTER -->

        <?php $this->load->view('components/footer')?>


    </div>
    <!-- /wrapper -->



    <!-- MOBILE MENU -->

    <?php $this->load->view('components/offcanvas')?>



    <!-- COMMON SCRIPTS -->

    <?php $this->load->view('components/script')?>



</body>

</html>