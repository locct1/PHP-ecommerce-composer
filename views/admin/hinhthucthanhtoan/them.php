<?php $this->layout("layouts/admin/default", ["title" => APPNAME]) ?>

<?php $this->start("page") ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" style="text-align:center">Thêm hình thức thanh toán</h6>
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
            <form method="post"  id="frmHinhThucThanhToan" action="admin/hinhthucthanhtoan/them">
                <div class="form-group">
                    <label for="hinhthucthanhtoan_id" class="font-weight-bold"> Tên hình thức thanh toán</label>
                    <input type="text" id="ht_ten" name="ht_ten" class="form-control"  value="<?= isset($old['ht_ten']) ? $this->e($old['ht_ten']) : '' ?>" placeholder="Nhập tên hình thức thanh toán">
                </div>
                <button type="submit" class="btn btn-primary" name="btnSave">Thêm</button>
                <a href="admin/hinhthucthanhtoan/danhsach" class="btn btn-secondary" name="comeback">Trở về </a>
            </form>
        </div>
    </div>
</div>
<?php $this->stop() ?>

<?php $this->start("page_specific_js") ?>
<script>
    $(document).ready(function() {
            $("#frmHinhThucThanhToan").validate({
                rules: {
                    ht_ten: {
                        required: true,
                        maxlength: 50
                    },
                },
                messages: {
                    ht_ten: {
                        required: "Vui lòng nhập tên hình thức thanh toán",
                        maxlength: "Tên hình thức thanh toán không được vượt quá 50 ký tự"
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