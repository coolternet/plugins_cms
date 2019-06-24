                <form id="global_company_registration" class="ui form" method="POST">
					<div class="ui horizontal divider">Gouvernment Informations</div>
					<div class="fields ui segment container">
						<div class="six wide column field">
							<label>Company Name</label>
							<input type="text" name="shop_name" value="<?= $settings['shop_name'] ?>" placeholder="ex: General Market Enr.">
						</div>
						<div class="six wide column field">
							<label>VAT Number</label>
							<input type="text" name="shop_vat" value="<?= $settings['shop_vat'] ?>" placeholder="ex: 4855475-42-4248">
						</div>
						<div class="six wide column field">
							<label>Owner name</label>
							<input type="text" name="shop_owner" value="<?= $settings['shop_contractor'] ?>" placeholder="ex: Jean-Paul Lacroix">
						</div>
					</div>
			  
					<div class="ui horizontal divider">Location Informations</div>
					<div class="ui segment container">
						<div class="fields">
							<div class="ten wide column field">
								<label>Address</label>
								<input type="text" name="shop_address" value="<?= $settings['shop_address'] ?>">
							</div>
							<div class="six wide column field">
								<label>City</label>
								<input type="text" name="shop_city" value="<?= $settings['shop_city'] ?>">
							</div>
						</div>
						<div class="fields">
							<div class="six wide column field state">
								<label>State</label>
								<select name="shop_state" class="ui search dropdown" />
									<option><?= $settings['shop_state'] ?></option>
								</select>
							</div>
							<div class="six wide column field">
								<label>Country</label>
								<?= html_select('country', COUNTRIES, $settings['shop_country']); ?>
							</div>
							<div class="six wide column field">
								<label>Zip Code</label>
								<input type="text" name="shop_zip" value="<?= $settings['shop_zip'] ?>">
							</div>
						</div>
					</div>

					<div class="ui horizontal divider">Contact informations</div>
					<div class="three wide column fields ui segment container">
						<div class="eight wide field">
							<label>Phone number</label>
							<input type="number" step="1" name="shop_phone" value="<?= $settings['shop_phone'] ?>"/>
						</div>
						<div class="eight wide field">
							<label>Email</label>
							<input type="email" name="shop_email" value="<?= $settings['shop_business_mail'] ?>"/>
						</div>
					</div>
					<div class="center">
						<button name="update_global_company" class="ui gray button">Update the company informations</button>
					</div>
                </form>