<div class="container">
    <div id="tickets_stats_bloc" class="row">
        <a href="?p=ticket_system/tickets&state=completed" class="col-sm-12 col-md-3 col-lg-3">
            <div class="card completed">
                <div class="card-body">
                    <span class="icon-background fa fa-lock"></span>
                    <div class="card-text ui four statistics">
                        <div class="statistic">
                            <h1 class="text-right"><?= ticket_count_close(); ?></h1>
                            <div class="label text-right"><?= __('ticket_system/tss_home.completed'); ?></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted small">
                    <span><?= __('ticket_system/tss_home.details'); ?></span>
                    <span class="right"><i class="fas fa-arrow-circle-right"></i></span>
                </div>
            </div>
        </a>
        <a href="?p=ticket_system/tickets&state=critical" class="col-sm-12 col-md-3 col-lg-3">
            <div class="card critical">
                <div class="card-body">
                    <span class="icon-background fa fa-exclamation-circle"></span>
                    <div class="card-text ui four statistics">
                        <div class="statistic">
                            <h1 class="text-right"><?= ticket_count_critical(); ?></h1>
                            <div class="label text-right"><?= __('ticket_system/tss_home.critical'); ?></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted small">
                    <span><?= __('ticket_system/tss_home.details'); ?></span>
                    <span class="right"><i class="fas fa-arrow-circle-right"></i></span>
                </div>
            </div>
        </a>
        <a href="?p=ticket_system/tickets&state=opened" class="col-sm-12 col-md-3 col-lg-3">
            <div class="card inprogress">
                <div class="card-body">
                    <span class="icon-background fa fa-lock-open"></span>
                    <div class="card-text ui four statistics">
                        <div class="statistic">
                            <h1 class="text-right"><?= ticket_count_open(); ?></h1>
                            <div class="label text-right"><?= __('ticket_system/tss_home.open'); ?></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted small">
                    <span><?= __('ticket_system/tss_home.details'); ?></span>
                    <span class="right"><i class="fas fa-arrow-circle-right"></i></span>
                </div>
            </div>
        </a>
        <a href="?p=ticket_system/tickets&state=unassigned" class="col-sm-12 col-md-3 col-lg-3">
            <div class="card unassigned">
                <div class="card-body">
                    <span class="icon-background fa fa-user-times"></span>
                    <div class="card-text ui four statistics">
                        <div class="statistic">
                            <h1 class="text-right"><?= ticket_count_unassigned(); ?></h1>
                            <div class="label text-right"><?= __('ticket_system/tss_home.unassigned'); ?></div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted small">
                    <span><?= __('ticket_system/tss_home.details'); ?></span>
                    <span class="right"><i class="fas fa-arrow-circle-right"></i></span>
                </div>
            </div>
        </a>
    </div>

    <div id="tickets_list_bloc" class="row">
        <div class="col-sm-12 col-md-3 col-lg-3">
            <div class="card">
                <div class="ui statistic" style="margin-bottom: 0;margin-top: 30px;text-align: center;font-weight: 300;">
                    <h1><?= ticket_count(); ?></h1>
                    <div class="text-muted">
                        <?= __('ticket_system/tss_home.total'); ?>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="myChart" width="400" height="400"></canvas>
                    <script>
                    var ctx = document.getElementById('myChart');
                    var myChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                        labels: ['Open', 'Close', /*'Unassigned'*/ ],
                            datasets: [{
                                data: [<?= ticket_count_open(); ?>,<?= ticket_count_close(); ?>,<?= ticket_count_unassigned(); ?>],
                                backgroundColor: [
                                    //'rgba(255, 99, 132, 0.2)', // Red
                                    'rgba(54, 162, 235, 0.2)', // Blue
                                    //'rgba(255, 206, 86, 0.2)', // Yellow
                                    'rgba(75, 192, 192, 0.2)', // Green
                                    //'rgba(153, 102, 255, 0.2)', // Purple
                                    //'rgba(255, 159, 64, 0.2)' // Orange
                                ],
                                borderColor: [
                                    //'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    //'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    //'rgba(153, 102, 255, 1)',
                                    //'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                    });
                    </script>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-9 col-lg-9">
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-danger" role="alert" style="margin: 0;"><?= __('ticket_system/tss_admin.underconstruction'); ?></div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body" style="padding:0px;">
                    <table class="table table-hover card-footer text-muted small">
                        <thead class="thead-dark">
                            <tr>
                                <th><?= __('ticket_system/tss_table.id'); ?></th>
                                <th><?= __('ticket_system/tss_table.from'); ?></th>
                                <th><?= __('ticket_system/tss_table.start_date'); ?></th>
                                <th><?= __('ticket_system/tss_table.assigned'); ?></th>
                                <th><?= __('ticket_system/tss_table.state'); ?></th>
                                <th class="center"><?= __('ticket_system/tss_table.action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($count_open) : ?>
                                <?php foreach($get_open AS $key => $val) : ?>
                                    <tr class="bg-light" id="<?= $value["id"] ?>">
                                        <th><?= $val["id"] ?></th>
                                        <td><a href="/admin/?page=user_view&id=<?= $val['sid']; ?>" target="_blank"><?= $val["account"] ?></a></td>
                                        <td><?= $val["create_date"] ?></td>
                                        <td><?= $val["moderator"] ?></td>
                                        <td>Answered</td>
                                        <td class="center">
                                            <button class="btn btn-sm" name="delete_ticket" data-id="<?= $val["id"] ?>" title="<?= __('ticket_system/tss_table_btn.delete'); ?>"><i class="fa fa-trash fa-sm"></i></button>
                                            <button class="btn btn-sm" name="solved_ticket" data-id="<?= $val["id"] ?>" title="<?= __('ticket_system/tss_table_btn.close'); ?>"><i class="fa fa-lock fa-sm"></i></button>
                                            <button class="btn btn-sm" title="<?= __('ticket_system/tss_table_btn.view'); ?>"><a href="/admin/?p=ticket_system/view&id=<?= $val["id"] ?>"><i class="fa fa-eye"></i></a></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                            <tr class="bg-light">
                                <td colspan="6">
                                    <div class="alert alert-primary center" role="alert"><?= __('ticket_system/tss_home.no_topen'); ?></div>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>