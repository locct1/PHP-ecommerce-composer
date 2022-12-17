<?php $this->layout("layouts/frontend/default", ["title" => APPNAME]) ?>
<?php $this->start("slide") ?>
<?php  include_once __DIR__.'/../layouts/frontend/slide.php'  ?>
<?php $this->stop() ?>
<?php $this->start("banner") ?>
<?php  include_once __DIR__.'/../layouts/frontend/banner.php'  ?>
<?php $this->stop() ?>
<?php $this->start("page") ?>
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Sản phẩm mới nhất</h2>
                </div>
            </div>
        </div>
        <div class="row featured__filter" id="MixItUpBBD782">
            <?php foreach ($sanphammoi as $spm) : ?>
                <div class="col-lg-3 col-md-4 col-sm-6" id="sp">
                    <a href="chi-tiet-san-pham/<?= $this->e($spm->id) ?>">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg zoom" data-setbg="/upload/sanpham/<?= $this->e($spm->sp_hinhanh) ?>">
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="chi-tiet-san-pham/<?= $this->e($spm->id) ?>" class="name-product">
                                <?= $this->e($spm->sp_ten) ?> </a></h6>
                                <?php if ($spm->sp_giacu != 0) { ?>
                                    <h5 style="color:#d70018;" class="gia">
                                        <?php echo number_format($spm->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                        <b style="text-decoration: line-through; color:#6c757d;font-weight:300"> <?= $this->e(number_format($spm->sp_giacu, 0, ".", ",")) . '<sup style="text-decoration:underline">đ</sup>' ?></b>
                                    </h5>
                                <?php } else { ?>
                                    <h5 style="color:#d70018;" class="gia">
                                        <?= $this->e(number_format($spm->sp_gia, 0, ".", ",")) . '<sup style="text-decoration:underline">đ</sup>' ?>
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

<!-- Section product begin -->
<?php  include_once __DIR__.'/../layouts/frontend/section_product.php'  ?>
<!-- section product end -->

<!-- Blog Section Begin -->
<?php $this->stop() ?>
<?php $this->start("page_specific_js") ?>
<script>
    $(document).ready(function() {
        $("#sidebar").removeClass('hero-normal');
    });
</script>

<?php $this->stop() ?>