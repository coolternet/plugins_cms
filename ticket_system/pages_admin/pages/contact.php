<div class="container">
    <div id="tickets_stats_bloc" class="row">
        <div class="col-sm-12 col-md-4 col-lg-3 col-xl-3">
            <div class="card">
                <div class="card-header text-muted small">
                    <span><?= __('ticket_system/tss_contact.prov_inf'); ?></span>
                </div>
                <div class="card-body">
                    <div class="ui list" style="margin: 0em 0em;">
                        <div class="item">
                            <h6 class="ui sub header"><i class="fa fa-globe"></i> <?= __('ticket_system/tss_contact.url'); ?></h6>
                            <div class="content small"><?= $_SERVER["SERVER_NAME"] ?></div>
                        </div>
                        <div class="item">
                            <h6 class="ui sub header"><i class="fa fa-envelope"></i> <?= __('ticket_system/tss_contact.email'); ?></h6>
                            <div class="content small"><?= App::getCurrentUser()->email ?></div>
                        </div>
                        <div class="item">
                            <h6 class="ui sub header"><i class="fas fa-tablet-alt"></i></i> <?= __('ticket_system/tss_contact.browser'); ?></h6>
                            <div class="content small"><?= $useragent ?></div>
                        </div>
                        <div class="item">
                            <h6 class="ui sub header"><i class="fas fa-map-marker"></i> <?= __('ticket_system/tss_contact.ip'); ?></h6>
                            <div class="content small"><?= $_SERVER['REMOTE_ADDR'] ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header text-muted small">
                    <span><?= __('ticket_system/tss_contact.Soft_inf'); ?></span>
                </div>
                <div class="card-body">
                    <div class="ui list" style="margin: 0em 0em;">
                        <div class="item">
                            <h6 class="ui sub header"><i class="fas fa-laptop-code"></i> <?= __('ticket_system/tss_contact.phpv'); ?></h6>
                            <div class="content small"><?= $phpver[0] ?></div>
                        </div>
                        <div class="item">
                            <h6 class="ui sub header"><i class="fas fa-database"></i> <?= __('ticket_system/tss_contact.mysqlv'); ?></h6>
                            <div class="content small"><?= Db::ServerVersion() ?></div>
                        </div>
                        <div class="item">
                            <h6 class="ui sub header"><i class="fas fa-microchip"></i> <?= __('ticket_system/tss_contact.cmsv'); ?></h6>
                            <div class="content small"><?= EVO_VERSION ?></div>
                        </div>
                        <div class="item">
                            <h6 class="ui sub header"><i class="fas fa-code-branch"></i> <?= __('ticket_system/tss_contact.commit'); ?></h6>
                            <div class="content small"><?= EVO_BUILD ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-9 col-xl-9">
            <form method="post">
                <div class="card">
                    <div class="card-header text-muted small">
                        <span><?= __('ticket_system/tss_contact.about'); ?></span>
                    </div>
                    <div class="card-body">
                        <input type="text" class="form-control" placeholder="<?= __('ticket_system/tss_contact.sub_placeholder'); ?>">
                    </div>
                </div>
                <div class="card">
                    <div class="card-header text-muted small">
                        <span><?= __('ticket_system/tss_contact.composer'); ?></span>
                    </div>
                    <div class="card-body">
                        <textarea class="form-control" placeholder="<?= __('ticket_system/tss_contact.mes_placeholder'); ?>"></textarea>
                    </div>
                </div>
                <div class="contact_btn center">
                    <button class="btn btn-sm btn-dark center">Send message</button>
                </div>
            </form>
        </div>
    </div>
</div>