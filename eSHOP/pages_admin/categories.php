    <?php
        include 'main.php';
     	
		$categories = eshop_get_categories();
		
		include 'templates/categories.php';
		
		function show_table(){
			
			$categories = eshop_get_categories();

			foreach($categories AS $val){

				$sub = eshop_get_subcategories($val['id']);
					
				echo '<div id="category">
						<h3 class="ui header">'. $val['name'] .'</h3>
						<table name="subcat_table" data-cid="'. $val['id'] .'" class="ui single line table">
							<thead>
								<tr>
									<th class="collapsing">ID</th>
									<th>Name</th>
									<th>Products</th>
									<th></th>
								</tr>
							</thead>
							<tbody>';
							foreach($sub AS $ckey => $cval){
								echo "<tr data-scid='". $cval['cid'] ."'><td class='collapsing'>". $cval['id'] ."</td><td>". $cval['name'] ."</td><td>0</td><td style='text-align: right'><button data-id='". $cval['id'] ."' data-name=". $cval['slug_name'] ." name='category_edit' class='btn btn-primary btn-sm'>Edit</button> <button data-id='". $cval['id'] ."' name='delete_category' class='btn btn-danger btn-sm'>Delete</button></td></tr>";
							}
				echo '		</tbody>
						</table>
					</div>';

			}

		}
		
		
		
    ?>

</div> <!-- End of eshop-content div !-->