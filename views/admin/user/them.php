<?php $this->layout("layouts/admin/default", ["title" => APPNAME]) ?>

<?php $this->start("page") ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" style="text-align:center">Thêm tài khoản</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php if (isset($_SESSION['msg_them'])) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo ($_SESSION['msg_them']);
                    unset($_SESSION['msg_them']);  ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>
            <?php if (isset($errors)) { ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $err) : ?>
                        <?= $err ?> <br>
                    <?php endforeach ?>
                </div>
            <?php } ?>
            <form id="dangKy" method="post" action="admin/user/them">
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold"> Tên tài khoản</label>
                    <input type="text" class="form-control" id="name" value="<?= isset($old['name']) ? $this->e($old['name']) : '' ?>" name="name" placeholder="Nhập tên tài khoản">
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold"> Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?= isset($old['email']) ? $this->e($old['email']) : '' ?>" placeholder="Nhập Email">
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold"> Số điện thoại</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?= isset($old['phone']) ? $this->e($old['phone']) : '' ?>" placeholder="Nhập số điện thoại">
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold"> Địa chỉ</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?= isset($old['address']) ? $this->e($old['address']) : '' ?>" placeholder="Nhập số điện chỉ">
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" />
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold">Nhập lại password</label>
                    <input type="password" class="form-control" id="passwordAgain" name="passwordAgain" placeholder="Nhập mật khẩu" />
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold">Quyền người dùng</label>
                  
                        <input name="quyen" value="1" type="radio" <?php if(isset($old['quyen']) && $old['quyen']==0 ): echo ''; ?> <?php else : echo 'checked' ?> <?php endif; ?>  >  <label>Admin
                    </label>
                 
                        <input name="quyen" <?php if(isset($old['quyen']) && $old['quyen']==0 ): echo 'checked'; ?> <?php endif; ?>  value="0" type="radio">   <label >Thường
                    </label>
                </div>
                <button class="btn btn-primary" name="btnSave">Thêm</button>
                <a href="admin/user/danhsach" class="btn btn-secondary" name="comeback">Trở về </a>
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
                quyen: "required"
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
                quyen: {
                    required: "Vui lòng cho quyền người dùng",
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