<?php require_once __DIR__."/core/functions.php"; ?>

<link rel="stylesheet" href="../plugins/eshop/pages_admin/assets/css/semantic.css"/>
<link rel="stylesheet" href="../plugins/eshop/pages_admin/assets/css/admin.css" rel="stylesheet"/>
<link rel="stylesheet" href="../plugins/eshop/pages_admin/assets/css/style.css" rel="stylesheet"/>
<link rel="stylesheet" href="../plugins/eshop/pages_admin/assets/css/print.css" type="text/css" media="print"/>
<script type="text/javascript" src="../plugins/eshop/pages_admin/assets/js/semantic.js"></script>
<script type="text/javascript" src="../plugins/eshop/pages_admin/assets/js/ajax.js"></script>

<div id="eshop-header" class="ui menu stackable">
    <div class="header item">{ eSH0P }</div>
        <a href="?p=eshop/dashboard" name="dash" class="evo-item item"><i class="desktop icon"></i> Dashboard</a>
        <a href="?p=eshop/customers" name="customers" class="evo-item item"><i class="users icon"></i> Consumers</a>
    <div class="ui dropdown item">
        <i class="file alternate outline icon"></i> Invoices <i class="dropdown icon"></i>
        <div class="menu">
            <a href="?p=eshop/invoices" name="overview" class="evo-item item"><i class="list alternate outline icon"></i> Overview</a>
            <a href="?p=eshop/invoices&state=1" name="paid" class="evo-item item"><i class="check icon"></i> Paid</a>
            <a href="?p=eshop/invoices&state=0" name="unpaid" class="evo-item item"><i class="hourglass outline icon"></i> Unpaid</a>
            <a href="?p=eshop/invoices&state=2" name="canceled" class="evo-item item"><i class="close icon"></i> Canceled</a>
            <a href="?p=eshop/invoices&state=3" name="refunded" class="evo-item item"><i class="undo alternate icon"></i> Refund</a>
        </div>
    </div>
    <div class="ui dropdown item">
        <i class="window restore outline icon"></i> Contents <i class="dropdown icon"></i>
        <div class="menu">
            <a href="?p=eshop/categories" name="categories" class="evo-item item"><i class="list alternate outline icon"></i> Categories</a>
            <a href="?p=eshop/patterns" name="patterns" class="evo-item item"><i class="first order icon"></i> Patterns</a>
            <a href="?p=eshop/products" name="products" class="evo-item item"><i class="th icon"></i> Products</a>
            <a href="?p=eshop/discounts" name="categories" class="evo-item item"><i class="tags icon"></i> Discounts</a>
        </div>
    </div>
    <div class="right menu">
        <a href="?p=eshop/settings" class="item" name="settings" ><i class="cog icon"></i> Settings</a>
		<a href="?p=eshop/help" class="item" name="help" ><i class="far fa-question-circle"></i></a>
    </div>
</div>

<div id="eshop-content" class="ui container"> <!-- Start of eshop-content div !-->