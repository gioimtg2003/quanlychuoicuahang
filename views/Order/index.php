<?php $title = "Đặt hàng";
$_pathCss = "/css/order.css";
require __DIR__ .'/../../inc/head.php' ?>
<section>
    <div class="-container-order">
        <div class="container-table">
            <div class="table">
                <table class="table-order">
                    <thead>
                        <tr>
                            <th>Số thứ tự</th>
                            <th>Mã đơn</th>
                            <th>Thời gian đặt hàng</th>
                            <th>Thời gian giao hàng</th>
                            <th>Thanh toán</th>
                            <th>Tổng giá</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>ABC123</td>
                            <td>2023-05-25 08:30:43</td>
                            <td>2023-05-25 08:30:43</td>
                            <td>Đã thanh toán</td>
                            <td>350000đ</td>
                            <td>Đã giao</td>
                            <td class="action">
                                <button>Hủy đơn</button>
                                <a href="#" target="_blank">Chi tiết</a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>ABC123</td>
                            <td>2023-05-25 08:30:43</td>
                            <td>2023-05-25 08:30:43</td>
                            <td>Đã thanh toán</td>
                            <td>350000đ</td>
                            <td>Đã giao</td>
                            <td class="action">
                                <button>Hủy đơn</button>
                                <a href="#" target="_blank" title="Xem chi tiết đơn hàng ">Chi tiết</a>
                            </td>
                        </tr>
                    </tbody>
            </table>
            </div>
        </div>
    </div>
</section>

