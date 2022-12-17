<?php $this->layout("layouts/admin/default", ["title" => APPNAME]) ?>

<?php $this->start("page") ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Thông tin đơn hàng: <?= $donhang->id ?> </h6>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" style="text-align:center">Thông tin người đặt hàng </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>

                </thead>
                <tbody>
                    <tr>
                        <th width="50%">Tên người đặt hàng</th>
                        <td><?= $donhang->user->name?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= $donhang->user->email?></td>
                    </tr>
                    <tr>
                        <th>Địa chỉ</th>
                        <td><?= $donhang->user->address ?></td>
                    </tr>
                    <tr>
                        <th>Số điện thoại</th>
                        <td><?= $donhang->user->phone ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" style="text-align:center">Thông tin người nhận hàng </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>

                </thead>
                <tbody>
                    <tr>
                        <th width="50%">Tên người nhận hàng</th>
                        <td><?= $donhang->usernhanhang->nh_name?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= $donhang->usernhanhang->nh_email?></td>
                    </tr>
                    <tr>
                        <th>Địa chỉ</th>
                        <td><?= $donhang->usernhanhang->nh_address ?></td>
                    </tr>
                    <tr>
                        <th>Số điện thoại</th>
                        <td><?= $donhang->usernhanhang->nh_phone ?></td>
                    </tr>
                    <tr>
                        <th>Ghi chú</th>
                        <td><?= $donhang->dh_notes?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" style="text-align:center">Chi tiết đơn hàng</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Id chi tiết đơn hàng</th>
                        <th>Id sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá </th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                    $i=0;
                  ?>
                    <?php  foreach($donhang->sanpham as $ct) : ?>
                    <?php
                    $thanhtien = $ct->pivot->ct_soluongmua * $ct->pivot->ct_gia;
                    $i++;
                    ?>
                    <tr>
                        <td align="center"><?= $i?></td>
                        <td><?= $ct->pivot->id ?></td>
                        <td><?= $ct->pivot->sp_id ?></td>
                        <td align="center"><?= $ct->sp_ten?></td>
                        <td class="text-right"><?= $ct->pivot->ct_soluongmua?></td>
                        <td class="text-right"><?= number_format($ct->pivot->ct_gia, 0, ".", ",").'đ'?></td>
                        <td class="text-right"><?= number_format($thanhtien, 0, ".", ",").'đ'?></td>
                    </tr>
                   <?php  endforeach; ?>
                    <tr>
                        <td colspan="7" style="text-align:right;"><span style="font-weight:bold">Tổng tiền: <?= number_format($donhang->dh_tong, 0, ".", ",").'đ'?></span></td>
                    </tr>
                </tbody>
            </table>
            <a href="admin/donhang/danhsach" class="btn btn-secondary" name="comeback">Trở về </a>
        </div>
    </div>
</div>
<?php $this->stop() ?>

<?php $this->start("page_specific_js") ?>

<?php $this->stop() ?>