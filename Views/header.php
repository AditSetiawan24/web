<head>
    <meta charset="utf-8">
    <title>Logistica - Shipping Company Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="<?= base_url('img/favicon.ico')?>" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Roboto:wght@500;700&display=swap">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="<?= base_url('lib/animate/animate.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('lib/owlcarousel/assets/owl.carousel.min.css')?>">

    <!-- Customized Bootstrap Stylesheet -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css')?>">

    <!-- Template Stylesheet -->
    <link rel="stylesheet" href="<?= base_url('css/style.css')?>">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow border-top border-5 border-primary sticky-top p-0">
        <a href="<?= base_url('/') ?>" class="navbar-brand bg-primary d-flex align-items-center px-4 px-lg-5">
            <h2 class="mb-2 text-white">One Shipment</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="<?=base_url('/')?>" class="nav-item nav-link <?= uri_string() == '/' || uri_string() == '' ? 'active' : '' ?>">Home</a>
                <a href="<?=base_url('about')?>" class="nav-item nav-link <?= uri_string() == 'about' ? 'active' : '' ?>">About</a>
                <a href="<?=base_url('services')?>" class="nav-item nav-link <?= uri_string() == 'services' ? 'active' : '' ?>">Services</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle <?= in_array(uri_string(), ['price', 'feature', 'team', 'testimonial']) ? 'active' : '' ?>" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu fade-up m-0">
                        <a href="<?=base_url('price')?>" class="dropdown-item">Warehouse Solution</a>
                        <a href="<?=base_url('team')?>" class="dropdown-item">Our Team</a>
                        <a href="<?=base_url('testimonial')?>" class="dropdown-item">Testimonial</a>
                    </div>
                </div>
                <a href="<?=base_url('contact')?>" class="nav-item nav-link <?= uri_string() == 'contact' ? 'active' : '' ?>">Contact</a>
            </div>
           <?php if (session()->get('ses_Login')): ?>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa fa-user me-1"></i><?= session()->get('ses_Username') ?>
                    </a>
                    <div class="dropdown-menu fade-up m-0">
                        <a href="<?= base_url('shipment/my-orders') ?>" class="dropdown-item">
                            <i class="fa fa-list me-2"></i>Pesanan Saya
                        </a>
                         <a href="<?= base_url('warehouse/my-orders') ?>" class="dropdown-item">
                            <i class="fa fa-warehouse me-2"></i>Pesanan Warehouse
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url('logout') ?>" class="dropdown-item" 
                           onclick="return confirm('Yakin ingin logout?')">
                            <i class="fa fa-sign-out-alt me-2"></i>Logout
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <a href="<?= base_url('login') ?>" class="nav-item nav-link">
                    <i class="fa fa-sign-in-alt me-1"></i>Login
                </a>
            <?php endif; ?>
    </nav>
    <!-- Navbar End -->
