	<div class="ui horizontal divider">Create a new government tax charge</div>
	<form id="bloc_taxe_management" class="ui form">
		<div class="ui segment">
			<div class="ui two column very stackable grid">
				<div class="column">
					<div class="ui grid">
						<div class="six wide column middle aligned">
							<label class="right"><b>Tax's Name</b></label>
						</div>
						<div class="ten wide column field">
							<input name="new_taxe_name" type="text">
						</div>
						<div class="six wide column middle aligned">
							<label class="right"><b>Abbreviation</b></label>
						</div>
						<div class="ten wide column field">
							<input name="new_taxe_abbrev" type="text">
						</div>
						<div class="six wide column middle aligned">
							<label class="right"><b>Tax Rate</b></label>
						</div>
						<div class="ten wide column field">
							<input name="new_taxe_value" type="number" step="0.1" min="0" max="100">
						</div>
						<div class="six wide column middle aligned">
							<label class="right"><b>Tax's Number</b></label>
						</div>
						<div class="ten wide column field">
							<input name="new_taxe_number" type="text">
						</div>
					</div>
				</div>
				<div class="column middle aligned center">
					<button id="megabutton" name="create_tax" type="submit" class="ui button big basic purple">Create the new tax</button>
				</div>
			</div>
			<div class="ui vertical divider">AND</div>
		</div>
		<div class="ui error message"></div>
	</form>
	<div id="tax_tool">
		<div class="ui horizontal divider">Financial Calculator</div>
		<div class="ui segment">
			<div class="ui equal width grid form stackable container">
				<div class="column">
					<div class="field">
						<label>Amount</label>
						<input name="ht_amount"type="number" min="0">
					</div>
				</div>
				<div class="column">
					<div class="field">
						<label>Tax's Charge</label>
						<select name="tax" multiple="" class="ui dropdown"></select>
					</div>
				</div>
				<div class="column middle aligned">
					<div class="field center">
						<h1 class="ui header" name="sumtax" style="margin:0px">0.00 </h1>
						<p class="small"><?= $settings['shop_currency_default'] ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="ui horizontal divider">Tax table registered</div>
	<table name="tax_list" class="ui celled table">
		<thead>
			<tr>
				<th>Taxe Name</th>
				<th>Abbreviated</th>
				<th>Value</th>
				<th>Taxe number</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($taxes as $key => $val){ ?>
			<tr data-id="<?php echo $val['id'] ?>">
				<td data-name="<?= $val['id'] ?>" ><?php echo $val['name'] ?></td>
				<td data-code="<?= $val['id'] ?>" style="text-transform: capitalize;"><?php echo $val['code'] ?></td>
				<td data-rate="<?= $val['id'] ?>" ><?php echo $val['rate'] ?></td>
				<td data-num="<?= $val['id'] ?>" style="text-transform: capitalize;"><?php echo $val['tnumber'] ?></td>
				<td style="text-align: right">
					<button name="edit_tax" data-id="<?php echo $val['id'] ?>" class="ui button blue basic tiny">Edit</button>
					<button name="delete_tax" data-id="<?php echo $val['id'] ?>" class="ui button red basic tiny">Delete</button>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>