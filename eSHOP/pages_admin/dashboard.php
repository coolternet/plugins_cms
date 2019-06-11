    <?php include 'main.php' ?>
    
    <div id="evo-section-title">
        <div><i class="fas fa-chart-line fa-sm"></i> Dashboard</div>    
    </div>

    <div class="bs-callout bs-callout-success" style="margin: 20px 20px 40px 20px;">
        <span>What mean Evo-{SH0P ? check out the statistic !</span>
    </div>
    
    <div class="ui tiny four statistics">
        <div class="statistic">
            <div class="value">10</div>
            <div class="label">Products</div>
        </div>

        <div class="statistic">
            <div class="value">3</div>
            <div class="label">Invoices</div>
        </div>
        <div class="statistic">
            <div class="value"><?= Db::Get('select count(*) from {users}') ?></div>
            <div class="label">Customers</div>
        </div>
        <div class="statistic">
            <div class="value">0</div>
            <div class="label"><i class="fas fa-dollar-sign"></i></div>
        </div>
    </div>

</div> <!-- End of eshop-content div !-->