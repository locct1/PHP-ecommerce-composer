<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <base href="/">
    <!-- Paper CSS -->
    <link rel="stylesheet" href="/admin_asset/css/paper.min.css" type="text/css" />
    <!-- Block title - Đục lỗ trên giao diện bố cục chung, đặt tên là `title` -->
    <title>LKshop - Thương mại điện tử laptop</title>
    <!-- End block title -->

    <!-- Định khổ giấy: A5, A4 or A3 -->
    <style>
        @page {
            size: A4
        }
    </style>
</head>

<body class="A4">
    <section class="sheet padding-10mm">
        <!-- Thông tin Cửa hàng -->
        <table border="0" width="100%" cellspacing="0">
            <tbody>
                <tr>
                    <td align="center"><a href="admin/donhang/danhsach"><img src="admin_asset/img/logo6.png" width: 145px /></a></td>
                    <td align="center">
                        <b style="font-size: 2em;">LKshop - Hệ thống bán Laptop</b><br />
                        <small style="font-size:18px">Cung cấp những sản phẩm chất lượng, giá ưu đãi cho khách hàng</small><br />
                        <small style="font-size:18px">Lấy sự hài lòng của khách hàng làm thước đo thành công</small>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Thông tin đơn hàng -->
        <p><i><u>Thông tin người đặt</u></i></p>
        <table border="0" width="100%" cellspacing="0">
            <tbody>
                <tr>
                    <td width="30%"><b>Tên:</b></td>
                    <td><?= $donhang->user->name ?>
                    </td>
                </tr>
                <tr>
                    <td><b>Email:</b></td>
                    <td><?= $donhang->user->email ?></td>
                </tr>
                <tr>
                    <td><b>Số điện thoại:</b></td>
                    <td><?= $donhang->user->phone ?></td>
                </tr>
                <tr>
                    <td><b>Địa chỉ</b></td>
                    <td><?= $donhang->user->address ?></td>
                </tr>
            </tbody>
        </table>
        <p><i><u>Thông tin người nhận</u></i></p>
        <table border="0" width="100%" cellspacing="0">
            <tbody>
                <tr>
                    <td width="30%"><b>Tên:</b></td>
                    <td><?= $donhang->usernhanhang->nh_name ?>
                    </td>
                </tr>
                <tr>
                    <td><b>Email:</b></td>
                    <td><?= $donhang->usernhanhang->nh_email ?></td>
                </tr>
                <tr>
                    <td><b>Số điện thoại:</b></td>
                    <td><?= $donhang->usernhanhang->nh_phone ?></td>
                </tr>
                <tr>
                    <td><b>Địa chỉ</b></td>
                    <td><?= $donhang->usernhanhang->nh_address ?></td>
                </tr>

            </tbody>
        </table>
        <br>
        <table border="0" width="100%" cellspacing="0">
            <tbody>
                <tr>
                    <td width="30%"><b>Hình thức thanh toán:</b></td>
                    <td><?= $donhang->hinhthucthanhtoan->ht_ten ?></td>
                </tr>
            </tbody>
        </table>
        <table border="0" width="100%" cellspacing="0">
            <tbody>
                <tr>
                    <td width="30%"><b>Ngày lập:</b></td>
                    <td><?= (new \DateTime())->format('d-m-Y') ?></td>
                </tr>
            </tbody>
        </table>
        <table border="0" width="100%" cellspacing="0">
            <tbody>
                <tr>
                    <td width="30%"><b>Số hóa đơn:</b></td>
                    <td><?= $donhang->id ?></td>
                </tr>
            </tbody>
        </table>
        <p><i><u>Chi tiết đơn hàng</u></i></p>
        <table border="1" width="100%" cellspacing="0" cellpadding="5">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                ?>
                <?php foreach ($donhang->sanpham as $ct) : ?>
                    <?php
                    $thanhtien = $ct->pivot->ct_soluongmua * $ct->pivot->ct_gia;
                    $i++;
                    ?>
                    <tr>
                        <td align="center"><?= $i ?></td>
                        <td><?= $ct->sp_ten ?></td>
                        <td align="right"><?= $ct->pivot->ct_soluongmua ?></td>
                        <td align="right"><?= number_format($ct->pivot->ct_gia, 0, ".", ",") . 'đ' ?></td>
                        <td align="right"><?= number_format($thanhtien, 0, ".", ",") . 'đ' ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="6" style="text-align:right;"><span style="font-weight:bold">Tổng tiền: <?= number_format($donhang->dh_tong, 0, ".", ",") . 'đ' ?></span></td>
                </tr>


            </tbody>
        </table>

        <!-- Thông tin Footer -->
        <br />
        <table border="0" width="100%">
            <tbody>
                <tr>
                    <td align="center">
                        <small style="font-size:14px">Xin cám ơn Quý khách đã ủng hộ Cửa hàng, Chúc Quý khách luôn mạnh khỏe!</small>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
    <!-- End block content -->
</body>

</html>