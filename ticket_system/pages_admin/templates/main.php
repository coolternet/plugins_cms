<link rel="stylesheet" href="../modules/ticket_system/pages_admin/assets/css/styles.css"/>
<script type="text/javascript" src="../modules/ticket_system/pages_admin/assets/js/ajax.js"></script>
<script type="text/javascript" src="../modules/ticket_system/pages_admin/assets/js/Chart.js"></script>
<script type="text/javascript" src="../modules/ticket_system/pages_admin/assets/js/rating.js"></script>

<div class="plugin_header bg-grad-evo">
    <div class="container header">
        <div class="title left"><h3 class="text-white"><?= __('ticket_system/tss_header.name'); ?></h3>
            <span class="text-muted small"><?= __('ticket_system/tss_header.version'); ?> : <?= App::getModule('ticket_system')->version ?></span><br/>
            <span class="text-muted small"><?= __('ticket_system/tss_header.author'); ?> : <?=  App::getModule('ticket_system')->authors[0] ?></span>
        </div>
        <div class="opt right text-right text-white d-none d-md-block">
            <div class="input-group">
                <input type="search" placeholder="<?= __('ticket_system/tss_header.search'); ?>" class="form-control">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-dark" disabled title="Search"><i class="fa fa-search"></i></button>
                    <a href="?p=ticket_system/home" title="<?= __('ticket_system/tss_header.home'); ?>" class="btn btn-dark"><i class="fas fa-home"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>