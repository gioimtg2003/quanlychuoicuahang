<?php
require_once __DIR__ . '/paging.php';
require_once __DIR__ . '/htmlElement.php';
class product extends paging
{

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * xử lý dữ liệu để xuất ra dạng html
     */
    public function convertData()
    {
        $data = parent::getInfo();
        foreach ($data as $products) {
            echo ' <div class="item"> ';
            echo '<div class="img-content"><figure>';
            $imgHtml = new html('img');
            $imgHtml->src = $products['image'];
            $imgHtml->alt = $products['name'];
            $imgHtml->loading = 'lazy';
            echo $imgHtml->createHTML('', true);
            echo '</figure>

        </div>
        <div class="description">
              <div class="name-product">
                <h3>';
            $aHtml = new html('a');
            $aHtml->href = "product.php?id=$products[id]";
            $aHtml->title = $products['name'];
            $aHtml->onclick = "addCart()";
            echo $aHtml->createHTML($products['name'] );
            echo '</h3>
            <span class="sale">30%</span>
            </div>
          </div>
        <div class="price-add">
          <div class="price">';
            $spanHtml = new html('span');
            $spanHtml->title = 'Giá tiền';
            echo $spanHtml->createHTML((int) $products['price']);
            
            echo 'đ</div>
            <div class="add" >';
            $addHtml = new html('a');
            $addHtml->title = 'Thêm vào giỏ hàng';
            $addHtml->id = "product-id-" . $products['id'];
            $addHtml->__set('data-id', $products['id']);
            $addHtml->__set('data-name', $products['name']);
            $addHtml->__set('data-price', (int) $products['price']);
            $addHtml->__set('data-image', $products['image']);
            $addHtml->__set('data-quantity', 1);
            $addHtml->onclick = "addCart('"."product-id-" . $products["id"]."')";
            echo $addHtml->createHTML('<i class="fa-solid fa-cart-plus"></i>');
            echo '</div>
            </div>';
            echo '</div>' . "\n";
        }
    }
    /**
     * hiển thị số trang và nút next, prev
     */
    public function showPagination()
    {
        $prev = $this->pageCurrent >= 1 ? $this->pageCurrent - 1 : 1;
        $prevHtml = new html('a');
        $prevHtml->href = "index.php?page=$prev";
        $prevHtml->title = 'Trang trước';
        echo $prevHtml->createHTML('&laquo;');

        // hiển thị số trang
        for ($i = 1; $i <= $this->get_TotalPage(); $i++) {
            $numberPage = "<a href=\"index.php?page=$i\" title=\"Trang $i\"";
            if ($i == $this->pageCurrent) {
                $numberPage .= " class='active'";
            }
            $numberPage .= ">$i</a>";
            echo $numberPage . "\n";
        }

        // tạo biến next nếu nhỏ hơn trang hiện tại thì + 1 còn lớn hơn thì = trang hiện tại
        $next = $this->pageCurrent < $this->get_TotalPage() ? $this->pageCurrent + 1 : $this->get_TotalPage();
        $nextHtml = new html('a');
        $nextHtml->href = "index.php?page=$next";
        $nextHtml->title = 'Trang sau';
        echo $nextHtml->createHTML('&raquo;');
    }
}
