<?php
require_once __DIR__ .'/../../database/api/getData.php';
require_once __DIR__ . '/../Menu/htmlElement.php';
class branchController extends getData{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $branch = $this->getData('branch');
        foreach ($branch as $index) {
            //tạo thẻ img
            $img = new html('img');
            $img->src = $index['img'];
            $img->alt = 'Hình ảnh chi nhánh';

            //tạo thẻ  tiêu đề chi nhánh
            $title = new html('h3');

            //tạo thẻ p địa chỉ chi nhánh
            $address = new html('p');

            //tạo thẻ div chứa tiêu đề và địa chỉ
            $itemBranchContent = new html('div');
            $itemBranchContent->class = 'item-branch-content';

            // tạo thẻ div chưa title tên chi nhánh
            $titleDiv = new html('div');
            $titleDiv->class = 'title';
            
            // tạo thẻ div chứa địa chỉ chi nhánh
            $addressDiv = new html('div');
            $addressDiv->class = 'address';

            // ráp lại
            echo '
            <div class="item-branch">
            <a href="#">'.$img->createHTML("", true).'</a>'.
            $itemBranchContent->createHTML(
                $titleDiv->createHTML('<h3>'.$index['name'].'</h3>') .
                $addressDiv->createHTML('<p>Địa chỉ: '.$index['address'].'</p>')
                )
            .'</div>
            ';
        }
    }
}

 ?>