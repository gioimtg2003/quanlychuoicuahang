<?php $title = basename(__DIR__);
$_pathCss = "/css/branch.css";
require_once __DIR__ . '/branchController.php';
require_once __DIR__ . '/../../inc/head.php'?>
<section class="branch">
    <div class="container-branch">
        <div class="container-item">
            <?php
            $item = new branchController();
            $item->index();
             ?>
        </div>
    </div>
</section>
