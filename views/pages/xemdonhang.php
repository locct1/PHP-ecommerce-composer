<?php $this->layout("layouts/frontend/default", ["title" => APPNAME]) ?>

<?php $this->start("page_specific_css") ?>
<style>
  .modal-dialog {
    max-width: 60%;
  }

  .nice-select.form-control.form-control-lg {
    width: 322px;
  }

  li.option.selected.focus {
    width: 322px;
  }
</style>
<?php $this->stop() ?>

<?php $this->start("page") ?>
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.PNG">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="breadcrumb__text">
          <h2>Đơn hàng của bạn</h2>
          <div class="breadcrumb__option">
            <a href="trang-chu">Trang chủ</a>
            <span>Xem đơn hàng</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="container-fluid mt-3">
  <div id="alert-container" class="alert alert-warning alert-dismissible fade d-none" role="alert">
    <div id="thongbao">&nbsp;</div>
  </div>
  <table id="tblDonHang" class="table table-bordered" style="border:1px solid #343a40">
    <thead class="thead-dark">
      <tr>
        <th scope="col" width="1%">STT</th>
        <th scope="col">Số hóa đơn</th>
        <th scope="col">Trạng thái</th>
        <th scope="col">Người nhận</th>
        <th scope="col">Ngày đặt hàng </th>
        <th scope="col">Tổng tiền</th>
        <th scope="col">Chi tiết đơn hàng</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $i = 0;
      ?>
      <?php foreach ($donhang as $dh) : ?>
        <?php
        $i++;
        ?>
        <tr>
          <td> <?= $i ?></td>
          <td> <?= $dh->id ?></td>
          <td>
            <?php if ($dh->dh_status == 0) : ?>
              <form action="">

                <span class="badge badge-danger" id="choxuly_<?= $dh->id ?>">Đang chờ xử lý</span>
              </form>
            <?php elseif ($dh->dh_status == 1) : ?>
              <span class="badge badge-primary" id="danggiaohang_<?= $dh->id ?>">Đang giao hàng</span>
            <?php else : ?>
              <span class="badge badge-success">Đã giao hàng</span>
            <?php endif; ?>
          </td>
          <td>
            <?= $dh->usernhanhang->nh_name ?>
          </td>
          <td>
            <?= date('d/m/Y H:i:s', strtotime($dh->created_at)) ?>
          </td>

          <td><?= number_format($dh->dh_tong, 0, ".", ",") ?><sup style="text-decoration:underline">đ</sup></td>

          <td>
            <form action="">
              <button type="button" class="btn btn-primary xemchitiet" data-button="<?= $dh->id ?>" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fa fa-eye"></i> Xem chi tiết</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-light" id="exampleModalLabel">Chi tiết đơn hàng</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="font-weight-bold text-center">Thông tin người nhận hàng</h4>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label font-weight-bold">Họ và tên:</label>
            <input type="text" class="form-control" id="nh_name" readonly>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label font-weight-bold">Email:</label>
            <input type="text" class="form-control" id="nh_email" readonly>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label font-weight-bold">Số điện thoại:</label>
            <input type="text" class="form-control" id="nh_phone" readonly>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label font-weight-bold">Địa chỉ:</label>
            <textarea class="form-control" id="nh_address" readonly></textarea>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label font-weight-bold">Ghi chú:</label>
            <textarea class="form-control" id="dh_notes" readonly></textarea>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label"><b> Hình thức thanh toán: </b><span id="ht_id"> </span></label>
          </div>
          <h4 class="mb-3 font-weight-bold text-center">Thông tin chi tiết đơn hàng</h4>
          <table id="ct" class="table table-bordered" style="border:1px solid #343a40">
            <thead class="thead-dark">
              <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Số lượng </th>
                <th>Giá</th>
                <th>Thành tiền</th>
              </tr>
            </thead>
            <tbody>




            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->stop() ?>
<?php $this->start("page_specific_js") ?>
<script>
  $('.xemchitiet').click(function() {
    $('#ct tbody').html('');
    var donhang = $(this).attr('data-button');
    console.log(donhang);
    var dulieugoi = {
      donhang_id: donhang,
    };
    $.ajax({
      url: 'chi-tiet-don-hang-api',
      method: "POST",
      dataType: 'json',
      data: dulieugoi,
      success: function(data) {
        //             console.log(data.sp_ten);
        var j = 1;
        var tongtien = 0;
        var htmlTemplate = '';
        $.each(data, function(i, item) {
          console.log(item);
          $("#nh_name").val(item.nh_name);
          $("#nh_email").val(item.nh_email);
          $("#nh_phone").val(item.nh_phone);
          $("#nh_address").html(item.nh_address);
          $("#dh_notes").html(item.dh_notes);
          $("#ht_id").text(item.ht_ten);
          tongtien = item.dh_tong;
          htmlTemplate += '<tr>';
          htmlTemplate += '<td>' + j++ + '</td>';
          htmlTemplate += '<td>' + item.sp_ten + '</td>';
          htmlTemplate += '<td>' + '<img style="width:100px" src="upload/sanpham/' + item.sp_hinhanh + '"/>' + '</td>';
          htmlTemplate += '<td>' + item.ct_soluongmua + '</td>';
          htmlTemplate += '<td>' + formatNumber(item.ct_gia, '.', ',') + '</td>';
          htmlTemplate += '<td>' + formatNumber(item.ct_gia * item.ct_soluongmua, '.', ',') + '</td>';
          htmlTemplate += '</tr>';


        });
        htmlTemplate += '<tr>';
        htmlTemplate += '<td colspan="6" class="bg bg-dark text-light text-center font-weight-bold"  align="center">' + '<b>Tổng tiền:</b> ' + formatNumber(tongtien, '.', ',') + '</td>';
        htmlTemplate += '</tr>';
        $('#ct tbody').append(htmlTemplate);

      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
        var htmlString = `<h1>Không thể xử lý</h1>`;
        $('#thongbao').html(htmlString);
        // Hiện thông báo
        $('.alert').removeClass('d-none').addClass('show');
      }
    });
  });
</script>

<?php $this->stop() ?>