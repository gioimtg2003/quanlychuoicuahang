<?php $title = basename(__DIR__);
$_pathCss = "/css/product/styles.css";
require_once __DIR__ . '/../../inc/head.php';
require_once __DIR__ . '/productController.php';
?>
<div class="alert-popup"></div>
<section class="products">
        <div class="container-product">
          <div class="tool-bar">
            <div class="product-type">
              <ul>
                <li><a href="#">Hamburger</a></li>
                <li><a href="#">Bánh mì</a></li>
                <li><a href="#">pizza</a></li>
                <li><a href="#">Bánh cuốn</a></li>
                <li><a href="#">Bánh kem</a></li>
              </ul>
            </div>
          </div>
          <div class="product-items">
            <?php $products = new productController();
$products->index();
?>
        </div>
        </div>
      </section>
      <section class="pagination">
        <div class="container-pagination">
        <?php $products->showPagination();?>
        </div>
      </section>
      


