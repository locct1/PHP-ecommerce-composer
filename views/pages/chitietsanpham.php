<?php $this->layout("layouts/frontend/default", ["title" => APPNAME]) ?>
<?php $this->start("page_specific_css") ?>
<style>
    .breadcrumb-section {
        margin-bottom: 60px;
    }

    .breadcrumb-section {
        margin-bottom: 60px;
    }

    .featured {
        padding-top: 0px;
    }

    .product-details {
        padding-top: 0px;
    }

    .con {
        position: relative;

    }

    .con p {
        display: none;
    }
    .contentchitiet {
        text-align: center;
        position: absolute;
        width: 95.5%;
        height: 129px;
        background: linear-gradient(to bottom, rgb(255 255 255 / 0%), rgba(255 255 255/62.5), rgba(255 255 255/1));
        border-radius: 5px;
        margin-top: -76px;
    }
    .spad {
        padding-top: 23px;
        padding-bottom: 50px;

    }
</style>
<?php $this->stop() ?>

<?php $this->start("page") ?>
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.PNG">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Sản phẩm</h2>
                    <div class="breadcrumb__option">
                        <a href="trang-chu">Trang chủ</a>
                        <a href="thuong-hieu/<?= $this->e($sanpham->thuonghieu->id) ?>"><?= $this->e($sanpham->thuonghieu->th_ten) ?></a>
                        <span><?= $this->e($sanpham->sp_ten) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product-details spad">
    <div id="alert-container" class="alert alert-warning alert-dismissible fade d-none" role="alert">
        <div id="thongbao">&nbsp;</div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form name="frmsanphamchitiet" id="frmsanphamchitiet" method="post" action="">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <input type="hidden" name="sp_ma" id="sp_ma" value="<?= $sanpham->id ?>" />
                            <input type="hidden" name="sp_ten" id="sp_ten" value="<?= $sanpham->sp_ten ?>" />
                            <input type="hidden" name="sp_gia" id="sp_gia" value="<?= $sanpham->sp_gia ?>" />
                            <input type="hidden" name="hinhdaidien" id="hinhdaidien" value="<?= $sanpham->sp_hinhanh ?>" />
                            <img class="product__details__pic__item--large" src="/upload/sanpham/<?= $sanpham->sp_hinhanh ?>" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?= $this->e($sanpham->sp_ten) ?></h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(989 reviews)</span>
                        </div>
                        <div class="product__details__price">Giá:
                            <?php if ($sanpham->sp_giacu != 0) { ?>
                                <?php echo number_format($sanpham->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                <span style="text-decoration: line-through; color:#6c757d; font-weight:300;">
                                    <?php echo number_format($sanpham->sp_giacu, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                </span>
                            <?php } else { ?>
                                <?php echo number_format($sanpham->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                            <?php } ?>
                        </div>
                        <div class="mtn">
                            <p style="font-weight:bold;">Nhận khuyến mãi đặt biệt</p>
                            <hr>
                            <div class="khuyenmai">
                                <?= $sanpham->sp_km ?>
                            </div>
                            <br>
                        </div>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" name="soluong" id="soluong" value="1">
                                </div>
                            </div>
                        </div>
                        <a href="#" class="primary-btn" id="btnThemVaoGioHang">Thêm vào giỏ hàng</a>
                        <ul>
                            <li><b>Thương hiệu</b> <span><?= $this->e($sanpham->thuonghieu->th_ten) ?></span></li>
                            <li><b>Số lượng</b> <span><?= $this->e($sanpham->sp_soluong) ?></span></li>
                            <li><b>Vận chuyển</b> <span>Trong ngày <samp>Miễn phí vận chuyển ngay hôm nay</samp></span></li>
                            <li><b>Chia sẻ</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <hr>
            <div class="row">

                <div class="col-lg-7 noibat">
                    <br>
                    <h5 style="font-size:27px;font-weight:600;color:#d70018">ĐẶT ĐIỂM NỔI BẬT</h5>
                    <br>
                    <div class="con">
                        <?= $sanpham->sp_mtct ?>
                        <div class="contentchitiet"> <a href="#" id="loadMore">Đọc thêm <i class="fa fa-angle-down"></i></a></a></div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <h5 style="font-size:27px;font-weight:600; margin-top: 18px;">Thông số kỹ thuật</h5>
                    <br>
                    <div class="table table-striped"> <?= ($sanpham->sp_tskt) ?></div>
                </div>

            </div>
        </div>
    </form>
</section>
<!-- Section product begin -->
<?php include_once __DIR__ . '/../layouts/frontend/section_product.php'  ?>
<!-- section product end -->
<?php $this->stop() ?>
<?php $this->start("page_specific_js") ?>
<script>
    $(function() {
        $(".con p").slice(0, 4).show();
        $("#loadMore").on('click', function(e) {
            e.preventDefault();
            $(".con p:hidden").slice(0, 1000).slideDown();
            if ($(".con p:hidden").length == 0) {
                $("#load").fadeOut('slow');
                $("#loadMore").remove();
                $(".contentchitiet").remove();
            }
            $('.con,.con').animate({
                scrollTop: $(this).offset().top
            }, 2000);
        });
    });
</script>

<?php $this->stop() ?>