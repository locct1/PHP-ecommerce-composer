<?php $this->layout("layouts/admin/default", ["title" => APPNAME]) ?>

<?php $this->start("page") ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" style="text-align:center">Thêm sản phẩm</h6>
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
            <form method="post" id="frmSanPham" action="admin/sanpham/them" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="font-weight-bold">Thương hiệu</label>
                    <select class="form-control" id="th_id" name="th_id">
                        <?php foreach ($thuonghieu as $th) : ?>
                            <option <?php if (isset($old['th_id']) && $old['th_id'] == $th->id) { ?> selected <?php } ?> value="<?= $this->e($th->id) ?>"> <?= $this->e($th->th_ten) ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sanpham_id" class="font-weight-bold"> Tên sản phẩm</label>
                    <input type="text" name="sp_ten" class="form-control" id="sp_ten" value="<?= isset($old['sp_ten']) ? $this->e($old['sp_ten']) : '' ?>" placeholder="Nhập tên sản phẩm">
                </div>
                <div class="form-group<?= isset($errors['sp_soluong']) ? ' is-invalid' : '' ?>">
                    <label for="sanpham_id" class="font-weight-bold"> Số lượng</label>
                    <input type="number" min='0' name="sp_soluong" class="form-control" id="sp_soluong" value="<?= isset($old['sp_soluong']) ? $this->e($old['sp_soluong']) : '' ?>" placeholder="Nhập số lượng">
                </div>
                <div class="form-group<?= isset($errors['sp_gia']) ? ' is-invalid' : '' ?>">
                    <label for="sanpham_id" class="font-weight-bold">Giá</label>
                    <input type="text" name="sp_gia" class="form-control" id="sp_gia" value="<?= isset($old['sp_gia']) ? $this->e($old['sp_gia']) : '' ?>" placeholder="Nhập giá">
                </div>
                <div class="form-group<?= isset($errors['sp_hinhanh']) ? ' is-invalid' : '' ?>">
                    <label class="font-weight-bold">Hình ảnh</label>
                    <div class="preview-img-container">
                        <img id="preview-img" src="admin_asset/img/noimg.png" width="200px">
                    </div>
                    <input type="file" name="sp_hinhanh" class="form-control" id="sp_hinhanh" placeholder="" value="<?= isset($old['sp_hinhanh']) ? $this->e($old['sp_hinhanh']) : '' ?>">
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Thông số kỹ thuật</label>
                    <textarea class="form-control" name="sp_tskt" style="resize: none;" id="sp_tskt" data-sample-short><?= isset($old['sp_tskt']) ? $this->e($old['sp_tskt']) : '' ?></textarea>
                </div>
                <div class="form-group">
                    <label for="sp_mota_chitiet" class="font-weight-bold">Khuyến mãi đặt biệt</label>
                    <textarea class="form-control" name="sp_km" id="sp_km" style="resize: none;" data-sample-short><?= isset($old['sp_km']) ? $this->e($old['sp_km']) : '' ?></textarea>
                </div>
                <div class="form-group">
                    <label for="sp_mota_chitiet" class="font-weight-bold">Mô tả chi tiết</label>
                    <textarea class="form-control" name="sp_mtct" id="sp_mtct" style="resize: none;" data-sample-short><?= isset($old['sp_km']) ? $this->e($old['sp_km']) : '' ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="btnSave">Thêm</button>
                <a href="admin/sanpham/danhsach" class="btn btn-secondary" name="comeback">Trở về </a>
            </form>
        </div>
    </div>
</div>
<?php $this->stop() ?>

<?php $this->start("page_specific_js") ?>
<script>
    const reader = new FileReader();
    const fileInput = document.getElementById("sp_hinhanh");
    const img = document.getElementById("preview-img");
    reader.onload = e => {
        img.src = e.target.result;
    }
    fileInput.addEventListener('change', e => {
        const f = e.target.files[0];
        reader.readAsDataURL(f);
    })
</script>
<script src="admin_asset/ckeditor/ckeditor.js"> </script>
<script src="admin_asset/ckfinder/ckfinder.js"> </script>
<script>
    var url = '/LKshop/assets/vendor/backend';
    CKEDITOR.replace('sp_tskt', {
        extraPlugins: 'editorplaceholder',
        editorplaceholder: 'Nhập bảng thông tin kỹ thuật...',
        filebrowserBrowseUrl: url + '/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: url + '/ckfinder/ckfinder.html?type=Images',
        filebrowserUploadUrl: url + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: url + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
    });
    CKEDITOR.replace('sp_mtct', {
        extraPlugins: 'editorplaceholder',
        editorplaceholder: 'Nhập mô tả chi tiết...',
        filebrowserBrowseUrl: url + '/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: url + '/ckfinder/ckfinder.html?type=Images',
        filebrowserUploadUrl: url + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: url + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
    });
    var url = '/LKshop/assets/vendor/backend';
    CKEDITOR.replace('sp_km', {
        extraPlugins: 'editorplaceholder',
        editorplaceholder: 'Nhập khuyến mãi đặt biệt...',
        filebrowserBrowseUrl: url + '/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: url + '/ckfinder/ckfinder.html?type=Images',
        filebrowserUploadUrl: url + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: url + '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
    });
</script>
<script>
    $('#sp_gia').keyup(function(event) {
        $(this).val(function(index, value) {
            return '' + value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        });
    });
    $(document).ready(function() {
        $("#frmSanPham").validate({
            ignore: [],
            rules: {
                sp_ten: {
                    required: true,
                    minlength: 3,
                    maxlength: 50
                },
                sp_soluong: {
                    required: true,
                },
                sp_gia: {
                    required: true,
                },
                th_id: {
                    required: true,
                },
                sp_hinhanh: {
                    required: true,
                    extension: "jpg|jpeg|png|ico|bmp"
                },
                sp_tskt: {
                    required: function() {
                        CKEDITOR.instances.sp_tskt.updateElement();
                    },

                },
                sp_km: {
                    required: function() {
                        CKEDITOR.instances.sp_km.updateElement();
                    },
                },
                sp_mtct: {
                    required: function() {
                        CKEDITOR.instances.sp_mtct.updateElement();
                    },
                },
            },
            messages: {
                sp_ten: {
                    required: "Vui lòng nhập tên sản phẩm",
                    minlength: "Tên sản phẩm phải có ít nhất 3 ký tự",
                    maxlength: "Tên sản phẩm không được vượt quá 50 ký tự"
                },
                sp_soluong: {
                    required: "Vui lòng nhập số lượng",

                },
                sp_gia: {
                    required: "Vui lòng nhập giá sản phẩm",

                },
                th_id: {
                    required: "Vui lòng chọn thương hiệu",

                },
                sp_hinhanh: {
                    required: "Vui lòng chọn ảnh",
                    extension: "Chỉ chấp nhận file ảnh"
                },
                sp_tskt: {
                    required: "Vui lòng nhập bảng thông số kỹ thuật",
                },
                sp_km: {
                    required: "Vui lòng nhập mô tả ngắn",
                },
                sp_mtct: {
                    required: "Vui lòng nhập mô tả chi tiết",
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