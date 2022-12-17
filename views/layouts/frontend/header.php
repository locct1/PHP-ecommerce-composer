    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="trang-chu"><img src="img/logo5.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <!-- <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li> -->
                <li><a href="gio-hang"><i class="fa fa-shopping-bag"></i></a>
            </ul>
            <!-- <div class="header__cart__price">item: <span>$150.00</span></div> -->
        </div>
        <div class="humberger__menu__widget">
            <!-- <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div> -->
        <?php if(isset($_SESSION['kh_id'])) {  ?>
            <div class="header__top__right__auth">
                                <div class="dropdown show">
                                    <a class="dropdown-toggle" style="color: black;" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                   <?= $_SESSION['kh_name'] ?>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="cap-nhat-thong-tin"><i class="fa fa-edit" style="color:black"></i> Cập nhật thông tin</a>
                                        <a class="dropdown-item" href="xem-don-hang"><i class="fa fa-eye"  style="color:black"></i> Xem đơn hàng</a>
                                        <a class="dropdown-item" href="dang-xuat"><i class="fa fa-sign-out"  style="color:black"></i> Đăng xuất</a>
                                    </div>
                                </div>
                            </div>
                         <?php }else{ ?>
            <div class="header__top__right__auth">
                <a href="dang-nhap" style="color: black;"><i class="fa fa-user"></i> Đăng nhập</a>
            </div>
          <?php } ?>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="trang-chu">Trang chủ</a></li>
                <li><a href="danh-sach-san-pham">Sản phẩm</a></li>
                <!-- <li><a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="./shop-details.html">Shop Details</a></li>
                        <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                        <li><a href="./checkout.html">Check Out</a></li>
                        <li><a href="./blog-details.html">Blog Details</a></li>
                    </ul>
                </li> -->
                <li><a href="lien-he">Liên hệ</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook" style="color: black;"></i></a>
            <a href="#"><i class="fa fa-twitter" style="color: black;"></i></a>
            <a href="#"><i class="fa fa-linkedin" style="color: black;"></i></a>
            <a href="#"><i class="fa fa-pinterest-p" style="color: black;"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i>LKSHOP@gmail.com</li>
                <li>Miễn phí vận chuyển cho đơn hàng 15,000,000<sup style="text-decoration:underline">đ</sup></li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> LKSHOP@gmail.com</li>
                                <li>Miễn phí vận chuyển cho đơn hàng 15,000,000<sup style="text-decoration:underline">đ</sup></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <!-- <div class="header__top__right__language">
                                <img src="img/language.png" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Spanis</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div> -->
                            <?php if(isset($_SESSION['kh_id'])) {  ?>
                            <div class="header__top__right__auth">
                                <div class="dropdown show">
                                    <a class="dropdown-toggle" style="color:white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?= $_SESSION['kh_name'] ?>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="cap-nhat-thong-tin"><i class="fa fa-edit" style="color:black"></i> Cập nhật thông tin</a>
                                        <a class="dropdown-item" href="xem-don-hang"><i class="fa fa-eye"  style="color:black"></i> Xem đơn hàng</a>
                                        <a class="dropdown-item" href="dang-xuat"><i class="fa fa-sign-out"  style="color:black"></i> Đăng xuất</a>
                                    </div>
                                </div>
                            </div>
                            <?php }else{ ?>
                                <div class="header__top__right__auth">
                                <a href="dang-nhap" style="color:white"><i class="fa fa-user"></i> Đăng nhập</a>
                                </div>
                                <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="trang-chu"><img src="img/logo5.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="trang-chu">Trang chủ</a></li>
                            <li><a href="danh-sach-san-pham">Sản phẩm</a></li>
                            <!-- <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./shop-details.html">Shop Details</a></li>
                                    <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                                    <li><a href="./checkout.html">Check Out</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li> -->
                            <li><a href="lien-he">Liên hệ</a></li>
                            <!-- <li><a href="./contact.html">Tin tức</a></li> -->
                        </ul>
                    </nav>
                </div>
               <?php 
                if(isset($_SESSION['giohangdata'])){
                    $i=0;
                    $tongtien_giohang=0;
                    foreach($_SESSION['giohangdata'] as $sp){
                        $i++;
                        $tongtien_giohang=$tongtien_giohang+ $sp['thanhtien'];
                    }
                }
              ?>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="gio-hang"><i class="fa fa-shopping-cart text-light" style="font-size:18px;"> Giỏ hàng</i> <span id="soluong_giohang">
                                <?php if(isset($_SESSION['giohangdata'])){ ?>
                               <?= $i ?>
                               <?php }else{ ?>
                                <?= 0 ?>
                              <?php } ?>
                            </span></a></li>
                        </ul>
                        <div class="header__cart__price text-light"><span id="tongtien_giohang">
                       <?php if(isset($_SESSION['giohangdata'])){ ?>
                               <?= number_format($tongtien_giohang, 0, ".", ",") ?><sup style="text-decoration:underline">đ</sup>
                               <?php }else{ ?>
                                0<sup style="text-decoration:underline">đ</sup>
                              <?php } ?>
                    </span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->
    <!-- Hero Section Begin -->