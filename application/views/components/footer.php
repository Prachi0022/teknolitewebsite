<?php if (!isset($hide_cta) || !$hide_cta): ?>
    <?php $this->load->view('components/cta'); ?>
<?php endif; ?>

<footer id="footer" class="footer">

    <div class="container">

        <div class="row">

            <div class="col-12">

                <div class="footer-body">

                    <div class="footer-left">

                        <div class="footer-infor flex-grow-1">

                            <div class="footer-menu">


                                <!-- QUICK LINKS -->
                                <div class="footer-col-block">

                                    <h5 class="footer-heading text_white footer-heading-mobile">
                                        Quick Links
                                    </h5>

                                    <div class="tf-collapse-content">

                                        <ul class="footer-menu-list">

                                            <li class="text-body-default">
                                                <a href="<?= base_url('about'); ?>"
                                                    class="link footer-menu_item">
                                                    About Us
                                                </a>
                                            </li>

                                            <li class="text-body-default">
                                                <a href="<?= base_url('product'); ?>"
                                                    class="link footer-menu_item">
                                                    Products
                                                </a>
                                            </li>

                                            <li class="text-body-default">
                                                <a href="<?= base_url('casestudy'); ?>"
                                                    class="link footer-menu_item">
                                                    Case Studies
                                                </a>
                                            </li>

                                            <li class="text-body-default">
                                                <a href="<?= base_url('blog'); ?>"
                                                    class="link footer-menu_item">
                                                    Blogs
                                                </a>
                                            </li>

                                            <li class="text-body-default">
                                                <a href="<?= base_url('contact'); ?>"
                                                    class="link footer-menu_item">
                                                    Contact Us
                                                </a>
                                            </li>

                                        </ul>

                                    </div>

                                </div>


                                <!-- PRODUCT CATEGORIES -->
                                <div class="footer-col-block">

                                    <h5 class="footer-heading text_white footer-heading-mobile">
                                        Lighting Solutions
                                    </h5>

                                    <div class="tf-collapse-content">

                                        <ul class="footer-menu-list">

                                            <li class="text-body-default">
                                                <a href="<?= base_url('product'); ?>"
                                                    class="link footer-menu_item">
                                                    Indoor Lighting
                                                </a>
                                            </li>

                                            <li class="text-body-default">
                                                <a href="<?= base_url('product'); ?>"
                                                    class="link footer-menu_item">
                                                    Commercial Lighting
                                                </a>
                                            </li>

                                            <li class="text-body-default">
                                                <a href="<?= base_url('product'); ?>"
                                                    class="link footer-menu_item">
                                                    Outdoor Lighting
                                                </a>
                                            </li>

                                            <li class="text-body-default">
                                                <a href="<?= base_url('product'); ?>"
                                                    class="link footer-menu_item">
                                                    Architectural Lighting
                                                </a>
                                            </li>

                                            <li class="text-body-default">
                                                <a href="#quoteForm" data-bs-toggle="modal" data-bs-target="#quoteForm"
                                                    class="link footer-menu_item">
                                                    Request a Quote
                                                </a>
                                            </li>

                                        </ul>

                                    </div>

                                </div>

                            </div>



                        </div>

                    </div>


                    <!-- NEWSLETTER -->
                    <div class="footer-col-block footer-newsletter">

                        <!-- CONTACT -->

                                <?php
                                    $footerLogoUrl = function_exists('get_setting_image') 
                                        ? get_setting_image('header_logo_2', get_setting_image('footer_logo', get_setting('header_logo', 'assets/images/logo/logo.png'))) 
                                        : base_url('assets/images/logo/logo.png');
                                    $footerStoreName = function_exists('get_setting') 
                                        ? get_setting('store_name', 'TeknoLite') 
                                        : 'TeknoLite';
                                    $footerPhone = function_exists('get_setting') 
                                        ? get_setting('contact_phone', get_setting('owner_phone', '+91 7021247655')) 
                                        : '+91 7021247655';
                                    $cleanFooterPhone = function_exists('clean_phone_number') 
                                        ? clean_phone_number($footerPhone) 
                                        : preg_replace('/[^0-9]/', '', $footerPhone);
                                    $footerEmail = function_exists('get_setting') 
                                        ? get_setting('contact_email', get_setting('owner_email', 'teknolite@gmail.com')) 
                                        : 'teknolite@gmail.com';
                                    $footerWebsite = function_exists('get_setting') 
                                        ? get_setting('contact_website', 'https://teknolite.in') 
                                        : 'https://teknolite.in';
                                    $footerAddress = function_exists('get_setting') 
                                        ? get_setting('address', 'Plot No. 42, Marol Industrial Area, Andheri East') 
                                        : 'Plot No. 42, Marol Industrial Area, Andheri East';
                                    $footerCity = function_exists('get_setting') 
                                        ? get_setting('city', 'Mumbai') 
                                        : 'Mumbai';
                                    $footerZip = function_exists('get_setting') 
                                        ? get_setting('zipcode', '400059') 
                                        : '400059';
                                ?>
                                <div class="footer-logo mb_24">
                                    <a href="<?= base_url(); ?>">
                                        <img src="<?= $footerLogoUrl; ?>"
                                             alt="<?= html_escape($footerStoreName); ?>"
                                             style="max-height: 48px; width: auto; max-width: 200px; object-fit: contain; display: block;">
                                    </a>
                                </div>

                                <h4 class="text_white number">
                                    <a href="tel:<?= $cleanFooterPhone ? '+' . $cleanFooterPhone : '+917021247655'; ?>" class="link text_white">
                                        <?= html_escape($footerPhone); ?>
                                    </a>
                                </h4>

                                <h4 class="text_white mail">
                                    <a href="mailto:<?= html_escape($footerEmail); ?>" class="link text_white">
                                        <?= html_escape($footerEmail); ?>
                                    </a>
                                </h4>

                                <p class="text-body-default mb_4">
                                    <a href="<?= html_escape($footerWebsite); ?>" target="_blank" rel="noopener" class="link text_white">
                                        <?= html_escape(preg_replace('#^https?://#', '', rtrim($footerWebsite, '/'))); ?>
                                    </a>
                                </p>

                                <p class="text-body-default text_white mb-0">
                                    <i class="icon icon-location"></i>
                                    <?= html_escape($footerAddress . ($footerCity ? ', ' . $footerCity : '') . ($footerZip ? ' - ' . $footerZip : '')); ?>
                                </p>

                        

                            <!-- SOCIAL MEDIA -->
                            <ul class="tf-social-icon type-2 pt-5">
                                <?php if ($fFb = get_setting('social_facebook', 'https://www.facebook.com/TeknoliteIndia')): ?>
                                <li>
                                    <a href="<?= html_escape($fFb); ?>"
                                        target="_blank" rel="noopener"
                                        aria-label="Facebook"
                                        class="social-facebook">
                                        <i class="icon icon-facebook"></i>
                                    </a>
                                </li>
                                <?php endif; ?>

                                <?php if ($fInsta = get_setting('social_instagram', 'https://www.instagram.com/teknolite_india')): ?>
                                <li>
                                    <a href="<?= html_escape($fInsta); ?>"
                                        target="_blank" rel="noopener"
                                        aria-label="Instagram"
                                        class="social-instagram">
                                        <i class="icon icon-instagram"></i>
                                    </a>
                                </li>
                                <?php endif; ?>

                                <?php if ($fLinkedin = get_setting('social_linkedin', 'https://www.linkedin.com/company/teknovision-pvt-ltd')): ?>
                                <li>
                                    <a href="<?= html_escape($fLinkedin); ?>"
                                        target="_blank" rel="noopener"
                                        aria-label="LinkedIn"
                                        class="social-linkedin">
                                        <i class="icon icon-linkedin"></i>
                                    </a>
                                </li>
                                <?php endif; ?>

                                <?php if ($fTwitter = get_setting('social_twitter', '')): ?>
                                <li>
                                    <a href="<?= html_escape($fTwitter); ?>"
                                        target="_blank" rel="noopener"
                                        aria-label="Twitter / X"
                                        class="social-twitter">
                                        <i class="icon icon-x"></i>
                                    </a>
                                </li>
                                <?php endif; ?>

                                <?php if ($fYoutube = get_setting('social_youtube', '')): ?>
                                <li>
                                    <a href="<?= html_escape($fYoutube); ?>"
                                        target="_blank" rel="noopener"
                                        aria-label="YouTube"
                                        class="social-youtube">
                                        <i class="icon icon-youtube"></i>
                                    </a>
                                </li>
                                <?php endif; ?>

                                <?php if ($fPinterest = get_setting('social_pinterest', '')): ?>
                                <li>
                                    <a href="<?= html_escape($fPinterest); ?>"
                                        target="_blank" rel="noopener"
                                        aria-label="Pinterest"
                                        class="social-pinterest">
                                        <i class="icon icon-pinterest"></i>
                                    </a>
                                </li>
                                <?php endif; ?>
                            </ul>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- FOOTER BOTTOM -->
    <div class="footer-bottom">

        <div class="container">

            <div class="row">

                <div class="col-12">

                    <div class="footer-bottom-wrap">

                        <!-- COPYRIGHT -->
                        <div class="left">

                            <p class="text-body-default text_white">
                                Copyright © 2026 TeknoLite. All Rights Reserved.
                            </p>

                        </div>


                        <!-- LEGAL LINKS -->
                        <div class="center">

                            <div class="footer-bottom-links">

                                <a href="<?= base_url('privacy-policy'); ?>"
                                    class="link text_white">
                                    Privacy Policy
                                </a>

                                <span class="text_white">|</span>

                                <a href="<?= base_url('terms-conditions'); ?>"
                                    class="link text_white">
                                    Terms & Conditions
                                </a>

                            </div>

                        </div>


                        <!-- WEBSITE -->
                        <div class="right">

                            <a href="<?= base_url(); ?>"
                                class="link text_white">
                                www.teknolite.in
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</footer>

<!-- Product enquiry modal shared by product cards and product detail pages -->
<div class="modal fade modal-search" id="enquiryForm" tabindex="-1" aria-labelledby="enquiryFormTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enquiryFormTitle">Product Enquiry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form-enquiry" id="formEnquiry" action="<?= site_url('welcome/submit'); ?>" method="post">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="d-flex align-items-center gap-3 border-bottom pb-3">
                                <img id="enquiryProductImage" src="<?= base_url('assets/images/products/gamma.png'); ?>" alt="Product" width="72" height="72" style="object-fit:cover;">
                                <div>
                                    <h6 id="enquiryProductName" class="mb-1">Product enquiry</h6>
                                    <small id="enquiryProductCategory" class="text_secondary"></small>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="product_name" id="enquiry_product_name">
                        <input type="hidden" name="product_image" id="enquiry_product_image">
                        <input type="hidden" name="product_category" id="enquiry_product_category">
                        <input type="hidden" name="product_url" id="enquiry_product_url">
                        <input type="hidden" name="subject" id="enquiry_subject">
                        <div class="col-md-6">
                            <label class="form-label" for="enquiry_name">Name *</label>
                            <input class="form-control" id="enquiry_name" name="name" type="text" required maxlength="100" pattern="[A-Za-z .'-]{2,100}" autocomplete="name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="enquiry_email">Email *</label>
                            <input class="form-control" id="enquiry_email" name="email" type="email" required maxlength="150" autocomplete="email">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="enquiry_mobile">Phone number *</label>
                            <input class="form-control" id="enquiry_mobile" name="mobile" type="tel" required maxlength="20" pattern="[0-9+() .-]{7,20}" autocomplete="tel">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="enquiry_quantity">Quantity *</label>
                            <input class="form-control" id="enquiry_quantity" name="quantity" type="number" min="1" max="999999" step="1" value="1" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="enquiry_company">Company / Profession</label>
                            <input class="form-control" id="enquiry_company" name="company" type="text" maxlength="150">
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="enquiry_message">Message *</label>
                            <textarea class="form-control" id="enquiry_message" name="message" rows="4" minlength="10" maxlength="2000" required placeholder="Tell us about your requirement"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="tf-btn btn-white has-border" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="tf-btn btn-onsurface">Send Enquiry <i class="icon-arrow-up-right"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Shared project quote popup -->
<div class="modal fade modal-search" id="quoteForm" tabindex="-1" aria-labelledby="quoteFormTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quoteFormTitle">Request a Project Quote</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="projectQuoteForm" action="<?= site_url('welcome/submit'); ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="product_name" value="Project Quote Request">
                    <input type="hidden" name="product_category" value="Project Consultation">
                    <input type="hidden" name="product_url" value="<?= base_url(); ?>">
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="subject" value="Project Quote Request">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="quote_name">Name *</label>
                            <input class="form-control" id="quote_name" name="name" type="text" maxlength="100" minlength="2" pattern="[A-Za-z .'-]{2,100}" autocomplete="name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="quote_email">Email *</label>
                            <input class="form-control" id="quote_email" name="email" type="email" maxlength="150" autocomplete="email" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="quote_mobile">Phone number *</label>
                            <input class="form-control" id="quote_mobile" name="mobile" type="tel" maxlength="20" pattern="[0-9+() .-]{7,20}" autocomplete="tel" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="quote_company">Company / Profession</label>
                            <input class="form-control" id="quote_company" name="company" type="text" maxlength="150">
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="quote_message">Project requirements *</label>
                            <textarea class="form-control" id="quote_message" name="message" rows="5" minlength="10" maxlength="2000" placeholder="Tell us about your project, lighting requirements, quantity, and timeline" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="tf-btn btn-white has-border" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="tf-btn btn-onsurface">Send Quote Request <i class="icon-arrow-up-right"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $(document).on('click', '[data-bs-target="#enquiryForm"]', function () {
            var trigger = $(this);
            var productSource = trigger.is('[data-product-name]')
                ? trigger
                : trigger.closest('[data-product-name]');
            var product = {
                name: productSource.attr('data-product-name') || 'TeknoLite LED Light',
                image: productSource.attr('data-product-image') || '<?= base_url('assets/images/products/gamma.png'); ?>',
                category: productSource.attr('data-product-category') || '',
                url: productSource.attr('data-product-url') || '<?= base_url('productdetail'); ?>'
            };
            $('#enquiryProductName').text(product.name);
            $('#enquiryProductCategory').text(product.category);
            $('#enquiryProductImage').attr({src: product.image, alt: product.name});
            $('#enquiry_product_name').val(product.name);
            $('#enquiry_product_image').val(product.image);
            $('#enquiry_product_category').val(product.category);
            $('#enquiry_product_url').val(product.url);
            $('#enquiry_subject').val('Product Enquiry - ' + product.name);
            $('#enquiry_quantity').val(trigger.attr('data-product-quantity') || productSource.attr('data-product-quantity') || $('#productQuantity').val() || 1);
            $('#enquiry_message').val('I am interested in ' + product.name + '. Please share pricing and availability.');
        });
    });
</script>

<?php
// Resolve WhatsApp contact number dynamically from settings
$footerSettings = [];
if (class_exists('CI_Controller')) {
    $CI =& get_instance();
    if (!isset($CI->settings_model)) {
        $CI->load->model('Settings_model', 'settings_model');
    }
    $footerSettings = $CI->settings_model->getAllKeyValues();
}
$waRawNum = !empty($footerSettings['contact_whatsapp']) 
    ? $footerSettings['contact_whatsapp'] 
    : (!empty($footerSettings['contact_phone']) ? $footerSettings['contact_phone'] : '917021247619');
$waCleanNum = preg_replace('/[^0-9]/', '', $waRawNum);
if (empty($waCleanNum)) {
    $waCleanNum = '917021247619';
}
?>
<!-- Floating WhatsApp (Positioned Directly Above Scroll Top) -->
<a href="https://wa.me/<?= $waCleanNum; ?>?text=<?= urlencode('Hello TeknoLite, I would like to enquire about your lighting products and solutions.'); ?>"
   target="_blank"
   rel="noopener noreferrer"
   class="floating-whatsapp-btn"
   id="floatingWhatsappBtn"
   title="Chat with TeknoLite on WhatsApp"
   aria-label="Chat with TeknoLite on WhatsApp">
    <span class="whatsapp-tooltip">Chat with us on WhatsApp</span>
    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M17.507 14.307C17.185 14.146 15.608 13.369 15.313 13.262C15.019 13.155 14.805 13.101 14.59 13.423C14.376 13.744 13.76 14.467 13.572 14.682C13.385 14.896 13.197 14.923 12.876 14.762C12.554 14.601 11.517 14.261 10.287 13.165C9.329 12.311 8.682 11.258 8.495 10.936C8.307 10.615 8.475 10.441 8.636 10.281C8.781 10.137 8.959 9.904 9.12 9.717C9.281 9.529 9.335 9.395 9.442 9.181C9.549 8.967 9.496 8.779 9.415 8.618C9.335 8.457 8.692 6.877 8.424 6.234C8.163 5.607 7.898 5.692 7.7 5.683C7.512 5.674 7.298 5.674 7.084 5.674C6.869 5.674 6.521 5.755 6.226 6.076C5.932 6.398 5.101 7.175 5.101 8.757C5.101 10.339 6.253 11.867 6.414 12.081C6.575 12.296 8.68 15.535 11.902 16.927C12.669 17.258 13.269 17.457 13.735 17.605C14.505 17.85 15.205 17.815 15.759 17.732C16.377 17.64 17.659 16.955 17.927 16.178C18.195 15.401 18.195 14.731 18.115 14.597C18.034 14.463 17.829 14.383 17.507 14.307Z" fill="white"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12C2 13.821 2.487 15.529 3.337 17.005L2.072 21.625C2.015 21.834 2.074 22.058 2.227 22.211C2.348 22.332 2.511 22.4 2.678 22.4C2.748 22.4 2.819 22.388 2.887 22.362L7.33 20.655C8.75 21.517 10.322 22 12 22C17.523 22 22 17.523 22 12C22 6.477 17.523 2 12 2ZM3.818 12C3.818 7.481 7.481 3.818 12 3.818C16.519 3.818 20.182 7.481 20.182 12C20.182 16.519 16.519 20.182 12 20.182C10.519 20.182 9.124 19.789 7.915 19.102L7.545 18.892L4.316 20.126L5.241 16.749L4.981 16.335C4.238 15.15 3.818 13.626 3.818 12Z" fill="white"/>
    </svg>
</a>

<div class="tf-toolbar-bottom">
            <div class="toolbar-item">
                <a href="<?= base_url('product'); ?>">
                    <div class="toolbar-icon">
                        <span class="icon icon-squaresfour"></span>    
                    </div>
                    <div class="toolbar-label">Shop</div>
                </a>
            </div>
            <div class="toolbar-item">
                <a href="#search" data-bs-toggle="modal">
                    <div class="toolbar-icon">
                        <span class="icon icon-search"></span>                            
                    </div>
                    <div class="toolbar-label">Search</div>
                </a>
            </div>
            <div class="toolbar-item">
                <?php if ($this->session->userdata('logged_in')): ?>
                <a href="#wishlistModal" data-bs-toggle="modal" class="wishlist-trigger" aria-label="Open wishlist">
                    <div class="toolbar-icon">
                        <span class="icon icon-heart"></span>  
                        <span class="count-box wishlist-count">0</span>
                    </div>
                    <div class="toolbar-label">Wishlist</div>
                </a>
                <?php endif; ?>
            </div>
            <div class="toolbar-item">
                <a href="#shoppingCart" data-bs-toggle="modal">
                    <div class="toolbar-icon">
                        <span class="icon icon-cart"></span>  
                    </div>
                    <div class="toolbar-label">Cart</div>
                </a>
            </div>
        </div>