            <h4 class="ui dividing header">Journal d'Événement Commercial</h4>
            <table class="ui very basic table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>IP</th>
                        <th>Événement</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach(eshop_log_query($uid) as $key => $val) { ?>
                        <tr>
                            <td><?= $val['id'] ?></td>
                            <td><?= $val['date_created'] ?></td>
                            <td><?= $val['ip'] ?></td>
                            <td><?= $val['event'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br>
            <h4 class="ui dividing header">Journal d'Événement général</h4>
            <table class="ui very basic table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>IP</th>
                        <th>Événement</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach(evocms_log($uid) as $key => $val) { ?>
                        <tr>
                            <td><?= $val['id'] ?></td>
                            <td><?= date("Y-m-d H:i:s", $val['timestamp']) ?></td>
                            <td><?= $val['ip'] ?></td>
                            <td><?= $val['event'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>