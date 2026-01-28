<?php
// ================= ACTIVE STATE LOGIC =================
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$segments = explode('/', $uri);

$main  = $segments[0] ?? '';
$sub   = $segments[1] ?? '';
$child = $segments[2] ?? '';

function activeMain($name) {
    global $main;
    return ($main === $name) ? 'active' : '';
}

function activeService($name) {
    global $child;
    return ($child === $name) ? 'act' : '';
}
?>

<header class="site_header site_header_1">
    <div class="header_top text-center">
        <div class="container">
            <p class="m-0">
                Limited Time Offer:
                <b>Get up to 20% off</b> on Design & Website Services
                <a href="/pricing/">
                    <u>View in detail</u>
                    <i class="fa-solid fa-angle-right"></i>
                </a>
            </p>
        </div>
    </div>

    <div class="header_bottom stricky">
        <div class="container">
            <div class="row align-items-center">

                <!-- LOGO -->
                <div class="col-xl-3 col-lg-2 col-5">
                    <div class="site_logo d-flex align-items-center justify-content-end">
                        <a class="site_link" href="/">
                            <img src="/assets/images/site_logo/Logo.svg" alt="Site Logo – Jaiton Technologies">
                        </a>
                    </div>
                </div>

                <!-- MENU -->
                <div class="col-xl-5 col-lg-6 col-2">
                    <nav class="main_menu navbar navbar-expand-lg">
                        <div class="main_menu_inner collapse navbar-collapse justify-content-lg-end" id="main_menu_dropdown">
                            <ul class="main_menu_list unordered_list justify-content-center">

                                <!-- HOME -->
                                <li>
                                    <a class="nav-link <?= ($main == '') ? 'active' : '' ?>" href="/">
                                        Home
                                    </a>
                                </li>

                                <!-- COMPANY -->
                                <li class="dropdown <?= activeMain('company') ?>">
                                    <a class="nav-link" href="#" data-bs-toggle="dropdown">
                                        Company
                                    </a>
                                    <!-- COMPANY MENU (UNCHANGED) -->
                                    <!-- YOUR FULL COMPANY MENU HERE (NO CHANGE) -->
                                </li>

                                <!-- SERVICES -->
                                <li class="dropdown <?= activeMain('services') ?>">
                                    <a class="nav-link" href="#" data-bs-toggle="dropdown">
                                        Services
                                    </a>

                                    <div class="dropdown-menu mega_menu_wrapper p-0">
                                        <div class="container">
                                            <div class="row justify-content-lg-between">

                                                <div class="col-lg-9 service_widget">
                                                    <div class="row">

                                                        <!-- DESIGNING -->
                                                        <div class="col-lg-3">
                                                            <div class="megamenu_widget">
                                                                <h3 class="megamenu_info_title">Designing Services</h3>
                                                                <ul class="icon_list unordered_list_block">
                                                                    <li>
                                                                        <a href="/services/designing-services/ui-ux-designing/"
                                                                           class="<?= activeService('ui-ux-designing') ?>">
                                                                            UI/UX Designing
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="/services/designing-services/product-designing/"
                                                                           class="<?= activeService('product-designing') ?>">
                                                                            Product Designing
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="/services/designing-services/engineering-designing/"
                                                                           class="<?= activeService('engineering-designing') ?>">
                                                                            Engineering Designing
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="/services/designing-services/prototype-designing/"
                                                                           class="<?= activeService('prototype-designing') ?>">
                                                                            Prototype Designing
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="/services/designing-services/multimedia-designing/"
                                                                           class="<?= activeService('multimedia-designing') ?>">
                                                                            Multimedia Designing
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="/services/designing-services/graphics-designing/"
                                                                           class="<?= activeService('graphics-designing') ?>">
                                                                            Graphics Designing
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="/services/designing-services/branding-solutions/"
                                                                           class="<?= activeService('branding-solutions') ?>">
                                                                            Branding Solutions
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <!-- AI / ML -->
                                                        <div class="col-lg-3">
                                                            <div class="megamenu_widget">
                                                                <h3 class="megamenu_info_title">AI & ML implementations</h3>
                                                                <ul class="icon_list unordered_list_block">
                                                                    <li>
                                                                        <a href="/services/ai-ml-implementations/ai-consulting-strategy/">
                                                                            AI Consulting & Strategy
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="/services/ai-ml-implementations/ai-data-micro-services/">
                                                                            AI Data Micro Services
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <!-- IOT -->
                                                        <div class="col-lg-3">
                                                            <div class="megamenu_widget">
                                                                <h3 class="megamenu_info_title">IOT Embedded Systems</h3>
                                                                <ul class="icon_list unordered_list_block">
                                                                    <li>
                                                                        <a href="/services/iot-embedded-systems/iot-consulting-strategy/">
                                                                            IOT Consulting & Strategy
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <!-- CLOUD -->
                                                        <div class="col-lg-3">
                                                            <div class="megamenu_widget">
                                                                <h3 class="megamenu_info_title">Cloud - Driven Applications</h3>
                                                                <ul class="icon_list unordered_list_block">
                                                                    <li>
                                                                        <a href="/services/cloud-driven-applications/custom-web-applications/">
                                                                            Custom Web Applications
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <!-- RIGHT SIDE -->
                                                <div class="col-lg-3 service_widget">
                                                    <div class="megamenu_case serviceMenu bg-primary d-none d-lg-block">
                                                        <h3>Our Recent Case Studies</h3>
                                                        <h4>Association Management Solution</h4>
                                                        <img src="/assets/images/case/Association-Management-software.webp" alt="">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <!-- CONTACT -->
                                <li>
                                    <a class="nav-link <?= activeMain('contact') ?>" href="/contact/">
                                        Contact
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </nav>
                </div>

                <!-- RIGHT BUTTONS -->
                <div class="col-xl-4 col-lg-4 col-5">
                    <ul class="header_btns_group unordered_list justify-content-end">
                        <li>
                            <button class="mobile_menu_btn" data-bs-toggle="collapse"
                                data-bs-target="#main_menu_dropdown">
                                <i class="far fa-bars"></i>
                            </button>
                        </li>
                        <li class="d-none d-lg-block">
                            <a class="btn btn-outline-light" href="#">Sign in</a>
                            <a class="btn estimatebtn" href="#">Estimate Project</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</header>
