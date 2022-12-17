<?php $this->layout("layouts/frontend/default", ["title" => APPNAME]) ?>
<?php $this->start("page") ?>
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.PNG">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Đăng ký</h2>
                    <div class="breadcrumb__option">
                        <a href="trang-chu">Trang chủ</a>
                        <span>Đăng ký</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container mt-3 mb-3">
    <div class="row">
        <div class="col-6 offset-3">
             <?php if (isset($errors)) { ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $err) : ?>
                        <?=  $err ?> <br>
                    <?php endforeach ?>
                </div>
            <?php } ?> 
            <form id="dangKy" action="dang-ky" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="font-weight-bold">Họ và tên:</label>
                    <input type="text" name="name" value="<?=isset($old['name']) ? $this->e($old['name']) : '' ?>" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Nhập họ và tên">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="font-weight-bold">Email:</label>
                    <input type="email" name="email"value="<?=isset($old['email']) ? $this->e($old['email']) : '' ?>" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Nhập email">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="font-weight-bold">Địa chỉ:</label>
                    <input type="text" name="address" value="<?=isset($old['address']) ? $this->e($old['address']) : '' ?>" class="form-control" id="address" aria-describedby="emailHelp" placeholder="Nhập địa chỉ">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="font-weight-bold">Số điện thoại:</label>
                    <input type="text" name="phone" value="<?=isset($old['phone']) ? $this->e($old['phone']) : '' ?>" class="form-control" id="phone" aria-describedby="emailHelp" placeholder="Nhập số điện thoại">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="font-weight-bold">Mật khẩu:</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Nhập mật khẩu">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="font-weight-bold">Nhập lại mật khẩu:</label>
                    <input type="password" name="passwordAgain" class="form-control" id="passwordAgain" placeholder="Nhập mật khẩu">
                </div>
                <button type="submit" class="btn btn-primary">Đăng ký</button>
            </form>
        </div>
    </div>
</div>
<?php $this->stop() ?>
<?php $this->start("page_specific_js") ?>
<script>
    $(document).ready(function() {
        $("#dangKy").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 6
                },
                email: {
                    required: true,
                    email: true
                },
                address: {
                    required: true,
                    minlength: 5
                },
                phone: {
                    required: true,
                    minlength: 10
                },
                password: {
                    required: true,
                    minlength: 5
                },
                passwordAgain: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password",
                },
            },
            messages: {
                name: {
                    required: "Bạn chưa nhập vào họ tên",
                    minlength: "Họ và tên phải có ít nhất 6 ký tự",
                },
                email: {
                    required: "Bạn chưa email",
                    email: "Email không hợp lệ",
                },
                address: {
                    required: "Bạn chưa nhập vào địa chỉ",
                    minlength: "Địa chỉ phải có ít nhất 5 ký tự",
                },
                phone: {
                    required: "Bạn chưa nhập vào số điện thoại",
                    minlength: "Số điện thoại phải có ít nhất 10 ký tự",
                },
                password: {
                    required: "Bạn chưa nhập mật khẩu",
                    minlength: "Mật khẩu phải có ít nhất 5 ký tự",
                },
                passwordAgain: {
                    required: "Bạn chưa nhập mật khẩu",
                    minlength: "Mật khẩu phải có ít nhất 5 ký tự",
                    equalTo: "Mật khẩu không trùng khớp với mật khẩu đã nhập",
                },
            },
            errorElement: "div",
            errorPlacement: function(error, element) {
                error.addClass("invalid-feedback");
                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.siblings("label"));
                } else {
                    error.insertAfter(element);
                }
            },
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