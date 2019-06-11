    <?php include 'main.php' ?>
    
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
			    <div class="bs-callout bs-callout-danger">
					<span>If you delete a category, all products in this category will also be deleted along with their patterns.</span>
				</div>
				<div class="ui center aligned basic segment">
					<div class="form-inline">
						<div class="ui horizontal divider">Create a new category</div>
						<div class="form-group mb-2">
							<input type="text" class="form-control" id="name_cat" placeholder="Category Name">
						</div>
						<button type="submit" class="btn btn-success mb-2">Create</button>
					</div>
				</div>
				
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
						<tr>
							<td>1</td>
							<td>Informatique</td>
							<td>3</td>
							<td>59</td>
							<td style="text-align: right">
								<button class="btn btn-primary btn-sm">Edit</button>
								<button class="btn btn-danger btn-sm">Delete</button>
							</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Jeux Vidéo</td>
							<td>2</td>
							<td>14</td>
							<td style="text-align: right">
								<button class="btn btn-primary btn-sm">Edit</button>
								<button class="btn btn-danger btn-sm">Delete</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="ui stretched tab" data-tab="add_sub_category">				
				<div class="ui center aligned basic segment">
					<div class="form-inline">
						<div class="ui horizontal divider">Create a new sub-category</div>
						<div class="form-group mb-2">
							<input type="text" class="form-control" id="name_cat" placeholder="sub-category name">
						</div>
						<div class="form-group mx-sm-3 mb-2">
							<select name="sub_category" class="form-control" placeholder="Select a Category">
								<option value="">Select a Category</option>
								<option value="1">Informatique</option>
								<option value="2">Jeux Vidéo</option>
							</select>
						</div>
						<button type="submit" class="btn btn-success mb-2">Create a Sub-Category</button>
					</div>
					<div class="ui horizontal divider">Or</div>
					<div class="ui center icon action input">
						<input type="text" placeholder="What are you looking for ?">
						<div class="ui blue submit button">Search</div>
					</div>
				</div>
				<h3 class="ui header">Informatique</h3>
				<table name="subcat_table" data-category="computer" class="ui single line table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Products</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Carte Graphique</td>
							<td>59</td>
							<td style="text-align: right">
								<button class="btn btn-primary btn-sm">Edit</button>
								<button class="btn btn-danger btn-sm">Delete</button>
							</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Processeur</td>
							<td>14</td>
							<td style="text-align: right">
								<button class="btn btn-primary btn-sm">Edit</button>
								<button class="btn btn-danger btn-sm">Delete</button>
							</td>
						</tr>
						<tr>
							<td>3</td>
							<td>Carte Mère</td>
							<td>8</td>
							<td style="text-align: right">
								<button class="btn btn-primary btn-sm">Edit</button>
								<button class="btn btn-danger btn-sm">Delete</button>
							</td>
						</tr>
					</tbody>
				</table>
				<h3 class="ui header">Jeux Vidéo</h3>
				<table name="subcat_table" data-category="jeux_video" class="ui single line table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Products</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>4</td>
							<td>Consoles</td>
							<td>6</td>
							<td style="text-align: right">
								<button class="btn btn-primary btn-sm">Edit</button>
								<button class="btn btn-danger btn-sm">Delete</button>
							</td>
						</tr>
						<tr>
							<td>5</td>
							<td>Jeux</td>
							<td>2489</td>
							<td style="text-align: right">
								<button class="btn btn-primary btn-sm">Edit</button>
								<button class="btn btn-danger btn-sm">Delete</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="ui stretched tab" data-tab="add_company"></div>
			
		</div>

	</div>

</div> <!-- End of eshop-content div !-->