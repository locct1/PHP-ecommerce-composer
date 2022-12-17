<?php $this->layout("layouts/admin/default", ["title" => APPNAME]) ?>

<?php $this->start("page") ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tổng quan</h1>
</div>
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Tổng số tài khoản</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $users ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Tống số đơn hàng xử lý</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $donhangxuly ?>/<?= $tongdonhang ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Tống số sản phẩm</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sanpham ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fab fa-product-hunt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Tổng doanh thu</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"> <?= number_format($doanhthu, 0, ".", ",") . ' đ' ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-lg-6" style="margin-left: auto;margin-right: auto;">
        <canvas id="chartOfobjChartThongKeThuongHieu"></canvas>
        <button class="btn btn-outline-primary btn-sm form-control" id="refreshThongKeThuongHieu">Refresh dữ liệu</button>
    </div>

</div>
<?php $this->stop() ?>

<?php $this->start("page_specific_js") ?>
<script>
    $(document).ready(function() {
        var $objChartThongKeThuongHieu;
        var $chartOfobjChartThongKeThuongHieu = $('#chartOfobjChartThongKeThuongHieu')[0].getContext(
            "2d");

        function renderChartThongKeThuongHieu() {
            $.ajax({
                url: '/admin/baocao-thongkethuonghieu',
                type: "GET",
                success: function(response) {
                    var data = JSON.parse(response);
                    var myLabels = [];
                    var myData = [];
                    $(data).each(function() {
                        myLabels.push((this.TenThuongHieu));
                        myData.push(this.SoLuong);
                    });
                    myData.push(0); 
                    if (typeof $objChartThongKeThuongHieu !== "undefined") {
                        $objChartThongKeThuongHieu.destroy();
                    }
                    $objChartThongKeThuongHieu = new Chart($chartOfobjChartThongKeThuongHieu, {
                       

                        type: "bar",
                        data: {
                            labels: myLabels,
                            datasets: [{
                                data: myData,
                                borderColor: "#9ad0f5",
                                backgroundColor: "#9ad0f5",
                                borderWidth: 1

                            }]
                        },
                        // Cấu hình dành cho biểu đồ của ChartJS

                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        reverse: false,
                                        stepSize: 1
                                    },
                                }]
                            },
                            legend: {
                                display: false
                            },
                            title: {
                                display: true,
                                text: "Thống kê sản phẩm theo thương hiệu"
                            },
                            responsive: true,
                        }
                    });
                }
            });
        };
        $('#refreshThongKeThuongHieu').click(function(event) {
            event.preventDefault();
            location.reload();
        });
        renderChartThongKeThuongHieu();

    });
</script>
<?php $this->stop() ?>