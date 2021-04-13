<div class="ticket-view container">
    <div class="row col-12">
        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <figure class="avatar150 rounded border">
                            <?= get_avatar($info["sid"], 128, false) ?>
                        </figure>
                    </div>
                    <hr/>
                    <p class="card-text">
                        <div class="ui list">
                            <div class="item">
                                <h6 class="ui sub header"><i class="fas fa-user"></i></i> <?= __('ticket_system/tss_view.account'); ?></h6>
                                <div class="content small" style="text-transform: capitalize;"><a href="?page=user_view&id=<?= $info["sid"] ?>" target="_blank"><?= $info["account"] ?></a></div>
                            </div>
                            <div class="item">
                                <h6 class="ui sub header"><i class="fas fa-globe-americas"></i></i> <?= __('ticket_system/tss_view.country'); ?></h6>
                                <div class="content small" style="text-transform: capitalize;">
                                    <img src="<?= App::getAsset('/img/flags/'.strtolower($info['country']).'.png') ?>" style="margin-bottom: 4px;"/>
                                    <?= @COUNTRIES[$info['country']] ?>
                                </div>
                            </div>
                            <div class="item">
                                <h6 class="ui sub header"><i class="fas fa-envelope"></i></i> <?= __('ticket_system/tss_view.email'); ?></h6>
                                <div class="content small"><a href="mailto:<?= $info["email"] ?>"><?= $info["email"] ?></a></div>
                            </div>
                            <div class="item">
                                <h6 class="ui sub header"><i class="fas fa-calendar-alt"></i></i> <?= __('ticket_system/tss_view.register'); ?></h6>
                                <div class="content small"><?= date('Y-m-d', $info["registered"]) ?></div>
                            </div>
                        </div>
                    </p>    
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <a class="text-muted small"><?= __('ticket_system/tss_view.opening'); ?> : <?= $info["create_date"] ?></a></br>
                    <?php if($info['close_date']) : ?>
                        <a class="text-muted small"><?= __('ticket_system/tss_view.closing'); ?> : <?= $info["close_date"] ?></a></br>
                        <a class="text-muted small"><?= __('ticket_system/tss_view.rate'); ?> : <?php if(isset($info["score"])){ echo $info["score"]; }else{ echo "N/A"; } ?> / 5</a>
                    <?php endif; ?>
                </div>
            </div>
            <p class="center">
                <?php if($info['close_date'] === NULL) : ?>
                    <button name="mark_solved" data-id="<?= App::GET('id') ?>" class="btn btn-sm btn-success"><?= __('ticket_system/tss_view.masolved'); ?></button>
                <?php else : ?>
                    <button name="mark_unsolved" data-id="<?= App::GET('id') ?>" class="btn btn-sm btn-danger"><?= __('ticket_system/tss_view.masusolved'); ?></button>
                <?php endif; ?>
            </p>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8 col-xl-9">
            <div class="card">
                <?php if($info['close_date']) : ?>
                    <span class="ui red ribbon label"><?= __('ticket_system/tss_view.ticket_close'); ?></span>
                <?php endif; ?>
                <div class="card-body">
                    <blockquote style="overflow-wrap: break-word;">
                        <?= $info["short_desc"]; ?>
                    </blockquote>
                    <div id="converbloc" class="card-text">
                        <?php foreach($content AS $key => $val) : ?>

                            <?php if($val['sid'] > '0') : ?>
                                <div class="media">
                                    <img src="<?= get_avatar($val['sid'], 64, true) ?>" class="align-self-start mr-3 border rounded" />
                                    <div class="media-body">
                                        <span class="text-muted small"><?= $info['account'] ?></span></br>
                                        <span class="text-muted small"><?= $val['send_date'] ?></span></br>
                                        <div class="blue-text text-darken-2" style="font-family: ubuntu;font-weight: 500;"><?= $val['msg'] ?></div>
                                    </div>
                                </div>

                            <?php else : ?>

                                <div class="media text-right">
                                    <div class="media-body">
                                        <span class="text-muted small"><?= __('ticket_system/tss_view.smember'); ?></span></br>
                                        <span class="text-muted small"><?= $val['send_date'] ?></span></br>
                                        <div class="green-text text-darken-2" style="font-family: ubuntu;font-weight: 500;"><?= $val['msg'] ?></div>
                                    </div>
                                    <img src="<?= get_avatar($val['mid'], 64, true) ?>" class="align-self-start mx-3 border rounded" style="margin-right:0 !important">
                                </div>

                            <?php endif; ?>
                            
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php if(!$info['close_date']) : ?>
                <h4 class="ui horizontal divider header"><i class="tag icon"></i><?= __('ticket_system/tss_view.addcomm'); ?></h4>
                <div class="card">
                    <div id="ticket-ans" class="card-body">
                        <textarea name="ticket_answer_msg" class="form-control" style="border-radius: 0px" rows="3" autofocus></textarea>
                    </div>
                    <button data-id="<?= App::GET('id') ?>" name="ticket_answer_btn" class="btn btn-sm btn-primary" type="submit"><?= __('ticket_system/tss_view.send'); ?></button>                </div>
            <?php endif; ?>
        </div>
    </div>
</div>