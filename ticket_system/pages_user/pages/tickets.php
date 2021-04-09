<div class="section-title">
    <div>
        <i class="fas fa-headset"></i> <?= __('ticket_system/tss_view.user_header'); ?>
    </div>
</div>
<div class="single-blog-details m-4">
    <div class="text-right">
        <a href="<?= APP::getUrl("support") ?>/create" class="bt-btn" data-original-title="new"><i class="far fa-edit"></i> <?= __('ticket_system/tss_table.action_create'); ?></a>
    </div>
    <br>
    <div class="table-responsive">
        <table id="tickets_list" class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col"><?= __('ticket_system/tss_table.id'); ?></th>
                    <th scope="col"><?= __('ticket_system/tss_table.start_date'); ?></th>
                    <th scope="col"><?= __('ticket_system/tss_table.subject'); ?></th>
                    <th scope="col"><?= __('ticket_system/tss_table.state'); ?></th>
                    <th scope="col" class="text-right"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($get_open AS $key) : ?>
                <tr data-id="<?= $key['id'] ?>">
                    <th scope="row"><?= $key['id'] ?></th>
                    <td><i class="far fa-calendar-alt"></i> <?= $key['create_date'] ?></td>
                    <td><a href="<?= APP::getURL('/support'); ?>/view&id=<?= $key['id'] ?>"><?= $key['subject'] ?></a></td>
                    <td><?= (empty($key['close_date'])) ? '<span class="new badge green" data-badge-caption="" style="font-size: inherit;font-weight: 500;">'. __('ticket_system/tss_table.state_open') .'</span>' : '<span class="new badge red" data-badge-caption="" style="font-size: inherit;font-weight: 500;">'. __('ticket_system/tss_table.state_close') .'</span>'; ?></td>
                    <td class="text-right">
                        <ul class="nav justify-content-end">
                            <li class="nav-item">
                                <?= (empty($key['close_date'])) ? '' : '<button name="delete_ticket" class="bt-btn"><i class="far fa-trash-alt"></i></button>'; ?>
                            </li>
                        </ul>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>