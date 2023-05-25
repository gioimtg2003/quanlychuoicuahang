<?php
require_once __DIR__ . '/paging.php';
require_once __DIR__ . '/htmlElement.php';
class productController extends paging
{

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * xử lý dữ liệu để xuất ra dạng html
     */
    public function index()
    {
        $data = parent::getInfo();
        foreach ($data as $products) {
            echo ' <div class="item"> '. "\n";

            //tạo thẻ img-content
            $imgContent = new html('div');
            $imgContent->class = 'img-content';

            // tạo thẻ hiển thị ảnh sản phẩm
            $imgHtml = new html('img');
            $imgHtml->src = $products['image'];
            $imgHtml->alt = $products['name'];
            $imgHtml->loading = 'lazy';

            // hiển thị thẻ có class là img-content
            echo $imgContent->createHTML('<figure>' . $imgHtml->createHTML('', true) . '</figure>'. "\n");

            // tạo thẻ hiển thị tên sản phẩm vả sale
            $description = new html('div');
            $description->class = 'description';

            $nameProduct = new html('div');
            $nameProduct->class = 'name-product';
            // tạo thẻ hiển thị tên sản phẩm
            $nameHtml = new html('a');
            $nameHtml->href = 'product.php?=id=' . $products['id'];
            // tạo thẻ hiển thị giảm giá
            $saleHtml = new html('span');
            $saleHtml->class = 'sale';
            if ($products['discount'] > 0 && $products['discount'] != null) {
                $saleHtml->title = 'Giảm giá ' . $products['discount'] . '%';
                $saleHtml = $saleHtml->createHTML("-".$products['discount'] . '%');
            }else{
                $saleHtml = $saleHtml->createHTML('');
            }

            // hiển thị thẻ tên và giảm giá
            echo $description->createHTML(
                $nameProduct->createHTML(
                    '<h3>'.$nameHtml->createHTML($products['name']).'</h3>'.
                    $saleHtml
                )
            );
            // create class price-add
            $priceAdd = new html('div');
            $priceAdd->class = 'price-add';
            // create class price
            $price = new html('div');
            $price->class = 'price';
            // create class price
            $priceHtml = new html('span');
            $priceHtml->title = 'Giá sản phẩm';

            // create class add-cart
            $addCart = new html('div');
            $addCart->class = 'add';
            // create a tag
            $aTag = new html('a');
            $aTag->title = "Thêm vào giỏ hàng";
            $aTag->id = "product-id-" . $products['id'];
            $aTag->__set('data-id', $products['id']);
            $aTag->__set('data-name', $products['name']);
            $aTag->__set('data-price', (int) $products['price']);
            $aTag->__set('data-image', $products['image']);
            $aTag->__set('data-quantity', 1);
            $aTag->onclick = "addCart('"."product-id-" . $products["id"]."')";
  
            // hiển thị giá và thêm vào giỏ hàng
            echo $priceAdd->createHTML(
                $price->createHTML(
                    $priceHtml->createHTML((int)$products['price'] . 'đ')
                ) . 
                $addCart->createHTML(
                    $aTag->createHTML('<i class="fa-solid fa-cart-plus"></i>')
                ). "\n"
            );
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

?>