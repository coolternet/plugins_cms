    <?php $uid = $_GET['user']; if(count(get_customer($uid)) > 0) { ?>
    <div id="evo-section-title">
        <div><i class="fas fa-user"></i> Customer : <?= get_customer($uid)['first_name'] && get_customer($uid)['last_name'] ? get_customer($uid)['first_name'].' '.get_customer($uid)['last_name'] : get_user($uid)['username'] ?></div>    
    </div>
    <div id="evo-section" class="ui two column grid">

        <div class="four wide column">
            <div class="ui secondary vertical tabular pointing menu">
                <a class="active item" data-tab="profil"><i class="user circle left icon"></i> Profil</a>
                <a class="item" data-tab="orders"><i class="shopping basket left icon"></i> Orders</a>
                <a class="item" data-tab="note"><i class="sticky note outline left icon"></i> Note's</a>
                <a class="item" data-tab="discount"><i class="tag left icon"></i> Discount's</a>
                <a class="item" data-tab="activity"><i class="newspaper outline left icon"></i> Activity's</a>
            </div>
        </div>
        
        <div class="twelve wide column">
            <div class="ui active tab" data-tab="profil">
                <?php include 'customer_contact.php'; ?>
            </div>
            <div class="ui tab" data-tab="orders">
                <?php include 'customer_orders.php'; ?>
            </div>
            <div class="ui tab" data-tab="note">
                <?php include 'customer_notes.php'; ?>
            </div>
            <div class="ui tab" data-tab="discount">
                <?php include "customer_discount.php" ?>
            </div>
            <div class="ui tab" data-tab="activity">
                <?php include "customer_journal.php" ?>
            </div>
        </div>
    </div>
    <?php } ?>