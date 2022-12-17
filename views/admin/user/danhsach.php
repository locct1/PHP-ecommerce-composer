<?php $this->layout("layouts/admin/default", ["title" => APPNAME]) ?>

<?php $this->start("page") ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-center">Quản lý tài khoản khách hàng</h6>
    </div>
    <div class="card-body">
    <a href="admin/user/them" class="btn btn-secondary float-right mb-3">Thêm tài khoản</a>
        <div class="table-responsive">
        <?php if (isset($_SESSION['msg_xoa'])) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo ($_SESSION['msg_xoa']);
                    unset($_SESSION['msg_xoa']);  ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tài khoản</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Quyền</th>
                        <th>Ngày tạo</th>
                        <th>Ngày cập nhật</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                   <?php foreach($user as $user ): ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= $user->name ?><br>(<?= $user->email ?>)</td>
                        <td><?= $user->address ?></td>
                        <td><?= $user->phone ?></td>
                        <td><?php if($user->quyen==1) :?> 
                            <?= 'Admin' ?>
                           <?php else: ?>
                            <?= 'Thường' ?>
                           <?php endif; ?>
                        </td>
                        <td><?= date('d/m/Y H:i:s', strtotime($user->created_at)) ?></td>
                        <td><?= date('d/m/Y H:i:s', strtotime($user->updated_at)) ?></td>
                        <td>
                            <a href="admin/user/sua/<?= $user->id ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                            <a data-user_id='<?= $this->e($user->id) ?>' class="btn btn-danger btnDelete"><i class="fa fa-trash-alt"></i></a>
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
                title: 'Bạn chắn chắn muốn xóa tài khoản này?',
                text: "Một khi đã xóa, không thể phục hồi....",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Hủy',
                confirmButtonText: 'Xác nhận'
            }).then((result) => {
                if (result.isConfirmed) {
                    var user_id = $(this).data('user_id');
                        var url = "/admin/user/xoa/" + user_id;
                        location.href = url;
                    Swal.fire(
                        'Đã xóa',
                        'Tài khoản đã được xóa',
                        'success'
                    )
                }
            })
        });
      });
</script>

<?php $this->stop() ?>