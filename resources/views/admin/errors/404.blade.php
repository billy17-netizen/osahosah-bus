<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="sm-hover"
      data-sidebar-image="none" data-preloader="enable" data-theme="default" data-theme-colors="default"
      data-layout-mode="dark" data-bs-theme="dark">
<head>

    <meta charset="utf-8"/>
    <title>OsahOsahBus - Booking Bus</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="Themesbrand" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('frontend/assets/img/logo.png')}}">

    <!-- jsvectormap css -->
    <link href="{{asset('admin/assets/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css"/>

    <!--Swiper slider css-->
    <link href="{{asset('admin/assets/libs/swiper/swiper-bundle.min.css')}}" rel="stylesheet" type="text/css"/>

    <!-- Filepond css -->
    <link rel="stylesheet" href="{{asset('admin/assets/libs/filepond/filepond.min.css')}}" type="text/css"/>
    <link rel="stylesheet"
          href="{{asset('admin/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css')}}">
    <!-- Layout config Js -->
    <script src="{{asset('admin/assets/js/layout.js')}}"></script>
    <!-- Bootstrap Css -->
    <link href="{{asset('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="{{asset('admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="{{asset('admin/assets/css/app.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- custom Css-->
    <link href="{{asset('admin/assets/css/custom.min.css')}}" rel="stylesheet" type="text/css"/>
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"/>
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <!-- Sweet Alert css-->
    <link href="{{asset('admin/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Toastr css-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"
          type="text/css"/>


</head>

<body>

<div class="auth-page-wrapper pt-5">
    <!-- auth page bg -->
    <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
        <div class="bg-overlay"></div>

        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1"
                 viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg>
        </div>
    </div>

    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center pt-4">
                        <div class="">
                            <img src="{{asset('admin/assets/images/error.svg')}}" alt=""
                                 class="error-basic-img move-animation">
                        </div>
                        <div class="mt-n4">
                            <h1 class="display-1 fw-medium">404</h1>
                            <h3 class="text-uppercase">Sorry, Page not Found 😭</h3>
                            <p class="text-muted mb-4">The page you are looking for not available!</p>
                            <a href="javascript:void(0);" onclick="window.history.back();" class="btn btn-success"><i
                                    class="mdi mdi-home me-1"></i>Back to
                                home</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->
    <footer class="footer galaxy-border-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0 text-muted">&copy;
                            <script>document.write(new Date().getFullYear())</script>
                            OsahBus. Crafted with <i class="mdi mdi-heart text-danger"></i> by Billy
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->

</div>
<!-- end auth-page-wrapper -->

<!-- JAVASCRIPT -->
<script src="{{asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('admin/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('admin/assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('admin/assets/libs/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('admin/assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
<script src="{{asset('admin/assets/js/plugins.js')}}"></script>

<!-- particles js -->
<script src="{{asset('admin/assets/libs/particles.js/particles.js')}}"></script>
<!-- particles app js -->
<script src="{{asset('admin/assets/js/pages/particles.app.js')}}"></script>

</body>

</html>
