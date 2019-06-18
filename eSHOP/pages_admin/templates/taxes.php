    <div id="evo-section-title">
        <div><i class="percent icon"></i> Taxes Management</div>    
    </div>

    <div class="bs-callout bs-callout-danger" style="margin: 0px 20px;">
        <span>Before making a government tax charge, make sure you have your number for each tax you want to add.</span>
    </div>

	<div class="ui container">
		<div class="ui horizontal divider">Create a new government tax charge</div>
		
		<form id="bloc_taxe_management" class="ui small form segment">
			<div class="ui two column very relaxed grid">
				<div class="column">
					<div class="ui grid middle alligned">
						<div class="nine wide column centered aligned">
							<div class="field">
								<h2 class="ui sub header">Tax's Name</h2>
								<input name="new_taxe_name" type="text">
							</div>
						</div>
						<div class="nine wide column centered aligned">
							<div class="field">
								<h2 class="ui sub header">Abbreviation</h2>
								<input name="new_taxe_abbrev" type="text">
							</div>
						</div>
						<div class="nine wide column centered aligned">
							<div class="field">
								<h2 class="ui sub header">Tax Rate</h2>
								<input name="new_taxe_value" type="number" step="any" min="0" max="1">
							</div>
						</div>
						<div class="nine wide column centered aligned">
							<div class="field">
								<h2 class="ui sub header">Tax's Number</h2>
								<input name="new_taxe_number" type="text">
							</div>
						</div>
					</div>
				</div>
				<div class="column middle aligned content center">
					<button id="megabutton" name="create_tax" type="submit" class="ui button massive basic green">Create tax</button>
					<div class="ui error message"></div>
				</div>
			</div>
			<div class="ui vertical divider">
			and
			</div>
		</form>
	
		<table name="tax_list" class="ui celled table">
			<thead>
				<tr>
					<th>ID</th>
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
					<td><?php echo $val['id'] ?></td>
					<td><?php echo $val['name'] ?></td>
					<td style="text-transform: capitalize;"><?php echo $val['code'] ?></td>
					<td><?php echo $val['rate'] ?></td>
					<td style="text-transform: capitalize;"><?php echo $val['tnumber'] ?></td>
					<td style="text-align: right">
						<button name="edit_tax" data-id="<?php echo $val['id'] ?>" class="ui button blue basic tiny">Edit</button>
						<button name="delete_tax" data-id="<?php echo $val['id'] ?>" class="ui button red basic tiny">Delete</button>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		
	</div>