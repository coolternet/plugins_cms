    <div id="evo-section-title">
        <div><i class="fas fa-folder fa-sm"></i> Categories</div>    
    </div>
	
	<div class="ui grid">

		<div class="four wide column">
			<div class="ui vertical tabular pointing menu">
				<a class="item active" data-tab="add_category"><i class="angle right icon" style="float: left !important"></i> Categories</a>
				<a class="item" data-tab="add_sub_category"><i class="angle right icon" style="float: left !important"></i> Sub-Categories</a>
				<a class="item" data-tab="add_company"><i class="angle right icon" style="float: left !important"></i> Companys</a>
			</div>
		</div>
		
		<div class="twelve wide stretched column">
	
			<div class="ui stretched active tab" data-tab="add_category">
			
				<form id="bloc_category" class="ui form">
					<div class="ui horizontal divider">Create a new category</div>
					<div class="ui grid centered alligned">
						<div class="five wide column">
							<div class="field">
								<h2 class="ui sub header">Category Name</h2>
								<input name="new_category_name" type="text">
							</div>
						</div>
						<div class="three wide column bottom aligned">
							<button name="create_category" class="ui button fluid green">Create</button>
						</div>
					</div>
					<div class="ui error message"></div>
					<hr>
				</form>
				
				<table name="cat_table" class="ui single line table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Sub-Categories</th>
							<th>Products</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($categories AS $key => $val){ ?>
						<tr data-id="<?= $val['id'] ?>">
							<td><?= $val['id'] ?></td>
							<td><?= $val['name'] ?></td>
							<td><?= subcat_counting($val['id']) ?></td>
							<td>0</td>
							<td style="text-align: right">
								<button data-id="<?= $val['id'] ?>" data-name="<?= $val['slug_name'] ?>" name="category_edit" class="btn btn-primary btn-sm">Edit</button>
								<button data-id="<?= $val['id'] ?>" name="delete_category" class="btn btn-danger btn-sm">Delete</button>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>

			<div class="ui stretched tab" data-tab="add_sub_category">
			
				<form id="bloc_add_subcategory" class="ui form">
					<div class="ui horizontal divider">Create a new sub-category</div>
					<div class="ui grid centered alligned">
						<div class="five wide column">
							<div class="field">
								<h2 class="ui sub header">Sub-Category Name</h2>
								<input name="new_subcat_name" type="text">
							</div>
						</div>
						<div class="five wide column">
							<div class="field">
								<h2 class="ui sub header">Category</h2>
								<select name="subselect_category"></select>
							</div>
						</div>
						<div class="five wide column bottom aligned">
							<div class="field">
								<button name="create_subcat" type="submit" class="ui green submit fluid button">Create a Sub-Category</button>
							</div>
						</div>
					</div>
					<div class="ui error message"></div>
				</form>

				<table class="ui table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Sub-Category's Name</th>
							<th>Category</th>
							<th>Products</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Processeur</td>
							<td>Informatique</td>
							<td>0</td>
							<td><button class="btn btn-sm btn-outline-primary">Edit</button> <button class="btn btn-sm btn-outline-danger">Delete</button></td>
						</tr>
						<tr>
							<td>1</td>
							<td>Tapis de souris</td>
							<td>Informatique > Accessoires</td>
							<td>0</td>
							<td><button class="ui button purple">Edit</button> <button class="ui button error">Delete</button></td>
						</tr>
					</tbody>
				</table>

				<?php show_table(); ?>
			</div>

			<div class="ui stretched tab" data-tab="add_company">

				<form id="bloc_add_company" class="ui form">
					<div class="ui horizontal divider">Add a new company</div>
					
					<div class="ui grid centered alligned">
						<div class="five wide column">
							<div class="field">
								<h2 class="ui sub header">Company's Name</h2>
								<input name="company_name" type="text">
							</div>
						</div>
						<div class="five wide column">
							<div class="field">
								<h2 class="ui sub header">Sub-Category's Name</h2>
								<select name="tag_sub_catname" multiple="" class="ui fluid dropdown">

								</select>
							</div>
						</div>
						<div class="five wide column bottom aligned">
							<div class="field">
								<button name="create_company" class="ui purple submit fluid button">Add the company</button>
							</div>
						</div>
					</div>
					<div class="ui error message"></div>
					<div class="ui horizontal divider">Or</div>
					<div class="ui grid centered alligned">
						<div class="seven wide column">
							<div class="field">
								<div class="ui icon action input">
									<input type="text" disabled placeholder="Search a company">
								</div>
							</div>
						</div>
					</div>
				</form>
				
				<h3 class="ui header"><hr></h3>
				<table class="ui table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Company's name</th>
							<th>Category</th>
							<th>Products</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Nintendo</td>
							<td>Consoles, Jeux, Accessoires</td>
							<td>0</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Intel</td>
							<td>Carte Mère, Unité de stockage, Processeur</td>
							<td>0</td>
						</tr>
					</tbody>
				</table>
			
			</div>
			
		</div>

	</div>