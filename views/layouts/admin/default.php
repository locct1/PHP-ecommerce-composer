<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="/">
    <title>LKshop</title>

    <!-- Custom fonts for this template-->
    <link href="/admin_asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="/admin_asset/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/admin_asset/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="/admin_asset/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="/admin_asset/css/sweetalert2.min.css" rel="stylesheet">
    <?= $this->section("page_specific_css") ?>
</head>
<style>
    i.fa.fa-circle.active {
        color: green;
    }

    i.fa.fa-circle.inactive {
        color: red;
    }

    .error {
        color: red;
        font-size: 1rem;
        position: relative;
        line-height: 1;
        width: 40.5rem;
    }
</style>
<style>
    #preloder {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 999999;
    background: white;
}

.loader {
    width: 40px;
    height: 40px;
    position: absolute;
    top: 50%;
    left: 50%;
    margin-top: -13px;
    margin-left: -13px;
    border-radius: 60px;
    animation: loader 0.8s linear infinite;
    -webkit-animation: loader 0.8s linear infinite;
}

@keyframes loader {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
        border: 4px solid #f44336;
        border-left-color: transparent;
    }
    50% {
        -webkit-transform: rotate(180deg);
        transform: rotate(180deg);
        border: 4px solid #673ab7;
        border-left-color: transparent;
    }
    100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
        border: 4px solid #f44336;
        border-left-color: transparent;
    }
}

@-webkit-keyframes loader {
    0% {
        -webkit-transform: rotate(0deg);
        border: 4px solid #f44336;
        border-left-color: transparent;
    }
    50% {
        -webkit-transform: rotate(180deg);
        border: 4px solid #673ab7;
        border-left-color: transparent;
    }
    100% {
        -webkit-transform: rotate(360deg);
        border: 4px solid #f44336;
        border-left-color: transparent;
    }
}

</style>
<body id="page-top">
<div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <style>
            .bg-style {
                background-color: #084298 !important;
            }
        </style>
        <ul class="navbar-nav bg-style sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin/dashboard">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">LKshop <sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="admin/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Tổng quan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Quản lý LKshop
            </div>
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="admin/thuonghieu/danhsach">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Quản lý thương hiệu</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin/sanpham/danhsach">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Quản lý sản phẩm</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin/hinhthucthanhtoan/danhsach">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Quản lý hình thức thanh toán</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin/donhang/danhsach">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Quản lý đơn hàng</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin/user/danhsach">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Quản lý tài khoản khách hàng</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <!-- @if(Auth::user())
                                    {{Auth::user()->user_name}}
                                    @endif -->
                                    <?php if (\App\SessionGuard::isUserLoggedIn()) : ?>
                                        <?= $this->e(\App\SessionGuard::user()->name) ?>
                                    <?php endif ?>
                                </span>
                                <img class="img-profile rounded-circle" src="/admin_asset/img/profile.jpg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="admin/user/sua/<?= $this->e(\App\SessionGuard::user()->id) ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cập nhật thông tin
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Đăng xuất
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <?= $this->section("page") ?>


                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; LKshop 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Chọn "Đăng xuất" nếu muốn thoát?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                    <a class="btn btn-primary" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();" href="/logout">Đăng xuất</a>
                    <form id="logout-form" action="/logout" method="POST" style="display: none;">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- <script src="/admin_asset/vendor/datatables/pdfmake.min.js"></script> -->
    <script src="/admin_asset/vendor/datatables/vfs_fonts.js"></script>
    <script src="/admin_asset/vendor/datatables/dataTables.buttons.min.js"></script>
    <script src="/admin_asset/vendor/datatables/buttons.html5.min.js"></script>
    <script src="/admin_asset/vendor/datatables/buttons.print.min.js"></script>
    <script src="/admin_asset/vendor/datatables/jszip.min.js"></script>
    <script src="/admin_asset/js/sweetalert2.all.min.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="/admin_asset/vendor/jquery/jquery.min.js"></script>
    <script src="/admin_asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="/admin_asset/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="/admin_asset/js/sb-admin-2.min.js"></script>
    <script src="/admin_asset/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/admin_asset/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="/admin_asset/js/demo/datatables-demo.js"></script>
    <script src="/admin_asset/js/jquery.validate.js"></script>
    <script src="/admin_asset/vendor/chart.js/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script>

    <!-- Page level plugins -->





    <!-- Page level custom scripts -->

    <script>
        $('#dataTable').DataTable({
            responsive: true,
            // dom: 'Bfrtip',
            // buttons: [
            // 	'copy', 'csv', 'excel', 'pdf', 'print'
            // ],
            order: [
                [0, 'desc']
            ],
            'language': {
                'lengthMenu': "Hiển thị _MENU_ mục từng trang",
                'info': 'Hiển thị _START_ đến _END_ trong số _TOTAL_ mục',
                "emptyTable": "Không có dữ liệu trong bảng",
                "paginate": {
                    "previous": "Trước",
                    "next": "Sau",
                    "infoEmpty": "Không có dữ liệu"
                },
                "search": "Lọc / Tìm kiếm:"
            },
        });
        $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");

        /*------------------
            Gallery filter
        --------------------*/
        $('.featured__controls li').on('click', function () {
            $('.featured__controls li').removeClass('active');
            $(this).addClass('active');
        });
        if ($('.featured__filter').length > 0) {
            var containerEl = document.querySelector('.featured__filter');
            var mixer = mixitup(containerEl);
        }
    });
    </script>
    <?= $this->section("page_specific_js") ?>
</body>

</html>