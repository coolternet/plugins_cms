<div class="container">
    <div id="tickets_stats_bloc" class="row">
        <div class="col-sm-12 col-md-4 col-lg-3 col-xl-3">
            <div class="card">
                <div class="card-header text-muted small">
                    <span>Ticket Settings</span>
                </div>
                <div class="card-body">
                    <div class="ui list" style="margin: 0em 0em;">
                        <div class="item">
                            <div class="form-group">
                                <label for="create_ticket_assignation"><i class="fas fa-user"></i> Utilisateur</label>
                                <select class="form-control form-control-sm" id="create_ticket_user">
                                    <?php
                                        foreach($get_users AS $gusers) {
                                            echo "<option value='". $gusers['id'] ."'>". $gusers['username'] ."</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="item">
                            <div class="form-group">
                                <label for="create_ticket_assignation"><i class="fas fa-user-tie"></i> Assignation</label>
                                <select class="form-control form-control-sm" id="create_ticket_assignation">
                                    <option value="0">Orphelin</option>
                                    <?php foreach($get_rank AS $modo_group) : ?>
                                        <optgroup label="<?= $modo_group['name'] ?>">
                                            <?php
                                                $get_assignation = \DB::Query("SELECT `id`,`username`,`group_id` FROM {users} WHERE {users}.group_id = :gid", [':gid' => $modo_group['id']]);
                                                foreach($get_assignation AS $members_group) {
                                                    echo "<option value='". $members_group['id'] ."'>". $members_group['username'] ."</option>";
                                                }
                                            ?>
                                        </optgroup>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="item">
                            <div class="form-group">
                                <label for="create_ticket_level"><i class="fas fa-layer-group"></i> Level</label>
                                <select class="form-control form-control-sm" id="create_ticket_level">
                                    <option value="0">Normal</option>
                                    <option value="1">Critique</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-9 col-xl-9">
            <form id="admin_create_ticket" method="post">
                <div class="card">
                    <div class="card-header text-muted small">
                        <span><?= __('ticket_system/tss_contact.about'); ?></span>
                    </div>
                    <div class="card-body">
                        <input type="text" class="form-control" name="atc_subject" id="create_ticket_subject" placeholder="<?= __('ticket_system/tss_contact.sub_placeholder'); ?>" data-rule-minlength="5" data-rule-maxlength="64" maxlength="64">
                    </div>
                </div>
                <div class="card">
                    <div class="card-header text-muted small">
                        <span><?= __('ticket_system/tss_contact.composer'); ?></span>
                    </div>
                    <div class="card-body">
                        <textarea class="form-control" name="atc_desc" id="create_ticket_desc" placeholder="<?= __('ticket_system/tss_contact.mes_placeholder'); ?>" data-rule-minlength="5" data-rule-maxlength="1000" maxlength="1000"></textarea>
                    </div>
                </div>
                <div class="contact_btn center">
                    <a class="btn btn-sm btn-dark center text-white" type="submit" name="btn_admin_cticket">Create the new ticket</a>
                </div>
            </form>
        </div>
    </div>
</div>