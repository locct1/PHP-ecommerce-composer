<section class="hero hero-normal" id="sidebar">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Thương hiệu</span>
                    </div>
                    <ul>
                        <?php foreach ($_SESSION['thuonghieu'] as $th) : ?>
                            <li class="zoomm"><a href="thuong-hieu/<?= $this->e($th->id) ?>"><img src="/upload/thuonghieu/<?= $this->e($th->th_hinhanh) ?>" alt=""></a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="tim-kiem" method="POST">
                            <input type="text" placeholder="Bạn cần tìm sản phẩm nào?" id="search_data" class="form-control input-lg ui-autocomplete-input" name="tukhoa" required>
                            <button type="submit" class="site-btn" name="timkiem"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>0939131275</h5>
                            <span>Hỗ trợ 24/7</span>
                        </div>
                    </div>
                </div>
                <?= $this->section("slide") ?>
            </div>
        </div>
    </div>
</section>