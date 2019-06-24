    <div id="evo-section-title">
        <div name="title_prod"><i class="fas fa-list fa-sm"></i> Products</div>    
    </div>

	<div class="ui top tabular menu">
		<a class="item active" data-tab="prodlist"><i class="list alternate outline icon"></i> Products list</a>
		<a class="item" data-tab="newprod"><i class="plus icon"></i> Create a new product</a>
		<div class="right menu">
			<div class="item">
				<div class="ui transparent icon input">
					<input type="text" name="search_prod" placeholder="Search...">
				</div>
			</div>
		</div>
	</div>

	<div class="ui bottom active tab" data-tab="prodlist">

		<table name="product_list" class="ui striped table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Product Name</th>
					<th>Company</th>
					<th>Category</th>
					<th>Sub-Category</th>
					<th>Qty</th>
					<th>Price</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>0</td>
					<td>Geforce GTX 1080-Ti FTW3 GAMING</td>
					<td>eVGA</td>
					<td>Informatique</td>
					<td>Carte Graphique</td>
					<td>0</td>
					<td>1799.99</td>
					<td>EDIT - DELETE</td>
				</tr>
			</tbody>
		</table>

	</div>
	
	<div class="ui bottom tab" data-tab="newprod">

		<div class="ui stackable grid" style="background-color: white;border: 1px #d4d4d5 solid;border-top: none;">
			<div class="four wide column">
				<div id="newprodstep" class="ui vertical pointing tabular menu">
					<a class="item active" data-tab="newprod_step1"><i class="far right fa-images"></i> Pictures</a>
					<a class="item" data-tab="newprod_step2"><i class="fas right fa-cog"></i> Base settings</a>
					<a class="item" data-tab="newprod_step3"><i class="far right fa-file-alt"></i> Description</a>
					<a class="item" data-tab="newprod_step4"><i class="far right fa-check-square"></i> Options</a>
					<a class="item" data-tab="newprod_step5"><i class="fas right fa-hand-holding-usd"></i> Fees</a>
					<a class="item" data-tab="newprod_step6"><i class="far right fa-thumbs-up"></i> Availabilitys</a>
					<a class="item" data-tab="newprod_step7"><i class="fas right fa-truck"></i> Carrier</a>
					<a class="item" data-tab="newprod_step8"><i class="fas right fa-balance-scale"></i> Weight and Size</a>
					<a class="item" data-tab="newprod_step9"><i class="far right fa-check-circle"></i> Final action</a>
					<a class="item" data-tab="newprod_preview"><i class="far right fa-eye"></i> Preview</a>
				</div>
			</div>
			<div class="twelve wide column">
				<div class="ui active tab" data-tab="newprod_step1">
					</br>
					<div class="ui column grid">
						<div class="column">
							<div class="ui segment">
								<a class="ui red ribbon label">Upload picture</a>
								<p>
									<div class="ui fluid action input">
									  <input type="file" placeholder="file" id="file">
									  <button class="ui basic green button">Upload</button>
									</div>
								</p>
								<a class="ui blue ribbon label">Preview</a>
								<div class="ui divided items">
									<div class="item">
										<div class="ui tiny image">
											<img src="https://semantic-ui.com/images/wireframe/image.png">
										</div>
										<div class="middle aligned content">
											<div class="ui radio checkbox">
												<input type="radio" name="asmain" tabindex="0" value="https://semantic-ui.com/images/wireframe/image.png">
												<label for="asmain">Set as main</label>
											</div>
										</div>
										<div class="right">
											<button class="ui basic mini red button" style="margin-top: 20px;">Delete</button>
										</div>
									</div>
									<div class="item">
										<div class="ui tiny image">
											<img src="https://images-na.ssl-images-amazon.com/images/I/81n-1MM5i-L._SL1500_.jpg">
										</div>
										<div class="middle aligned content">
											<div class="ui radio checkbox">
												<input type="radio" name="asmain" tabindex="0" value="https://images-na.ssl-images-amazon.com/images/I/81n-1MM5i-L._SL1500_.jpg">
												<label for="asmain">Set as main</label>
											</div>
										</div>
										<div class="right">
											<button class="ui basic mini red button" style="margin-top: 20px;">Delete</button>
										</div>
									</div>
									<div class="item">
										<div class="ui tiny image">
											<img src="https://images-na.ssl-images-amazon.com/images/I/61vZGmaIdRL._SL1500_.jpg">
										</div>
										<div class="middle aligned content">
											<div class="ui radio checkbox">
												<input type="radio" name="asmain" tabindex="0" value="https://images-na.ssl-images-amazon.com/images/I/61vZGmaIdRL._SL1500_.jpg">
												<label for="asmain">Set as main</label>
											</div>
										</div>
										<div class="right">
											<button class="ui basic mini red button" style="margin-top: 20px;">Delete</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="ui tab" data-tab="newprod_step2">
					<h2 class="ui header dividing" style="margin: 10px 10px 30px 10px">Paramètres de base</h2>
					
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-4 control-label">Category</label>
							<div class="col-sm-5">
								<select name="newprodcat" class="form-control" placeholder="Choose">
									<option value="informatique">Informatique</option>
									<option value="jeux_video">Jeux Vidéo</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Sub-Category</label>
							<div class="col-sm-5">
								<select name="newprodsub" class="form-control" placeholder="Choose">
									<option value="carte_graphique">Carte Graphique</option>
									<option value="processeur">Processeur</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Product Name</label>
							<div class="col-sm-5">
								<input name="newprodname" type="text" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Company</label>
							<div class="col-sm-5">
								<select name="newprodcompany" class="form-control" placeholder="Choose">
									<option>eVGA</option>
									<option>Nvidia</option>
									<option>Intel</option>
									<option>AMD</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Associated Product</label>
							<div class="col-sm-5">
								<input name="newprodassociated" type="text" class="form-control" placeholder="Which product ?">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Short Description</label>
							<div class="col-sm-5">
								<textarea name="newshortdesc" class="form-control" rows="3">Talk us about your product</textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Product barcode</label>
							<div class="col-sm-5">
								<input name="newbarcode" class="form-control" type="text">
							</div>
						</div>
					</div>
					
				</div>
				<div class="ui tab" data-tab="newprod_step3">
					<h2 class="ui header dividing" style="margin: 10px 10px 30px 10px">Spécifications</h2>
					<div class="bs-callout bs-callout-danger">
						<h3>Pattern manquant</h3>
						<p>Vous devez créer un pattern pour cette sous-catégorie. <a href="?p=eshop/patterns">Cliquez içi pour le faire dès maintenant</a>.</p>
						<p>Vous pouvez néant-moins continuer la création de vos produits et procéder à la création du pattern plus tard.</p>
					</div>
				</div>
				<div class="ui tab" data-tab="newprod_step4">
					<h2 class="ui header dividing" style="margin: 10px 10px 30px 10px">Options</h2>
					<div class="bs-callout bs-callout-danger">
						<h3>Non disponible</h3>
						<p>Cette section n'est pas disponible pour le moment</p>
					</div>
				</div>
				<div class="ui tab" data-tab="newprod_step5">
					<h2 class="ui header dividing" style="margin: 10px 10px 30px 10px">Les coûts</h2>
					
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-4 control-label">Prix de vente</label>
							<div class="col-sm-3">
								<input name="newprodprice" type="number" class="form-control" placeholder="Amount" step="any">
							</div>
							<div class="col-sm-2 control-label"><span class="left">$ CAD</span></div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Prix du cost</label>
							<div class="col-sm-3">
								<input name="newprodcost" type="number" class="form-control" placeholder="Amount" step="any">
							</div>
							<div class="col-sm-2 control-label"><span class="left">$ CAD</span></div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Frais de livraison</label>
							<div class="col-sm-5">
								<select class="form-control" name="newprodshipping">
									<option value="1">Oui</option>
									<option value="0">Non</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Taxes applicable</label>
							<div class="col-sm-5">
								<select multiple class="form-control" name="newprodtaxes">
									<option value="1">TPS</option>
									<option value="2">TVQ</option>
								</select>
							</div>
						</div>
					</div>
					
				</div>
				<div class="ui tab" data-tab="newprod_step6">

					<h2 class="ui header dividing" style="margin: 10px 10px 30px 10px">Disponibilités</h2>
					
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-4 control-label">Quantité disponible</label>
							<div class="col-sm-5">
								<input name="newprodqtyavailable" type="number" class="form-control" placeholder="Amount" min="0">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Quantité trop base</label>
							<div class="col-sm-5">
								<input name="newprodqtyavailablelow" type="number" class="form-control" placeholder="Amount" min="0">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Limitation par client</label>
							<div class="col-sm-5">
								<input name="newprodqtylimitcustomer" type="number" class="form-control" placeholder="0" min="0">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Disponible à partir de </label>
							<div class="col-sm-5">
								<input class="form-control" name="newprodtaxes" type="date">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4">
								<input name="newprodqtynotiflow" type="checkbox" class="form-check-input right">
							</div>
							<label class="col-sm-5 form-check-label">M'avertir par courriel lorsque la quantité arrive trop base</label>
						</div>
						<div class="form-group">
							<div class="col-sm-4">
								<input name="newprodqtyoos" type="checkbox" class="form-check-input right">
							</div>
							<label class="col-sm-5 form-check-label">Afficher "En rupture de stock" lorsque la quantité est trop base</label>
						</div>
					</div>
					
				</div>
				<div class="ui tab" data-tab="newprod_step7">
					<h2 class="ui header dividing" style="margin: 10px 10px 30px 10px">Carrier</h2>
				</div>
				<div class="ui tab" data-tab="newprod_step8">
					<h2 class="ui header dividing" style="margin: 10px 10px 30px 10px">Poids et grandeur du package</h2>
					
					<div class="form-horizontal grid middle alligned">
						<div class="form-group">
							<label class="col-sm-4 control-label">Largeur</label>
							<div class="input-group col-sm-3" style="padding-left: 15px;">
								<input name="newprodwidth" type="number" class="form-control" placeholder="0" step="any" min="0">
								<span class="input-group-addon">inch</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">hauteur</label>
							<div class="input-group col-sm-3" style="padding-left: 15px;">
								<input name="newprodheigh" type="number" class="form-control" placeholder="0" step="any" min="0">
								<span class="input-group-addon">inch</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Profondeur</label>
							<div class="input-group col-sm-3" style="padding-left: 15px;">
								<input name="newproddepth" type="number" class="form-control" placeholder="0" step="any" min="0">
								<span class="input-group-addon">inch</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label">Poids</label>
							<div class="input-group col-sm-3" style="padding-left: 15px;">
								<input name="newprodweight" type="number" class="form-control" placeholder="0" step="any" min="0">
								<span class="input-group-addon">Lbs</span>
							</div>
						</div>
					</div>
					
				</div>
				<div class="ui tab" data-tab="newprod_step9">
					<h2 class="ui header dividing" style="margin: 10px 10px 30px 10px">Previewing</h2>
				</div>
				<div class="ui tab" data-tab="newprod_preview">
					<?php include 'blocs/new_prod_preview.php' ?>
				</div>
			</div>
		</div>
	</div>

	<div name="result" class="ui bottom tab" data-tab="search">
		<table class="ui striped table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Product Name</th>
					<th>Company</th>
					<th>Category</th>
					<th>Sub-Category</th>
					<th>Qty</th>
					<th>Price</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>