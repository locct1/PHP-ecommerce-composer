<?php $this->layout("layouts/admin/default", ["title" => APPNAME]) ?>

<?php $this->start("page") ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-center">Quản lý hình thức thanh toán</h6>
    </div>
    <div class="card-body">
        <a href="admin/hinhthucthanhtoan/them" class="btn btn-secondary float-right mb-3">Thêm hình thức thanh toán</a>
        <div class="table-responsive">
            <?php if (isset($_SESSION['msg_xoa'])) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo ($_SESSION['msg_xoa']);
                    unset($_SESSION['msg_xoa']);  ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['msg_xoa_loi'])) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo ($_SESSION['msg_xoa_loi']);
                    unset($_SESSION['msg_xoa_loi']);  ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tên hình thức thanh toán</th>
                        <th>Ngày tạo</th>
                        <th>Ngày cập nhật</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($hinhthucthanhtoan as $ht) : ?>
                    <tr>
                            <td><?= $this->e($ht->id) ?></td>
                            <td><?= $this->e($ht->ht_ten) ?></td>
                            <td><?= $this->e(date("d-m-Y  H:i:s", strtotime($ht->created_at))) ?></td>
                            <td><?= $this->e(date("d-m-Y  H:i:s", strtotime($ht->updated_at))) ?></td>
                            <td>
                                <a href="admin/hinhthucthanhtoan/sua/<?= $this->e($ht->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <a data-ht_id='<?= $this->e($ht->id) ?>' class="btn btn-danger btnDelete"><i class="fa fa-trash-alt"></i></a>
                            </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->stop() ?>

<?php $this->start("page_specific_js") ?>
<script>
      $(document).ready(function() {
        $('.btnDelete').click(function() {
            Swal.fire({
                title: 'Bạn chắn chắn muốn xóa hình thức thanh toán?',
                text: "Một khi đã xóa, không thể phục hồi....",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Hủy',
                confirmButtonText: 'Xác nhận'
            }).then((result) => {
                if (result.isConfirmed) {
                    var ht_id = $(this).data('ht_id');
                        var url = "/admin/hinhthucthanhtoan/xoa/" + ht_id;
                        location.href = url;
                    Swal.fire(
                        'Đã xóa',
                        'Hình thức thanh toán đã được xóa',
                        'success'
                    )
                }
            })
        });
      });
</script>

<?php $this->stop() ?>