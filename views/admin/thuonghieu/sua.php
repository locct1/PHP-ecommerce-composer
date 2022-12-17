<?php $this->layout("layouts/admin/default", ["title" => APPNAME]) ?>

<?php $this->start("page") ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" style="text-align:center">Sửa thương hiệu</h6>
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
            <form method="post" name="frm" id="frmThuongHieu" action="/admin/thuonghieu/sua/<?=$this->e($thuonghieu['id'])?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="thuonghieu_id" class="font-weight-bold"> Tên thương hiệu</label>
                    <input type="text" name="th_ten" class="form-control"  value="<?= isset($old['th_ten']) ? $this->e($old['th_ten']) :  $this->e($thuonghieu['th_ten']) ?>" id="th_ten"  placeholder="Nhập tên thương hiệu">
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Hình ảnh hiện tại</label>
                    <div class="preview-img-container">
                    <img width="200" src="/upload/thuonghieu/<?= $this->e($thuonghieu['th_hinhanh']) ?>" alt="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Hình ảnh cập nhật</label>
                    <div class="preview-img-container">
                    <img id="preview-img" src="admin_asset/img/noimg.png" width="200px">
                    </div>
                    <input type="file" name="th_hinhanh" class="form-control" id="th_hinhanh">
                </div>
                <button type="submit" class="btn btn-primary" name="btnSave">Sửa</button>
                <a href="admin/thuonghieu/danhsach" class="btn btn-secondary" name="comeback">Trở về </a>
            </form>
        </div>
    </div>
</div>
<?php $this->stop() ?>

<?php $this->start("page_specific_js") ?>
<script>
    const reader = new FileReader();
    const fileInput = document.getElementById("th_hinhanh");
    const img = document.getElementById("preview-img");
    reader.onload = e => {
        img.src = e.target.result;
    }
    fileInput.addEventListener('change', e => {
        const f = e.target.files[0];
        reader.readAsDataURL(f);
    })
    $(document).ready(function() {
      $("#frmThuongHieu").validate({
        rules: {
          th_ten: {
            required: true,
            maxlength: 50
          },
          th_hinhanh: {
            extension: "jpg|jpeg|png|ico|bmp"
          },
        },
        messages: {
          th_ten: {
            required: "Vui lòng nhập tên thương hiệu",
            maxlength: "Tên thương hiệu không được vượt quá 50 ký tự"
          },
          th_hinhanh: {
            extension: "Chỉ chấp nhận file ảnh"
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