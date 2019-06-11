        <div id="evo-section">
            <table id="evo-table" class="ui very basic table">
                <thead>
                    <tr>
                        <th class="collapsing">
                            <div class="ui checkbox">
                                <input type="checkbox" id="checkAll">
                                <label for="checkAll"> </label>
                            </div>
                        </th>
                        <th># Invoice</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>State</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    if(isset($_GET['state'])) {
                        foreach(get_invoices($_GET['state']) AS $key => $val) {
                ?>
                    <tr>
                        <td>
                            <div class="ui checkbox">
                                <input type="checkbox" id="<?= $val['invid'] ?>">
                                <label for="<?= $val['invid'] ?>"></label>
                            </div>
                        </td>
                        <td><a href="?p=eshop/invoices&id=<?= $val['invid'] ?>"><?= $val['invid'] ?></a></td>
                        <td><?= $val['first_name'] && $val['last_name'] ? $val['first_name'].' '.$val['last_name'] : $val['username'] ?></td>
                        <td>N/A $</td>
                        <td><?= $astate[$val['state']] ?></td>
                        <td>
                            <a href="#" class="ui icon" data-tooltip="Download a PDF file"><i class="file pdf outline violet large icon"></i></a>
                            <a href="#" class="ui icon" data-tooltip="Delete the invoice"><i class="trash alternate outline red large icon"></i></a>
                        </td>
                    </tr>
                <?php
                    } } else {
                    foreach(get_invoices() AS $key => $val) {
                ?>
                    <tr>
                        <td>
                            <div class="ui checkbox">
                                <input type="checkbox" id="<?= $val['invid'] ?>">
                                <label for="<?= $val['invid'] ?>"></label>
                            </div>
                        </td>
                        <td><a href="?p=eshop/invoices&id=<?= $val['invid'] ?>"><?= $val['invid'] ?></a></td>
                        <td><?= $val['first_name'] && $val['last_name'] ? $val['first_name'].' '.$val['last_name'] : $val['username'] ?></td>
                        <td>N/A $</td>
                        <td><?= $astate[$val['state']] ?></td>
                        <td>
                            <a href="#" class="ui icon" data-tooltip="Download a PDF file"><i class="file pdf outline violet large icon"></i></a>
                            <a href="#" class="ui icon" data-tooltip="Delete the invoice"><i class="trash alternate outline red large icon"></i></a>
                        </td>
                    </tr>
                <?php } } ?>
                </tbody>
            </table>