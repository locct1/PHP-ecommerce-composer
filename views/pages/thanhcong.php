<?php $this->layout("layouts/frontend/default", ["title" => APPNAME]) ?>
<?php $this->start("page") ?>
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.PNG">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2 style="font-size:28px">Bạn đã đặt hàng thành công <i class="fa fa-check"></i> Cảm ơn bạn, chúng tôi sẽ liên hệ với bạn ngay khi nhận được thông báo đơn hàng.</h2>
                        <div>
                            <a href="xem-don-hang" style="color:white">Xem đơn hàng của bạn tại đây</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $this->stop() ?>
<?php $this->start("page_specific_js") ?>


<?php $this->stop() ?>