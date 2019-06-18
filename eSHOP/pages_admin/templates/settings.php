    <div id="evo-section-title">
        <div><i class="fas fa-cogs fa-sm"></i> Settings</div>    
    </div>
	
	<div class="ui grid stackable">
		<div class="four wide column">
			<div class="ui vertical tabular pointing menu">
				<a class="item active" data-tab="settings_global"><i class="angle right icon" style="float: left !important"></i> General</a>
				<a class="item" data-tab="settings_currency"><i class="angle right icon" style="float: left !important"></i> Currencys</a>
				<a class="item" data-tab="settings_carrier"><i class="angle right icon" style="float: left !important"></i> Carriers</a>
				<a class="item" data-tab="settings_taxe"><i class="angle right icon" style="float: left !important"></i> Tax</a>
				<a class="item" data-tab="settings_update"><i class="angle right icon" style="float: left !important"></i> Plugin Update</a>
			</div>
		</div>
		<div class="twelve wide column">
			<div class="ui stretched active tab" data-tab="settings_global"><?php require_once __DIR__ . '/blocs/settings_global.php'; ?></div>
			<div class="ui stretched tab" data-tab="settings_currency"><?php require_once __DIR__ . '/blocs/settings_currency.php'; ?></div>
			<div class="ui stretched tab" data-tab="settings_carrier"><?php require_once __DIR__ . '/blocs/settings_carrier.php'; ?></div>
			<div class="ui stretched tab" data-tab="settings_taxe"><?php require_once __DIR__ . '/blocs/settings_tax.php'; ?></div>
			<div class="ui stretched tab" data-tab="settings_update"><?php require_once __DIR__ . '/blocs/settings_update.php'; ?></div>
		</div>
	</div>
    