<?php $this->layout("layouts/frontend/default", ["title" => APPNAME]) ?>

<?php $this->start("page") ?>
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.PNG">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Tìm kiếm sản phẩm</h2>
                    <div class="breadcrumb__option">
                        <a href="trang-chu">Trang chủ</a>
                        <span>Tìm kiếm sản phẩm</span>
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
                    <h2>Tìm thấy <?= $this->e(count($sanpham)) ?> sản phẩm với kết quả từ khóa "<?= $this->e($tukhoa) ?>" </h2>
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
</section>
<?php $this->stop() ?>
<?php $this->start("page_specific_js") ?>


<?php $this->stop() ?>