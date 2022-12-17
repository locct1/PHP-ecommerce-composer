<?php $this->layout("layouts/admin/default", ["title" => APPNAME]) ?>

<?php $this->start("page") ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" style="text-align:center">Sửa sản phẩm</h6>
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
            <form method="post" id="frmSanPham" action="admin/sanpham/sua/<?= $this->e($sanpham->id) ?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="font-weight-bold">Thương hiệu</label>
                    <select class="form-control" id="thuonghieu" name="th_id">
                        <?php if (isset($old['th_id'])) echo $old['th_id']; ?>
                        <?php foreach ($thuonghieu as $th) : ?>
                            <option <?php if (!isset($old['th_id']) && $th->id == $sanpham->th_id) :
                                        echo 'selected';
                                    elseif (isset($old['th_id']) && $old['th_id'] == $th->id) :
                                        echo 'selected';
                                    endif;
                                    ?> value="<?= $this->e($th->id) ?>"> <?= $this->e($th->th_ten) ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="sanpham_id" class="font-weight-bold"> Tên sản phẩm</label>
                    <input type="text" name="sp_ten" class="form-control" id="sp_ten" value="<?= isset($old['sp_ten']) ? $this->e($old['sp_ten']) :  $this->e($sanpham->sp_ten) ?>" placeholder="Nhập tên sản phẩm">
                </div>
                <div class="form-group">
                    <label for="sanpham_id" class="font-weight-bold"> Số lượng</label>
                    <input type="number" min='0' name="sp_soluong" class="form-control" id="sp_soluong" value="<?= isset($old['sp_soluong']) ? $this->e($old['sp_soluong']) :  $this->e($sanpham->sp_soluong) ?>" placeholder="Nhập số lượng">
                </div>
                <div class="form-group">
                    <label for="sanpham_id" class="font-weight-bold">Giá hiện tại</label>
                    <input type="text" name="sp_gia" class="form-control" id="sp_gia" value="<?= isset($old['sp_gia']) ? $this->e($old['sp_gia']) :  $this->e(number_format($sanpham->sp_gia, 0, ".", ",")) ?>" placeholder="Nhập giá sản phẩm">
                </div>
                <div class="form-group">
                    <label for="sanpham_id" class="font-weight-bold">Giá cũ</label>
                    <input type="text" name="sp_giacu" class="form-control" id="sp_giacu" value="<?= isset($old['sp_giacu']) ? $this->e($old['sp_giacu']) :  $this->e(number_format($sanpham->sp_giacu, 0, ".", ",")) ?>" placeholder="Nhập giá cũ sản phẩm('0' là không có giá cũ)">
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Hình ảnh hiện tại</label>
                    <div class="preview-img-container">
                        <img width="200" src="/upload/sanpham/<?= $this->e($sanpham['sp_hinhanh']) ?>" alt="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Hình ảnh Cập nhật</label>
                    <div class="preview-img-container">
                        <img id="preview-img" src="admin_asset/img/noimg.png" width="200px">
                    </div>
                    <input type="file" name="sp_hinhanh" class="form-control" id="sp_hinhanh">
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Thông số kỹ thuật</label>
                    <textarea class="form-control" name="sp_tskt" style="resize: none;" id="sp_tskt" data-sample-short><?= isset($old['sp_tskt']) ? $this->e($old['sp_tskt']) :  $this->e($sanpham->sp_tskt) ?></textarea>
                </div>
                <div class="form-group">
                    <label for="sp_mota_chitiet" class="font-weight-bold">Khuyến mãi đặt biệt</label>
                    <textarea class="form-control" name="sp_km" id="sp_km" style="resize: none;" data-sample-short><?= isset($old['sp_km']) ? $this->e($old['sp_km']) :  $this->e($sanpham->sp_km)  ?></textarea>
                </div>
                <div class="form-group">
                    <label for="sp_mota_chitiet" class="font-weight-bold">Mô tả chi tiết</label>
                    <textarea class="form-control" name="sp_mtct" id="sp_mtct" style="resize: none;" data-sample-short><?= isset($old['sp_mtct']) ? $this->e($old['sp_mtct']) :  $this->e($sanpham->sp_mtct)  ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="btnSave">Sửa</button>
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
    $('#sp_giacu').keyup(function(event) {
        $(this).val(function(index, value) {
            return '' + value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        });
    });

    $.validator.addMethod('le', function(value, element, param) {
        sp_giacu = parseFloat(value.replace(/,/g, ''));
        console.log(value);
        var sp_gia=$(param).val();
        sp_gia = parseFloat(sp_gia.replace(/,/g, ''));
        console.log(sp_gia);
        if (parseInt(value) > 0) {
            return this.optional(element) || sp_giacu > sp_gia;
        } else {
            return true
        }
    }, 'Invalid value');

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
                sp_giacu: {
                    required: true,
                    le: '#sp_gia'
                },
                th_id: {
                    required: true,
                },
                sp_hinhanh: {
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
                sp_giacu: {
                    required: "Vui lòng nhập giá cũ",
                    le: 'Giá cũ phải lớn hơn giá hiện tại'
                },
                th_id: {
                    required: "Vui lòng chọn thương hiệu",

                },
                sp_hinhanh: {
                    extension: "Chỉ chấp nhận file ảnh"
                },
                sp_tskt: {
                    required: "Vui lòng nhập bảng thông số kỹ thuật",
                },
                sp_km: {
                    required: "Vui lòng nhập khuyến mãi",
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
    $('[name="sp_giacu"]').on('change blur keyup', function() {
        $('[name="sp_gia"]').valid();
    });
</script>
<?php $this->stop() ?>