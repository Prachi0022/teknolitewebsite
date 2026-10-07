<?php
// Dynamic WhatsApp number from settings
$ctaSettings = [];
if (class_exists('CI_Controller')) {
    $CI =& get_instance();
    if (!isset($CI->settings_model)) {
        $CI->load->model('Settings_model', 'settings_model');
    }
    $ctaSettings = $CI->settings_model->getAllKeyValues();
}
$ctaWaRaw = !empty($ctaSettings['contact_whatsapp']) 
    ? $ctaSettings['contact_whatsapp'] 
    : (!empty($ctaSettings['contact_phone']) ? $ctaSettings['contact_phone'] : '917021247619');
$ctaWaClean = preg_replace('/[^0-9]/', '', $ctaWaRaw);
if (empty($ctaWaClean)) {
    $ctaWaClean = '917021247619';
}
?>
<!-- =====================================================
     TEKNOLITE CONNECT CTA SECTION
====================================================== -->
<section class="flat-spacing-2 pt-0 teknolite-connect">
    <div class="container">

        <!-- Heading -->
        <div class="connect-heading text-center">
            <h3 class="wow fadeInUp">
                Connect with TeknoLite
            </h3>
            <p class="text-body-default text_secondary wow fadeInUp" data-wow-delay="0.1s">
                Discover smarter lighting solutions with expert guidance.
            </p>
        </div>

        <div class="row g-4">

            <!-- VISIT / CONTACT -->
            <div class="col-lg-6">
                <div class="connect-card connect-card-light connect-card-expert wow fadeInUp" data-wow-delay="0.1s">
                    <div class="connect-card-bg" style="background-image: url('<?= base_url('assets/images/banner/commercial.jpeg'); ?>');"></div>
                    <div class="connect-card-overlay"></div>
                    <div class="connect-card-inner">
                        <h4>
                            Talk to Our Lighting Expert
                        </h4>
                        <p class="text-body-default text_secondary">
                            Get expert guidance to choose the right LED lighting
                            solutions for your commercial, architectural or industrial project.
                        </p>
                        <a href="<?= base_url('contact'); ?>" class="connect-btn connect-btn-dark">
                            <span>Talk to Our Expert</span>
                            <i class="icon-arrow-up-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- WHATSAPP -->
            <div class="col-lg-6">
                <div class="connect-card connect-card-consult wow fadeInUp" data-wow-delay="0.2s">
                    <div class="connect-card-bg" style="background-image: url('<?= base_url('assets/images/banner/insights1.jpg'); ?>');"></div>
                    <div class="connect-card-overlay"></div>
                    <div class="connect-card-inner">
                        <h4>
                            Need a Quick Consultation?
                        </h4>
                        <p class="text-body-default text_secondary">
                            Connect with our team on WhatsApp for product enquiries,
                            project requirements and lighting recommendations.
                        </p>
                        <a href="https://wa.me/<?= $ctaWaClean; ?>?text=<?= urlencode('Hello TeknoLite, I would like to enquire about your lighting products and solutions.'); ?>" target="_blank" rel="noopener noreferrer"
                            class="connect-btn connect-btn-whatsapp">
                            <span class="icon icon-whatsapp"></span>
                            <span>Chat on WhatsApp</span>
                            <i class="icon-arrow-up-right"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- REQUEST QUOTE -->
        <div class="connect-quote text-center wow fadeInUp" data-wow-delay="0.3s">
            <span>Planning a lighting project?</span>
            <a href="#quoteForm" class="btn-line" data-bs-toggle="modal" data-bs-target="#quoteForm">
                <span>Request a Quote</span>
                <i class="icon-arrow-up-right"></i>
            </a>
        </div>

    </div>
</section>