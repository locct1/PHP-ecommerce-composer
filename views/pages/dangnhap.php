<?php $this->layout("layouts/frontend/default", ["title" => APPNAME]) ?>
<?php $this->start("page") ?>
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.PNG">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Đăng nhập</h2>
                    <div class="breadcrumb__option">
                        <a href="trang-chu">Trang chủ</a>
                        <span>Đăng nhập</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container mt-3 mb-3">
    <div class="row">
        <div class="col-6 offset-3">
        <?php if (isset($_SESSION['msg'])) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo ($_SESSION['msg']);
                    unset($_SESSION['msg']);  ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>
            <?php if (isset($errors)) { ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $err) : ?>
                        <?=  $err ?> <br>
                    <?php endforeach ?>
                </div>
            <?php } ?> 
            <form id="dangNhap" action="dang-nhap" method="post">
                <div class="form-group"> 
                    <label for="exampleInputEmail1" class="font-weight-bold">Email:</label>
                    <input type="email" name="email"value="<?=isset($old['email']) ? $this->e($old['email']) : '' ?>" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Nhập email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="font-weight-bold">Mật khẩu:</label>
                    <input type="password" name="password" class="form-control" id="email" placeholder="Nhập mật khẩu">
                </div>
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
            </form>
            <div class="float-right">
                Bạn chưa có tài khoản? <a href="dang-ky" type="button" class="btn btn-primary"> Đăng ký tại đây</a>
            </div>
        </div>
    </div>
</div>
<?php $this->stop() ?>
<?php $this->start("page_specific_js") ?>
<script>
        $(document).ready(function() {
            $("#dangNhap").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                   matkhau: {
                        required: true,
                        minlength: 5
                    },
                },
                messages: {
                    email: {
                        required: "Vui lòng nhập email",
                        email: "Hộp thư điện tử không hợp lệ"
                    },
                    matkhau: {
                        required: "Vui lòng nhập mật khẩu",
                        minlength: "Mật khẩu phải có ít nhất 5 ký tự"
                    },
                },
                errorElement: "em",
                errorPlacement: function(error, element) {
                    error.addClass("invalid-feedback");
                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.parent("label"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                success: function(label, element) {},
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                },
            });
        });
    </script>
<?php $this->stop() ?>