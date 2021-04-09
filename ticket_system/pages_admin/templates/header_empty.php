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
                <div class="input-group-append">
                    <a href="?p=ticket_system/bug" title="<?= __('ticket_system/tss_header.bug'); ?>" class="btn btn-dark"><i class="fas fa-bug"></i></a>
                    <a href="?p=ticket_system/contact" title="<?= __('ticket_system/tss_header.contact'); ?>" class="btn btn-dark"><i class="far fa-envelope"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>