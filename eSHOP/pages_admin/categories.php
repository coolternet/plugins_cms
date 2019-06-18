    <?php
        include 'main.php';
     	
		$category = eshop_get_categories();
		
		include 'templates/categories.php';
		
		
		function show_table(){
			
			foreach(eshop_get_categories() AS $val){
				
			echo '	
					<div id="category" data-catid="'. $val['id'] .'">
						<h3 class="ui header">'. $val['name'] .'</h3>
						<table name="subcat_table" data-category="'. $val['slug_name'] .'" class="ui single line table">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Products</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				';
			}
			
		}
		
		
		
    ?>

</div> <!-- End of eshop-content div !-->