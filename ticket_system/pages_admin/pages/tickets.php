<div class="container">
    <table id="tickets_list" class="table table-dark table-hover small">
        <?php if($type === "close") : ?>
            <thead>
                <tr>
                    <th><input type="checkbox" id="autoSizingCheck"></th>
                    <th scope="col"><?= __('ticket_system/tss_table.account'); ?></th>
                    <th scope="col"><?= __('ticket_system/tss_table.subject'); ?></th>
                    <th scope="col"><?= __('ticket_system/tss_table.end_date'); ?></th>
                    <th scope="col"><?= __('ticket_system/tss_table.assigned'); ?></th>
                    <th scope="col"><?= __('ticket_system/tss_table.rate'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if($get) : ?>
                    <?php foreach($get as $key => $value) : ?>
                        <tr class="bg-light">
                            <th><input type="checkbox" id="autoSizingCheck"></th>
                            <td><a href="/admin/?page=user_view&id=<?= $value['sid']; ?>" target="_blank"><?= $value["account"] ?></a></td>
                            <td><a href="?p=ticket_system/view&id=<?= $value["id"] ?>"><?= $value["subject"] ?></a></td>
                            <td><?= $value["close_date"] ?></td>
                            <td><?= $value["assignation"] ?></td>
                            <td><?= $value["score"] ?></td>
                        </tr>
                    <?php endforeach; ?>
                        <td colspan="1" class="bg-light">
                            <button class="btn btn-danger btn-sm" style="float:left"><i class="far fa-trash-alt"></i></button>
                        </td>
                        <td colspan="6" class="bg-light">
                            <ul class="pagination right" style="margin:0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item" aria-current="page">
                                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </td>
                <?php else : ?>
                    <td colspan="7">
                        <div class="alert alert-primary text-center"><?= __('ticket_system/tss_alert.solved'); ?></div>
                    </td>
                <?php endif; ?>
            </tbody>
        <?php elseif($type === "critical") : ?>
            <thead>
                <tr>
                    <th><input type="checkbox" id="autoSizingCheck"></th>
                    <th scope="col"><?= __('ticket_system/tss_table.account'); ?></th>
                    <th scope="col"><?= __('ticket_system/tss_table.subject'); ?></th>
                    <th scope="col"><?= __('ticket_system/tss_table.end_date'); ?></th>
                    <th scope="col"><?= __('ticket_system/tss_table.assigned'); ?></th>
                    <th scope="col"><?= __('ticket_system/tss_table.action'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if($get) : ?>
                    <?php foreach($get as $key => $value) : ?>
                        <tr class="bg-light">
                            <th><input type="checkbox" id="autoSizingCheck"></th>
                            <td><a href="/admin/?page=user_view&id=<?= $value['sid']; ?>" target="_blank"><?= $value["account"] ?></a></td>
                            <td><a href="?p=ticket_system/view&id=<?= $value["id"] ?>"><?= $value["subject"] ?></a></td>
                            <td><?= $value["close_date"] ?></td>
                            <td><a href="/admin/?page=user_view&id=<?= $value['assignation']; ?>" target="_blank"><?= $value["assignation"] ?></a></td>
                            <td>
                                <button class="btn btn-sm" title="<?= __('ticket_system/tss_table_btn.delete'); ?>"><i class="fa fa-trash fa-sm"></i></button>
                                <button class="btn btn-sm" title="<?= __('ticket_system/tss_table_btn.close'); ?>"><i class="fa fa-lock fa-sm"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                        <td colspan="1" class="bg-light">
                            <button class="btn btn-danger btn-sm" style="float:left"><i class="far fa-trash-alt"></i></button>
                        </td>
                        <td colspan="6" class="bg-light">
                            <ul class="pagination right" style="margin:0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item" aria-current="page">
                                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </td>
                <?php else : ?>
                    <td colspan="7">
                        <div class="alert alert-primary text-center"><?= __('ticket_system/tss_alert.nocritical'); ?></div>
                    </td>
                <?php endif; ?>
            </tbody>
        <?php elseif($type === "open") : ?>
            <thead>
                <tr>
                    <th><input type="checkbox" id="autoSizingCheck"></th>
                    <th scope="col"><?= __('ticket_system/tss_table.account'); ?></th>
                    <th scope="col"><?= __('ticket_system/tss_table.subject'); ?></th>
                    <th scope="col"><?= __('ticket_system/tss_table.start_date'); ?></th>
                    <th scope="col"><?= __('ticket_system/tss_table.assigned'); ?></th>
                    <th scope="col"><?= __('ticket_system/tss_table.action'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if($get) : ?>
                    <?php foreach($get as $key => $value) : ?>
                        <tr class="bg-light">
                            <th><input type="checkbox" id="autoSizingCheck"></th>
                            <td><a href="/admin/?page=user_view&id=<?= $value['sid']; ?>" target="_blank"><?= $value["account"] ?></a></td>
                            <td><a href="?p=ticket_system/view&id=<?= $value["id"] ?>"><?= $value["subject"] ?></a></td>
                            <td><?= $value["create_date"] ?></td>
                            <td><a href="/admin/?page=user_view&id=<?= $value['assignation']; ?>" target="_blank"><?= $value["assignation"] ?></a></td>
                            <td>
                                <button class="btn btn-sm" title="<?= __('ticket_system/tss_table_btn.delete'); ?>"><i class="fa fa-trash fa-sm"></i></button>
                                <button class="btn btn-sm" title="<?= __('ticket_system/tss_table_btn.close'); ?>"><i class="fa fa-lock fa-sm"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                        <td colspan="1" class="bg-light">
                            <button class="btn btn-danger btn-sm" style="float:left"><i class="far fa-trash-alt"></i></button>
                        </td>
                        <td colspan="6" class="bg-light">
                            <ul class="pagination right" style="margin:0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item" aria-current="page">
                                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </td>
                <?php else : ?>
                    <td colspan="7">
                        <div class="alert alert-primary text-center"><?= __('ticket_system/tss_alert.unsolved'); ?></div>
                    </td>
                <?php endif; ?>
            </tbody>
        <?php elseif($type === "unassigned") : ?>
            <thead class="thead-dark">
                <tr>
                    <th><input type="checkbox" id="autoSizingCheck"></th>
                    <th scope="col"><?= __('ticket_system/tss_table.account'); ?></th>
                    <th scope="col"><?= __('ticket_system/tss_table.subject'); ?></th>
                    <th scope="col"><?= __('ticket_system/tss_table.start_date'); ?></th>
                    <th scope="col"><?= __('ticket_system/tss_table.assigned'); ?></th>
                    <th scope="col"><?= __('ticket_system/tss_table.action'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if($get) : ?>
                    <?php foreach($get as $key => $value) : ?>
                        <tr>
                            <th><input type="checkbox" id="autoSizingCheck"></th>
                            <td><?= $value["account"] ?></td>
                            <td><a href="?p=ticket_system/view&id=<?= $value["id"] ?>"><?= $value["subject"] ?></a></td>
                            <td><?= $value["create_date"] ?></td>
                            <td><?= $value["assignation"] ?></td>
                            <td>
                                <button class="btn btn-sm" title="<?= __('ticket_system/tss_table_btn.delete'); ?>"><i class="fa fa-trash fa-sm"></i></button>
                                <button class="btn btn-sm" title="<?= __('ticket_system/tss_table_btn.close'); ?>"><i class="fa fa-lock fa-sm"></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                        <td colspan="1" class="bg-light">
                            <button class="btn btn-danger btn-sm" style="float:left"><i class="far fa-trash-alt"></i></button>
                        </td>
                        <td colspan="6" class="bg-light">
                            <ul class="pagination right" style="margin:0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item" aria-current="page">
                                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </td>
                <?php else : ?>
                    <td colspan="7">
                        <div class="alert alert-primary text-center"><?= __('ticket_system/tss_alert.unassigned'); ?></div>
                    </td>
                <?php endif; ?>
            </tbody>
        <?php endif; ?>
    </table>
</div>