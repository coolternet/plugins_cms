<link rel="stylesheet" href="../modules/ticket_system/pages_admin/assets/css/styles.css"/>
<script type="text/javascript" src="../modules/ticket_system/pages_admin/assets/js/ajax.js"></script>

<div class="plugin_header bg-grad-evo">
    <div class="container header">
        <div class="title text-left">
            <h3 class="text-muted medium"><?= __('ticket_system/tss_view.h_ticket'); ?> #<?= $_GET['id'] ?></h3>
            <h2 class="text-white"><?= $title ?></h2>
        </div>
        <div class="opt right text-right text-white d-none d-md-block">
            <div class="input-group">
                <input type="search" placeholder="<?= __('ticket_system/tss_header.search_iner'); ?>" class="form-control">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-dark" disabled title="Search"><i class="fa fa-search"></i></button>
                    <a href="?p=ticket_system/home" class="btn btn-dark" title="Go to Home"><i class="fas fa-home"></i></a>
                    <a href="<?= $_SERVER["HTTP_REFERER"] ?>" class="btn btn-dark"  title="Back to tickets list"><i class="fas fa-stream"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>