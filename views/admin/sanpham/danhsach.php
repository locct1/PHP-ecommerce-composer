<?php $this->layout("layouts/admin/default", ["title" => APPNAME]) ?>

<?php $this->start("page") ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-center">Quản lý sản phẩm</h6>
    </div>
    <div class="card-body">
        <a href="admin/sanpham/them" class="btn btn-secondary float-right mb-3">Thêm sản phẩm</a>
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
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Hình ảnh</th>
                        <th>Giá hiện tại</th>
                        <th>Giá cũ</th>
                        <th>Thương hiệu</th>
                        <th>Ngày tạo</th>
                        <th>Ngày cập nhật</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($sanpham as $sp) : ?>
                    <tr>
                            <td><?= $this->e($sp->id) ?></td>
                            <td><?= $this->e($sp->sp_ten) ?></td>
                            <td><?= $this->e($sp->sp_soluong) ?></td>
                            <td><img width="30" src="/upload/sanpham/<?= $this->e($sp->sp_hinhanh) ?>" alt=""></td>
                            <td><?=  $this->e(number_format($sp->sp_gia, 0, ".", ",").'đ') ?></td>
                            <td>
                                <?php 
                                if($sp->sp_giacu==0){
                                ?>
                                    Không có giá cũ
                                <?php }else{ ?>
                                    <?= $this->e(number_format($sp->sp_giacu, 0, ".", ",").'đ') ?>
                                <?php
                                }
                                ?>
                            </td>
                            <td><?= $this->e($sp->thuonghieu->th_ten) ?></td>
                            <td><?= $this->e(date("d-m-Y  H:i:s", strtotime($sp->created_at))) ?></td>
                            <td><?= $this->e(date("d-m-Y  H:i:s", strtotime($sp->updated_at))) ?></td>
                            <td>
                                <a href="admin/sanpham/sua/<?= $this->e($sp->id) ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <a data-sp_id='<?= $this->e($sp->id) ?>' class="btn btn-danger btnDelete"><i class="fa fa-trash-alt"></i></a>
                            </td>
                    </tr>
                <?php endforeach ?>
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
                title: 'Bạn chắn chắn muốn xóa sản phẩm này?',
                text: "Một khi đã xóa, không thể phục hồi....",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Hủy',
                confirmButtonText: 'Xác nhận'
            }).then((result) => {
                if (result.isConfirmed) {
                    var sp_id = $(this).data('sp_id');
                        var url = "/admin/sanpham/xoa/" + sp_id;
                        location.href = url;
                    Swal.fire(
                        'Đã xóa',
                        'Sản phẩm đã được xóa',
                        'success'
                    )
                }
            })
        });
      });
</script>

<?php $this->stop() ?>