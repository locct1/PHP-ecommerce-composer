<?php $this->layout("layouts/frontend/default", ["title" => APPNAME]) ?>
<?php $this->start("page_specific_css") ?>
<style>
    .col-lg-3.col-md-4.col-sm-6 {
        display: none;
    }

    #loadMore {
        padding: 10px 73px;
        text-align: center;
        background-color: #33739E;
        color: #fff;
        border-width: 0 1px 1px 0;
        border-style: solid;
        border-color: #fff;
        border-radius: 100px;
        box-shadow: 0 1px 1px #ccc;
        transition: all 600ms ease-in-out;
        -webkit-transition: all 600ms ease-in-out;
        -moz-transition: all 600ms ease-in-out;
        -o-transition: all 600ms ease-in-out;
    }

    #loadMore:hover {
        background-color: #fff;
        color: #33739E;
    }

    .breadcrumb-section {
        margin-bottom: 60px;
    }

    .breadcrumb-section {
        margin-bottom: 60px;
    }

    .featured {
        padding-top: 0px;
    }
</style>
<?php $this->stop() ?>

<?php $this->start("page") ?>
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.PNG">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Danh sách sản phẩm</h2>
                    <div class="breadcrumb__option">
                        <a href="trang-chu">Trang chủ</a>
                        <span>Danh sách sản phẩm</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Danh sách sản phẩm </h2>
                </div>
            </div>
        </div>
        <div class="row featured__filter" id="MixItUpBBD782">
            <?php foreach ($sanpham as $sp) : ?>
                <div class="col-lg-3 col-md-4 col-sm-6" id="sp">
                    <a href="chi-tiet-san-pham/<?= $this->e($sp->id) ?>">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg zoom" data-setbg="/upload/sanpham/<?= $this->e($sp->sp_hinhanh) ?>">
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="chi-tiet-san-pham/<?= $this->e($sp->id) ?>" class="name-product">
                                <?= $this->e($sp->sp_ten) ?>  </a></h6>
                                <?php if ($sp->sp_giacu != 0) { ?>
                                    <h5 style="color:#d70018;" class="gia">
                                        <?php echo number_format($sp->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                        <b style="text-decoration: line-through; color:#6c757d;font-weight:300"> <?= $this->e(number_format($sp->sp_giacu, 0, ".", ",")) . '<sup style="text-decoration:underline">đ</sup>' ?></b>
                                    </h5>
                                <?php } else { ?>
                                    <h5 style="color:#d70018;" class="gia">
                                        <?= $this->e(number_format($sp->sp_gia, 0, ".", ",")) . '<sup style="text-decoration:underline">đ</sup>' ?>
                                    </h5>

                                <?php } ?>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <div style="text-align:center"> <a href="#" id="loadMore">Xem thêm <i class="fa fa-angle-down"></i></a></div>
</section>
<?php $this->stop() ?>
<?php $this->start("page_specific_js") ?>
<script>
    $(function() {
        $(".col-lg-3.col-md-4.col-sm-6 ").slice(0, 4).show();
        $("#loadMore").on('click', function(e) {
            e.preventDefault();
            $(".col-lg-3.col-md-4.col-sm-6:hidden").slice(0, 4).slideDown();
            if ($(".col-lg-3.col-md-4.col-sm-6:hidden").length == 0) {
                $("#load").fadeOut('slow');
                $("#loadMore").remove();
            }
            $('body,section').animate({
                scrollTop: $(this).offset().top
            }, 2000);
        });
    });

    $('a[href=#top]').click(function() {
        $('body,html').animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    $(window).scroll(function() {
        if ($(this).scrollTop() > 50) {
            $('.totop a').fadeIn();
        } else {
            $('.totop a').fadeOut();
        }
    });
</script>

<?php $this->stop() ?>