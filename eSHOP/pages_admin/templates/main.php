<?php require_once __DIR__."/../core/functions.php"; ?>

<link rel="stylesheet" href="../plugins/eshop/pages_admin/assets/css/semantic.css"/>
<link rel="stylesheet" href="../plugins/eshop/pages_admin/assets/css/admin.css" rel="stylesheet"/>
<link rel="stylesheet" href="../plugins/eshop/pages_admin/assets/css/style.css" rel="stylesheet"/>
<link rel="stylesheet" href="../plugins/eshop/pages_admin/assets/css/print.css" type="text/css" media="print"/>
<script type="text/javascript" src="../plugins/eshop/pages_admin/assets/js/semantic.js"></script>
<script type="text/javascript" src="../plugins/eshop/pages_admin/assets/js/ajax.js"></script>

<div id="eshop-header" class="ui menu">
    <div class="header item">{ eSH0P }</div>
        <a class="evo-item item" name="dashboard"><i class="desktop icon"></i> Dashboard</a>
        <a href="?p=eshop/customers" class="evo-item item" name="consumers"><i class="users icon"></i> Consumers</a>
    <div class="ui dropdown item">
        <i class="file alternate outline icon"></i> Invoices <i class="dropdown icon"></i>
        <div class="menu">
            <a href="?p=eshop/invoices" class="evo-item item" name="overview"><i class="list alternate outline icon"></i> Overview</a>
            <a href="?p=eshop/invoices&state=1" class="evo-item item" name="paid"><i class="check icon"></i> Paid</a>
            <a href="?p=eshop/invoices&state=0" class="evo-item item" name="unpaid"><i class="hourglass outline icon"></i> Unpaid</a>
            <a href="?p=eshop/invoices&state=2" class="evo-item item" name="canceled"><i class="close icon"></i> Canceled</a>
            <a href="?p=eshop/invoices&state=3" class="evo-item item" name="refunded"><i class="undo alternate icon"></i> Refunded</a>
        </div>
    </div>
    <div class="ui dropdown item">
        <i class="window restore outline icon"></i> Contents <i class="dropdown icon"></i>
        <div class="menu">
            <a href="?p=eshop/categories" class="evo-item item" name="categories"><i class="list alternate outline icon"></i> Categories</a>
            <a href="?p=eshop/patterns" class="evo-item item" name="patterns"><i class="first order icon"></i> Patterns</a>
            <a href="?p=eshop/products" class="evo-item item" name="products"><i class="th icon"></i> Products</a>
        </div>
    </div>
    <div class="right menu">
        <div class="ui category search item">
            <div class="ui transparent icon input">
                <input class="prompt" type="text" placeholder="Search ...">
                <i class="search link icon"></i>
            </div>
            <div class="results"></div>
        </div>
        <a class="item"><i class="help icon"></i> Help</a>
    </div>
</div>

<div id="eshop-content" class="ui container"> <!-- Start of eshop-content div !-->