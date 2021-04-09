<div class="section-title">
    <div>
        <i class="far fa-edit"></i> <?= __('ticket_system/tss_table.action_create'); ?>
    </div>
</div>
<div class="single-blog-details m-4">
    <form id="create-ticket" action="" method="post">
        <div class="form-group row">
            <label class="col-3 col-form-label text-right"><?= __('ticket_system/tss_create.subject'); ?></label>
            <div class="col-8">
                <input type="text" name="tc_subject" class="form-control" maxlength="64">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-3 col-form-label text-right"><?= __('ticket_system/tss_create.description'); ?></label>
            <div class="col-8">
                <div id="commentaire">
                    <textarea class="form-control" name="tc_comment" placeholder="Message" maxlength="1024" rows="3" style="resize: none;"></textarea>
                </div>
            </div>
        </div>
        <div style="margin-top: 10px;" class="col-md">
            <button class="btn blue darken-4 waves-effect waves-light btn-block" name="tcreate" type="submit" ><?= __('ticket_system/tss_table.action_create'); ?></button>
            <a href="<?= APP::getURL('/support'); ?>" class="btn blue darken-4 waves-effect waves-light btn-block" ><?= __('ticket_system/tss_table.action_cancel'); ?></a>
        </div>
    </form>
</div>