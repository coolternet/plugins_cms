    <div id="evo-section-title">
        <div><i class="fas fa-users fa-sm"></i> Customers</div>    
    </div>

    <div id="evo-section">
        <div class="ui placeholder segment">
            <div class="ui two column stackable center aligned grid">
                <div class="ui vertical divider">Or</div>
                <div class="middle aligned row">
                    <div class="column">
                        <div class="ui icon header"><i class="search icon"></i>Find Customer</div>
                        <div class="field">
                            <div class="ui search">
                                <div class="ui icon input">
                                    <input class="prompt" type="text" placeholder="Search customers...">
                                    <i class="search icon"></i>
                                </div>
                                <div class="results"></div>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="ui icon header"><i class="user plus icon"></i>Add New Customer</div>
                        <div class="ui primary button">Create</div>
                    </div>
                </div>
            </div>
        </div>
        <form method="post">
            <table class="ui very basic table">
                <thead>
                    <tr>
                        <th class="collapsing">
                            <div class="ui checkbox">
                                <input type="checkbox" id="checkAll">
                                <label for="checkAll"> </label>
                            </div>
                        </th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach(get_customers() as $user_list) { ?>
                    <tr>
                        <td class="collapsing">
                            <div class="ui checkbox">
                                <input type="checkbox" id="<?= $user_list['id'] ?>">
                                <label for="<?= $user_list['id'] ?>"> </label>
                            </div>
                        </td>
                        <td><a href="?p=eshop/customers&user=<?= $user_list['id'] ?>" name="customer"><?= $user_list['first_name'] && $user_list['last_name'] ? $user_list['first_name'].' '.$user_list['last_name'] : $user_list['username'] ?></a></td>
                        <td><a href="mailto:<?= $user_list['email'] ?>"><i class="mail icon"></i> <?= $user_list['email'] ?></a></td>
                        <td><i class="phone icon"></i> <?php if($user_list['phone']) { echo $user_list['phone']; }else{ echo "N/A"; } ?></td>
                        <td class="collapsing">
                            <a href="mailto:<?= $user_list['email'] ?>" class="ui icon" title="Send Email" name="customail" data-toggle="tooltip"  data-placement="top"><i class="large envelope green icon"></i></a>
                            <a class="ui icon" title="Edit Profil" name="custoprofil" data-placement="top" data-userid="<?php echo $user_list['id']; ?>" ><i class="large user violet circle outline icon"></i></a>
                            <?php if($user_list['phone']) { echo '<a href="tel:'. $user_list['phone']  .'" class="ui icon" title="Call" name="custophone" data-placement="top"><i class="large phone purple icon"></i></a>'; } ?>
                            <a href="#" class="ui icon" title="Delete" name="custodel" data-placement="top"><i class="large trash alternate outline red icon"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </form>

<div class="ui longer modal">
	<div class="header customname">
		Profil : <span></span>
	</div>
	<div class="scrolling content">
		<?php include 'modal_customer.php'; ?>
	</div>
	<div class="actions">
		<button name="save_profil" class="btn btn-small btn-success" data-userid="">Save Change</button>
	</div>
</div>

    </div> <!-- End of evo-section div !-->