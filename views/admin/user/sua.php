<?php $this->layout("layouts/admin/default", ["title" => APPNAME]) ?>

<?php $this->start("page") ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" style="text-align:center">Sửa tài khoản</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php if (isset($_SESSION['msg_sua'])) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo ($_SESSION['msg_sua']);
                    unset($_SESSION['msg_sua']);  ?>
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
            <form action="/admin/user/sua/<?=$this->e($user['id'])?>" id="capNhatThongTin" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="font-weight-bold">Họ và tên:</label>
                    <input type="text" name="name" class="form-control" value="<?=$this->e($user['name'])?>" id="name" aria-describedby="emailHelp" placeholder="Nhập họ và tên">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="font-weight-bold">Email:</label>
                    <input type="email" name="email"  readonly class="form-control"  value="<?=$this->e($user['email'])?>" id="email" aria-describedby="emailHelp" placeholder="Nhập email">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="font-weight-bold">Địa chỉ: </label>
                    <textarea type="text" name="address" class="form-control" id="address" aria-describedby="emailHelp" placeholder="Nhập địa chỉ"><?=$this->e($user['address'])?></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="font-weight-bold">Số điện thoại:</label>
                    <input type="text" name="phone" class="form-control" id="phone" value="<?=$this->e($user['phone'])?>" aria-describedby="emailHelp" placeholder="Nhập số điện thoại">
                </div>
                <div class="form-group">
                    <input type="checkbox" id="changePassword" name="changePassword">
                    <label class="font-weight-bold">Đổi mật khẩu:</label>
                    <input type="password" disabled="" class="form-control password" name="password" id="password" placeholder="Nhập mật khẩu" />
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="font-weight-bold">Nhập lại mật khẩu:</label>
                    <input type="password" disabled="" name="passwordAgain" class="form-control password" id="passwordAgain" placeholder="Nhập mật khẩu">
                </div>
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold">Quyền người dùng</label>
                  
                        <input name="quyen" value="1" type="radio" <?php if(isset($user['quyen']) && $user['quyen']==1 ): echo 'checked'; ?> <?php else : echo '' ?> <?php endif; ?>  >  <label>Admin
                    </label>
                 
                        <input name="quyen" <?php if(isset($user['quyen']) && $user['quyen']==0 ): echo 'checked'; ?> <?php endif; ?>  value="0" type="radio">   <label >Thường
                    </label>
                </div>
                <button type="submit" class="btn btn-primary" name="btnSave">Sửa</button>
                <a href="admin/user/danhsach" class="btn btn-secondary" name="comeback">Trở về </a>
            </form>
        </div>
    </div>
</div>
<?php $this->stop() ?>

<?php $this->start("page_specific_js") ?>
<script>
    // $(document).ready(function() {
    //     $("#capNhatThongTin").validate({
    //         rules: {
    //             name: {
    //                 required: true,
    //                 minlength: 6
    //             },
    //             address: {
    //                 required: true,
    //                 minlength: 10
    //             },
    //             phone: {
    //                 required: true,
    //                 minlength: 10
    //             },
    //             password: {
    //                 required: true,
    //                 minlength: 5
    //             },
    //             passwordAgain: {
    //                 required: true,
    //                 minlength: 5,
    //                 equalTo: "#password",
    //             },
    //         },
    //         messages: {
    //             name: {
    //                 required: "Bạn chưa nhập vào họ tên",
    //                 minlength: "Họ và tên phải có ít nhất 6 ký tự",
    //             },
    //             address: {
    //                 required: "Bạn chưa nhập vào địa chỉ",
    //                 minlength: "Địa chỉ phải có ít nhất 5 ký tự",
    //             },
    //             phone: {
    //                 required: "Bạn chưa nhập vào số điện thoại",
    //                 minlength: "Số điện thoại phải có ít nhất 10 ký tự",
    //             },
    //             password: {
    //                 required: "Bạn chưa nhập mật khẩu",
    //                 minlength: "Mật khẩu phải có ít nhất 5 ký tự",
    //             },
    //             passwordAgain: {
    //                 required: "Bạn chưa nhập mật khẩu",
    //                 minlength: "Mật khẩu phải có ít nhất 5 ký tự",
    //                 equalTo: "Mật khẩu không trùng khớp với mật khẩu đã nhập",
    //             },
    //         },
    //         errorElement: "div",
    //         errorPlacement: function(error, element) {
    //             error.addClass("invalid-feedback");
    //             if (element.prop("type") === "checkbox") {
    //                 error.insertAfter(element.siblings("label"));
    //             } else {
    //                 error.insertAfter(element);
    //             }
    //         },
    //         highlight: function(element, errorClass, validClass) {
    //             $(element).addClass("is-invalid").removeClass("is-valid");
    //         },
    //         unhighlight: function(element, errorClass, validClass) {
    //             $(element).addClass("is-valid").removeClass("is-invalid");
    //         },
    //     });
        $("#changePassword").change(function() {
            if ($(this).is(":checked")) {
                $(".password").removeAttr('disabled');
            } else {
                $(".password").attr('disabled', '');
            }
            $("#dangKy").validate({
                rules: {
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
    // });
</script>
<?php $this->stop() ?>