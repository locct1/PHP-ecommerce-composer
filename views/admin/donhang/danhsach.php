<?php $this->layout("layouts/admin/default", ["title" => APPNAME]) ?>

<?php $this->start("page") ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary text-center">Quản lý đơn hàng</h6>
    </div>
    <div class="card-body">
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
                        <th>Số hóa đơn</th>
                        <th>Tên người đặt</th>
                        <th>Tên người nhận</th>
                        <th>Hình thức thanh toán</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th >Ghi chú</th>
                        <th>Ngày tạo</th>
                        <th>Ngày cập nhật</th>
                        <th>Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($donhang as $dh) : ?>
                        <tr>
                            <td><?= $dh->id ?></td>
                            <td><?= $dh->user->name ?></td>
                            <td><?= $dh->usernhanhang->nh_name ?></td>
                            <td><?= $dh->hinhthucthanhtoan->ht_ten ?></td>
                            <td><?= number_format($dh->dh_tong, 0, ".", ",") . 'đ' ?></td>
                            <td>
                                <?php if ($dh->dh_status == 0) : ?>
                                   

                                        <a type="button" id="dh_<?= $dh->id ?>" class="btn-capnhat-danggiaohang" data-danggiaohang="<?= $dh->id ?>"> <span class="badge badge-danger" id="choxuly_<?= $dh->id ?>">Đang chờ xử lý</span></a>
                                   
                                <?php elseif ($dh->dh_status == 1) : ?>
                                    <a type="button" class="btn-capnhat-dagiaohang" data-dagiaohang="<?= $dh->id ?>"> <span class="badge badge-primary" id="danggiaohang_<?= $dh->id ?>">Đang giao hàng</span></a>
                                <?php else : ?>
                                    <a type="button"> <span class="badge badge-success">Đã giao hàng</span></a>
                                <?php endif; ?>
                            </td>
                            <td ><?= $dh->dh_notes ?></td>
                            <td><?= date('d/m/Y H:i:s', strtotime($dh->created_at)) ?></td>
                            <td>
                                <div id="ngaycapnhat_<?= $dh->id ?>"><?= date('d/m/Y H:i:s', strtotime($dh->updated_at)) ?></div>
                            </td>
                            <td>
                                <a href="admin/donhang/indonhang/<?= $dh->id ?>" class="btn btn-success"><i class="fa fa-print"></i></a>
                                <a href="admin/donhang/chitietdonhang/<?= $dh->id ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                <a data-id='<?= $dh->id ?>' class="btn btn-danger btnDelete"><i class="fa fa-trash-alt"></i></a>
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
    var DateFormat = {};
    ! function(e) {
        var I = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
            O = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
            v = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            w = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            a = {
                Jan: "01",
                Feb: "02",
                Mar: "03",
                Apr: "04",
                May: "05",
                Jun: "06",
                Jul: "07",
                Aug: "08",
                Sep: "09",
                Oct: "10",
                Nov: "11",
                Dec: "12"
            },
            u = /\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}\.?\d{0,3}[Z\-+]?(\d{2}:?\d{2})?/;
        DateFormat.format = function() {
            function o(e) {
                return a[e] || e
            }

            function i(e) {
                var a, r, t, n, s, o = e,
                    i = "";
                return -1 !== o.indexOf(".") && (o = (n = o.split("."))[0], i = n[n.length - 1]), 3 <= (s = o.split(":")).length ? (a = s[0], r = s[1], t = s[2].replace(/\s.+/, "").replace(/[a-z]/gi, ""), {
                    time: o = o.replace(/\s.+/, "").replace(/[a-z]/gi, ""),
                    hour: a,
                    minute: r,
                    second: t,
                    millis: i
                }) : {
                    time: "",
                    hour: "",
                    minute: "",
                    second: "",
                    millis: ""
                }
            }

            function D(e, a) {
                for (var r = a - String(e).length, t = 0; t < r; t++) e = "0" + e;
                return e
            }
            return {
                parseDate: function(e) {
                    var a, r, t = {
                        date: null,
                        year: null,
                        month: null,
                        dayOfMonth: null,
                        dayOfWeek: null,
                        time: null
                    };
                    if ("number" == typeof e) return this.parseDate(new Date(e));
                    if ("function" == typeof e.getFullYear) t.year = String(e.getFullYear()), t.month = String(e.getMonth() + 1), t.dayOfMonth = String(e.getDate()), t.time = i(e.toTimeString() + "." + e.getMilliseconds());
                    else if (-1 != e.search(u)) a = e.split(/[T\+-]/), t.year = a[0], t.month = a[1], t.dayOfMonth = a[2], t.time = i(a[3].split(".")[0]);
                    else switch (6 === (a = e.split(" ")).length && isNaN(a[5]) && (a[a.length] = "()"), a.length) {
                        case 6:
                            t.year = a[5], t.month = o(a[1]), t.dayOfMonth = a[2], t.time = i(a[3]);
                            break;
                        case 2:
                            r = a[0].split("-"), t.year = r[0], t.month = r[1], t.dayOfMonth = r[2], t.time = i(a[1]);
                            break;
                        case 7:
                        case 9:
                        case 10:
                            t.year = a[3];
                            var n = parseInt(a[1]),
                                s = parseInt(a[2]);
                            n && !s ? (t.month = o(a[2]), t.dayOfMonth = a[1]) : (t.month = o(a[1]), t.dayOfMonth = a[2]), t.time = i(a[4]);
                            break;
                        case 1:
                            r = a[0].split(""), t.year = r[0] + r[1] + r[2] + r[3], t.month = r[5] + r[6], t.dayOfMonth = r[8] + r[9], t.time = i(r[13] + r[14] + r[15] + r[16] + r[17] + r[18] + r[19] + r[20]);
                            break;
                        default:
                            return null
                    }
                    return t.time ? t.date = new Date(t.year, t.month - 1, t.dayOfMonth, t.time.hour, t.time.minute, t.time.second, t.time.millis) : t.date = new Date(t.year, t.month - 1, t.dayOfMonth), t.dayOfWeek = String(t.date.getDay()), t
                },
                date: function(a, e) {
                    try {
                        var r = this.parseDate(a);
                        if (null === r) return a;
                        for (var t, n = r.year, s = r.month, o = r.dayOfMonth, i = r.dayOfWeek, u = r.time, c = "", h = "", l = "", m = !1, y = 0; y < e.length; y++) {
                            var d = e.charAt(y),
                                f = e.charAt(y + 1);
                            if (m) "'" == d ? (h += "" === c ? "'" : c, c = "", m = !1) : c += d;
                            else switch (l = "", c += d) {
                                case "ddd":
                                    h += (S = i, I[parseInt(S, 10)] || S), c = "";
                                    break;
                                case "dd":
                                    if ("d" === f) break;
                                    h += D(o, 2), c = "";
                                    break;
                                case "d":
                                    if ("d" === f) break;
                                    h += parseInt(o, 10), c = "";
                                    break;
                                case "D":
                                    h += o = 1 == o || 21 == o || 31 == o ? parseInt(o, 10) + "st" : 2 == o || 22 == o ? parseInt(o, 10) + "nd" : 3 == o || 23 == o ? parseInt(o, 10) + "rd" : parseInt(o, 10) + "th", c = "";
                                    break;
                                case "MMMM":
                                    h += (M = s, void 0, g = parseInt(M, 10) - 1, w[g] || M), c = "";
                                    break;
                                case "MMM":
                                    if ("M" === f) break;
                                    h += (k = s, void 0, p = parseInt(k, 10) - 1, v[p] || k), c = "";
                                    break;
                                case "MM":
                                    if ("M" === f) break;
                                    h += D(s, 2), c = "";
                                    break;
                                case "M":
                                    if ("M" === f) break;
                                    h += parseInt(s, 10), c = "";
                                    break;
                                case "y":
                                case "yyy":
                                    if ("y" === f) break;
                                    h += c, c = "";
                                    break;
                                case "yy":
                                    if ("y" === f) break;
                                    h += String(n).slice(-2), c = "";
                                    break;
                                case "yyyy":
                                    h += n, c = "";
                                    break;
                                case "HH":
                                    h += D(u.hour, 2), c = "";
                                    break;
                                case "H":
                                    if ("H" === f) break;
                                    h += parseInt(u.hour, 10), c = "";
                                    break;
                                case "hh":
                                    h += D(t = 0 === parseInt(u.hour, 10) ? 12 : u.hour < 13 ? u.hour : u.hour - 12, 2), c = "";
                                    break;
                                case "h":
                                    if ("h" === f) break;
                                    t = 0 === parseInt(u.hour, 10) ? 12 : u.hour < 13 ? u.hour : u.hour - 12, h += parseInt(t, 10), c = "";
                                    break;
                                case "mm":
                                    h += D(u.minute, 2), c = "";
                                    break;
                                case "m":
                                    if ("m" === f) break;
                                    h += parseInt(u.minute, 10), c = "";
                                    break;
                                case "ss":
                                    h += D(u.second.substring(0, 2), 2), c = "";
                                    break;
                                case "s":
                                    if ("s" === f) break;
                                    h += parseInt(u.second, 10), c = "";
                                    break;
                                case "S":
                                case "SS":
                                    if ("S" === f) break;
                                    h += c, c = "";
                                    break;
                                case "SSS":
                                    h += D(u.millis.substring(0, 3), 3), c = "";
                                    break;
                                case "a":
                                    h += 12 <= u.hour ? "PM" : "AM", c = "";
                                    break;
                                case "p":
                                    h += 12 <= u.hour ? "p.m." : "a.m.", c = "";
                                    break;
                                case "E":
                                    h += (b = i, O[parseInt(b, 10)] || b), c = "";
                                    break;
                                case "'":
                                    c = "", m = !0;
                                    break;
                                default:
                                    h += d, c = ""
                            }
                        }
                        return h += l
                    } catch (e) {
                        return console && console.log && console.log(e), a
                    }
                    var b, k, p, M, g, S
                },
                prettyDate: function(e) {
                    var a, r, t, n, s;
                    if ("string" != typeof e && "number" != typeof e || (a = new Date(e)), "object" == typeof e && (a = new Date(e.toString())), r = ((new Date).getTime() - a.getTime()) / 1e3, t = Math.abs(r), n = Math.floor(t / 86400), !isNaN(n)) return s = r < 0 ? "from now" : "ago", t < 60 ? 0 <= r ? "just now" : "in a moment" : t < 120 ? "1 minute " + s : t < 3600 ? Math.floor(t / 60) + " minutes " + s : t < 7200 ? "1 hour " + s : t < 86400 ? Math.floor(t / 3600) + " hours " + s : 1 === n ? 0 <= r ? "Yesterday" : "Tomorrow" : n < 7 ? n + " days " + s : 7 === n ? "1 week " + s : n < 31 ? Math.ceil(n / 7) + " weeks " + s : "more than 5 weeks " + s
                },
                toBrowserTimeZone: function(e, a) {
                    return this.date(new Date(e), a || "MM/dd/yyyy HH:mm:ss")
                }
            }
        }()
    }(), jQuery.format = DateFormat.format;
    function convertTZ(date, tzString) {
    return new Date((typeof date === "string" ? new Date(date) : date).toLocaleString("en-US", {timeZone: tzString}));   
}
</script>
<script>
  
    $(document).ready(function() {
   
        $('.btnDelete').click(function() {
            Swal.fire({
                title: 'Bạn chắn chắn muốn xóa đơn hàng?',
                text: "Một khi đã xóa, không thể phục hồi....",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Hủy',
                confirmButtonText: 'Xác nhận'
            }).then((result) => {
                if (result.isConfirmed) {
                    var dh_id = $(this).data('id');
                        var url = "admin/donhang/xoa/" + dh_id;
                       
                        location.href = url;
                    Swal.fire(
                        'Đã xóa',
                        'Đơn hàng đã được xóa',
                        'success'
                    )
                }
            })
        });

        function capnhatDangGiaoHang(id) {
            // Dữ liệu gởi
            var dulieugoi = {
                dh_id: id,
            };
            console.log(dulieugoi);
            $.ajax({
                url: 'admin/donhang/donhang-danggiaohang',
                method: "POST",
                dataType: 'json',
                data: dulieugoi,
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Cập nhật đang giao hàng thành công',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $('#choxuly_' + data.id).removeClass('badge-danger').addClass('badge-primary');
                    $('#choxuly_' + data.id).html('Đang giao hàng');
                    $('#dh_' + data.id).attr('data-dagiaohang', data.id);
                    $('#dh_' + data.id).removeClass('btn-capnhat-danggiaohang').addClass('btn-capnhat-dagiaohang');
                    $('#choxuly_' + data.id).attr("id", 'danggiaohang_' + data.id);
                    
                    $('#ngaycapnhat_' + data.id).html($.format.date(convertTZ(data.updated_at, "Asia/Ho_Chi_Minh"), 'dd/MM/yyyy HH:mm:ss'));

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    var htmlString = `<h6>Không thể xử lý</h6>`;
                    $('#thongbao').html(htmlString);
                    // Hiện thông báo
                    $('.alert').removeClass('d-none').addClass('show');
                }
            });
            
        };
        $('#dataTable').on('click', '.btn-capnhat-danggiaohang', function(event) {
            event.preventDefault();
            var id = $(this).data('danggiaohang');
            console.log(id);
            capnhatDangGiaoHang(id);
        });
        // Đang giao hàng
        function capnhatDaGiaoHang(id) {
            // Dữ liệu gởi
            var dulieugoi = {
                dh_id: id,
            };
            console.log(dulieugoi);
            $.ajax({
                url: 'admin/donhang/donhang-dagiaohang',
                method: "POST",
                dataType: 'json',
                data: dulieugoi,
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Cập nhật đã giao hàng thành công',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $('#danggiaohang_' + data.id).removeClass('badge-primary').addClass('badge-success');
                    $('#danggiaohang_' + data.id).html('Đã giao hàng');
                    $('#ngaycapnhat_' + data.id).html($.format.date(convertTZ(data.updated_at, "Asia/Ho_Chi_Minh"), 'dd/MM/yyyy HH:mm:ss'));
                    $('#dh_' + data.id).removeClass('btn-capnhat-dagiaohang');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    var htmlString = `<h6>Không thể xử lý</h6>`;
                    $('#thongbao').html(htmlString);
                    $('.alert').removeClass('d-none').addClass('show');
                }
            });
            
        };
        $('#dataTable').on('click', '.btn-capnhat-dagiaohang', function(event) {
            event.preventDefault();
            var id = $(this).data('dagiaohang');
            console.log(id);
            capnhatDaGiaoHang(id);
        });
    });
 
</script>

<?php $this->stop() ?>