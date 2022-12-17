<?php $this->layout("layouts/frontend/default", ["title" => APPNAME]) ?>


<?php $this->start("page") ?>
<section class="breadcrumb-section set-bg" data-setbg="/img/breadcrumb.PNG">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Liên hệ</h2>
                    <div class="breadcrumb__option">
                        <a href="/LKshop/index.php">Trang chủ</a>
                        <span>Liên hệ</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_phone"></span>
                    <h4>Điện thoại</h4>
                    <p>0939131275</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_pin_alt"></span>
                    <h4>Địa chỉ</h4>
                    <p>phường Tân An, quận Ninh Kiều, thành phố Cần Thơ</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_clock_alt"></span>
                    <h4>Mở cửa</h4>
                    <p>8:00 - 20:00 </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_mail_alt"></span>
                    <h4>Email</h4>
                    <p>LKSHOP@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->
<!-- Map Begin -->
<div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7857.6190115343825!2d105.78224117223914!3d10.032572936125836!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a062a1e057d355%3A0x37125d93f1e50e39!2zVMOibiBBbiwgTmluaCBLaeG7gXUsIEPhuqduIFRoxqEsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1634102127126!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

    <div class="map-inside">
        <i class="icon_pin"></i>
        <div class="inside-widget" style="width:500px">
            <h4>LKshop</h4>
            <ul>
                <li><b>Điện thoại</b>: +65 11.188.888</li>
                <li><b> Địa chỉ</b>: phường Tân An, quận Ninh Kiều, thành phố Cần Thơ</li>
                <li><b>Thời gian làm việc</b> : 8:00 - 20:00 cả thứ 7 và CN, ngày lễ</li>
                <li><b>Website</b> : <span style="color:#d70018">www.LKshop.com.vn</span> </li>
            </ul>
        </div>
    </div>
</div>
<?php $this->stop() ?>
<?php $this->start("page_specific_js") ?>


<?php $this->stop() ?>