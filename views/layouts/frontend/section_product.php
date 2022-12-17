<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="img/banner/banner19.png" alt=""  class="border" style="width:100%;">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="img/banner/banner20.png" alt=""  class="border" style="width:100%;">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Latest Product Section Begin -->
<section class="latest-product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4 style="    font-size: 21.5px;">Sản phẩm mua nhiều</h4>
                    <div class="latest-product__slider owl-carousel owl-loaded owl-drag">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                                <div class="owl-item active" style="width: 360px;">
                                    <div class="latest-prdouct__slider__item">
                                        <?php foreach($sanphammuanhieu as $spmn) :?>
                                        <a href="chi-tiet-san-pham/<?= $this->e($spmn->id) ?>" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="upload/sanpham/<?= $this->e($spmn->sp_hinhanh) ?>" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6 class="name-product"><?= $this->e($spmn->sp_ten) ?></h6>
                                                <?php if ($spmn->sp_giacu != 0) { ?>
                                                    <h5 style="color:#d70018;" class="gia">
                                                        <?php echo number_format($spmn->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                                        <b style="text-decoration: line-through; color:#6c757d;font-weight:300"> <?php echo number_format($spmn->sp_giacu, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?></b>
                                                    </h5>
                                                <?php } else { ?>
                                                    <h5 style="color:#d70018;" class="gia">
                                                        <?php echo number_format($spmn->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                                    </h5>
                                                <?php } ?>
                                            </div>
                                        </a>
                                       <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="owl-item" style="width: 360px;">
                                    <div class="latest-prdouct__slider__item">
                                        <?php foreach($sanphammuanhieu2 as $spmn2) :?>
                                        <a href="chi-tiet-san-pham/<?= $this->e($spmn2->id) ?>" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="upload/sanpham/<?= $this->e($spmn2->sp_hinhanh) ?>" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6 class="name-product"><?= $this->e($spmn2->sp_ten) ?></h6>
                                                <?php if ($spmn2->sp_giacu != 0) { ?>
                                                    <h5 style="color:#d70018;" class="gia">
                                                        <?php echo number_format($spmn2->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                                        <b style="text-decoration: line-through; color:#6c757d;font-weight:300"> <?php echo number_format($spmn2->sp_giacu, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?></b>
                                                    </h5>
                                                <?php } else { ?>
                                                    <h5 style="color:#d70018;" class="gia">
                                                        <?php echo number_format($spmn2->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                                    </h5>
                                                <?php } ?>
                                            </div>
                                        </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span class="fa fa-angle-left"><span></span></span></button><button type="button" role="presentation" class="owl-next"><span class="fa fa-angle-right"><span></span></span></button></div>
                        <div class="owl-dots disabled"></div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4 style="    font-size: 21.5px;">Sản phẩm đánh giá cao</h4>
                    <div class="latest-product__slider owl-carousel owl-loaded owl-drag">
                        <div class="owl-stage-outer">
                            <div class="owl-stage" style="transform: translate3d(-720px, 0px, 0px); transition: all 1.2s ease 0s; width: 2160px;">
                                <div class="owl-item active" style="width: 360px;">
                                    <div class="latest-prdouct__slider__item">
                                        <?php foreach($sanphamdanhgiacao as $dgc) :?>
                                        <a href="chi-tiet-san-pham/<?= $this->e($dgc->id) ?>" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="upload/sanpham/<?= $this->e($dgc->sp_hinhanh) ?>" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6 class="name-product"><?= $this->e($dgc->sp_ten) ?></h6>
                                                <?php if ($dgc->sp_giacu != 0) { ?>
                                                    <h5 style="color:#d70018;" class="gia">
                                                        <?php echo number_format($dgc->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                                        <b style="text-decoration: line-through; color:#6c757d;font-weight:300"> <?php echo number_format($dgc->sp_giacu, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?></b>
                                                    </h5>
                                                <?php } else { ?>
                                                    <h5 style="color:#d70018;" class="gia">
                                                        <?php echo number_format($dgc->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                                    </h5>
                                                <?php } ?>
                                            </div>
                                        </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="owl-item" style="width: 360px;">
                                    <div class="latest-prdouct__slider__item">
                                        <?php foreach($sanphamdanhgiacao2 as $dgc2):?>
                                        <a href="chi-tiet-san-pham/<?= $this->e($dgc2->id) ?>" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="upload/sanpham/<?= $this->e($dgc2->sp_hinhanh) ?>" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6 class="name-product"><?= $this->e($dgc2->sp_ten) ?></h6>
                                                <?php if ($dgc2->sp_giacu != 0) { ?>
                                                    <h5 style="color:#d70018;" class="gia">
                                                        <?php echo number_format($dgc2->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                                        <b style="text-decoration: line-through; color:#6c757d;font-weight:300"> <?php echo number_format($dgc2->sp_giacu, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?></b>
                                                    </h5>
                                                <?php } else { ?>
                                                    <h5 style="color:#d70018;" class="gia">
                                                        <?php echo number_format($dgc2->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                                    </h5>
                                                <?php } ?>
                                            </div>
                                        </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span class="fa fa-angle-left"><span></span></span></button><button type="button" role="presentation" class="owl-next"><span class="fa fa-angle-right"><span></span></span></button></div>
                        <div class="owl-dots disabled"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4 style="    font-size: 21.5px;">Sản phẩm ưu đãi</h4>
                    <div class="latest-product__slider owl-carousel owl-loaded owl-drag">
                        <div class="owl-stage-outer">
                            <div class="owl-stage" style="transform: translate3d(-720px, 0px, 0px); transition: all 1.2s ease 0s; width: 2160px;">
                                <div class="owl-item active" style="width: 360px;">
                                    <div class="latest-prdouct__slider__item">
                                        <?php foreach($sanphamuudai as $ud) :?>
                                        <a href="chi-tiet-san-pham/<?= $this->e($ud->id) ?>" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="upload/sanpham/<?= $this->e($ud->sp_hinhanh) ?>" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6 class="name-product"><?= $this->e($ud->sp_ten) ?></h6>
                                                <?php if ($ud->sp_giacu != 0) { ?>
                                                    <h5 style="color:#d70018;" class="gia">
                                                        <?php echo number_format($ud->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                                        <b style="text-decoration: line-through; color:#6c757d;font-weight:300"> <?php echo number_format($ud->sp_giacu, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?></b>
                                                    </h5>
                                                <?php } else { ?>
                                                    <h5 style="color:#d70018;" class="gia">
                                                        <?php echo number_format($ud->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                                    </h5>
                                                <?php } ?>
                                            </div>
                                        </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="owl-item" style="width: 360px;">
                                    <div class="latest-prdouct__slider__item">
                                        <?php foreach($sanphamuudai2 as $ud2):?>
                                        <a href="chi-tiet-san-pham/<?= $this->e($ud2->id) ?>" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="upload/sanpham/<?= $this->e($ud2->sp_hinhanh) ?>" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6 class="name-product"><?= $this->e($ud2->sp_ten) ?></h6>
                                                <?php if ($ud2->sp_giacu != 0) { ?>
                                                    <h5 style="color:#d70018;" class="gia">
                                                        <?php echo number_format($ud2->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                                        <b style="text-decoration: line-through; color:#6c757d;font-weight:300"> <?php echo number_format($ud2->sp_giacu, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?></b>
                                                    </h5>
                                                <?php } else { ?>
                                                    <h5 style="color:#d70018;" class="gia">
                                                        <?php echo number_format($ud2->sp_gia, 0, ".", ",") . '<sup style="text-decoration:underline">đ</sup>' ?>
                                                    </h5>
                                                <?php } ?>
                                            </div>
                                        </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><span class="fa fa-angle-left"><span></span></span></button><button type="button" role="presentation" class="owl-next"><span class="fa fa-angle-right"><span></span></span></button></div>
                        <div class="owl-dots disabled"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest Product Section End -->