<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml"
      xml:lang="en-US"
      lang="en-US">

<head>

    <meta charset="utf-8">

    <title>Lighting Insights & Blogs | TeknoLite</title>

    <meta name="description"
          content="Explore TeknoLite lighting guides, product information, industry insights and company updates.">

    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1">


    <?php $this->load->view('components/head')?>


    <link rel="stylesheet"
          href="<?= base_url('assets/css/blog.css'); ?>">

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
                stroke-linejoin="round" />

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
             PAGE BANNER
        ====================================================== -->

        <div class="page-title relative">
            <div class="paralaximg" data-parallax="scroll" data-image-src="assets/images/page-title/page-title-1.jpg">
            </div>
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="title">Blogs</h3>
                            <ul class="breadcrumb">
                                <li><a href="<?= base_url(); ?>">Homepage</a></li>
                                <li>Blogs</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- =====================================================
             MAIN CONTENT
        ====================================================== -->

        <div class="main-content">
            <!-- =================================================
                 BLOG LISTING
            ================================================== -->

            <section class="blog-list-main flat-spacing">


                <div class="container">


                    <!-- HEADING -->

                    <div class="teknolite-blog-heading">

                        <div>

                            <span class="text-caption-1">
                                OUR BLOG
                            </span>

                            <h3>
                                Latest Articles
                            </h3>

                        </div>


                        <p class="text_secondary">

                            Product information, lighting guides,
                            company news and industry insights.

                        </p>

                    </div>



                    <!-- =================================================
                         SEARCH
                    ================================================== -->

                    <div class="teknolite-blog-search-wrap">


                        <form
                            id="blogSearchForm"
                            class="teknolite-blog-search">


                            <input
                                type="text"
                                id="blogSearch"
                                placeholder="Search articles..."
                                autocomplete="off">


                            <button type="submit"
                                    aria-label="Search">

                                <svg
                                    width="20"
                                    height="20"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg">

                                    <path
                                        d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z"
                                        stroke="#181818"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </path>

                                    <path
                                        d="M21.35 21L17 16.65"
                                        stroke="#181818"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round">
                                    </path>

                                </svg>

                            </button>

                        </form>

                    </div>



                    <!-- =================================================
                         CATEGORY FILTER
                    ================================================== -->

                    <div class="teknolite-blog-filter">

                        <button
                            type="button"
                            class="blog-filter-btn active"
                            data-category="all">
                            All
                        </button>

                        <?php if (!empty($categories)): ?>
                            <?php foreach ($categories as $cat): 
                                $catSlug = $cat['category_slug'] ?? url_title(strtolower($cat['category']), '-', TRUE);
                            ?>
                            <button
                                type="button"
                                class="blog-filter-btn"
                                data-category="<?= htmlspecialchars($catSlug); ?>">
                                <?= htmlspecialchars($cat['category']); ?>
                            </button>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </div>

                    <!-- RESULT COUNT -->
                    <div class="teknolite-blog-result-info">
                        <span id="blogResultCount">
                            Showing articles
                        </span>
                    </div>

                    <!-- BLOG CARDS -->
                    <div class="teknolite-blog-grid" id="blogGrid">
                        <?php 
                        $activeBlogs = !empty($blogs) ? $blogs : [];
                        if (empty($activeBlogs) && class_exists('CI_Controller')) {
                            $CI =& get_instance();
                            if (!isset($CI->blog_model)) {
                                $CI->load->model('Blog_model', 'blog_model');
                            }
                            $activeBlogs = $CI->blog_model->getActiveBlogs();
                        }
                        ?>
                        <?php if (!empty($activeBlogs)): ?>
                            <?php foreach ($activeBlogs as $b): 
                                $blogUrl = base_url('blog/' . $b['slug']);
                                $blogImg = !empty($b['image_url']) ? $b['image_url'] : base_url('assets/images/blog/blog-details.jpg');
                                $searchKeywords = strtolower($b['title'] . ' ' . $b['category'] . ' ' . $b['short_description']);
                            ?>
                            <article
                                class="blog-article-item teknolite-blog-card"
                                data-category="<?= htmlspecialchars($b['category_slug']); ?>"
                                data-search="<?= htmlspecialchars($searchKeywords); ?>">

                                <div class="article-thumb">
                                    <a href="<?= $blogUrl; ?>">
                                        <img
                                            class="lazyload"
                                            data-src="<?= $blogImg; ?>"
                                            src="<?= $blogImg; ?>"
                                            loading="lazy"
                                            decoding="async"
                                            alt="<?= htmlspecialchars($b['title']); ?>">
                                    </a>
                                    <div class="article-label">
                                        <span class="text-button-small">
                                            <?= htmlspecialchars($b['category']); ?>
                                        </span>
                                    </div>
                                </div>

                                <div class="article-content">
                                    <ul class="meta">
                                        <li class="text-button-small">
                                            <?= htmlspecialchars($b['formatted_date']); ?>
                                        </li>
                                        <li class="text-button-small">
                                            <?= htmlspecialchars($b['category']); ?>
                                        </li>
                                    </ul>

                                    <h5 class="article-title">
                                        <a href="<?= $blogUrl; ?>" class="line-clamp-2 link">
                                            <?= htmlspecialchars($b['title']); ?>
                                        </a>
                                    </h5>

                                    <p class="article-description text_secondary text-body-default">
                                        <?= htmlspecialchars($b['short_description']); ?>
                                    </p>

                                    <a href="<?= $blogUrl; ?>" class="tf-btn-link">
                                        <span>Read More</span>
                                    </a>
                                </div>

                            </article>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>



                    <!-- NO RESULT -->

                    <div
                        id="noBlogResult"
                        class="teknolite-no-blog">

                        <h5>
                            No articles found
                        </h5>

                        <p class="text_secondary">
                            Try another search or category.
                        </p>

                    </div>



                    <!-- =================================================
                         PAGINATION
                    ================================================== -->

                    <ul
                        class="wg-pagination teknolite-blog-pagination"
                        id="blogPagination">
                    </ul>


                </div>

            </section>


        </div>



        <!-- FOOTER -->

        <?php $this->load->view('components/footer')?>


    </div>
    <!-- /wrapper -->



    <!-- MOBILE MENU / OFFCANVAS -->

    <?php $this->load->view('components/offcanvas')?>



    <!-- COMMON JS -->

    <?php $this->load->view('components/script')?>



</body>

</html>