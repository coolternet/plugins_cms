                <form class="ui form" method="POST">
					<div class="ui horizontal divider">Gouvernment Informations</div>
					<div class="three wide column fields ui segment container">
						<div class="field">
							<label>Company Name</label>
							<input type="text" name="shop_name" value="<?= $settings['shop_name'] ?>" placeholder="ex: General Market Enr.">
						</div>
						<div class="field">
							<label>VAT Number</label>
							<input type="text" name="shop_vat" value="<?= $settings['shop_vat'] ?>" placeholder="ex: 4855475-42-4248">
						</div>
						<div class="field">
							<label>Owner name</label>
							<input type="text" name="shop_owner" value="<?= $settings['shop_contractor'] ?>" placeholder="ex: Jean-Paul Lacroix">
						</div>
					</div>
			  
					<div class="ui horizontal divider">Location Informations</div>
					<div class="three wide column fields ui segment container">
						<div class="ten wide field">
							<label>Address</label>
							<input type="text" name="shop_address" value="<?= $settings['shop_address'] ?>">
						</div>
						<div class="six wide field">
							<label>City</label>
							<input type="text" name="shop_city" value="<?= $settings['shop_city'] ?>">
						</div>
						<div class="field">
							<label>State</label>
							<input type="text" name="shop_state" value="<?= $settings['shop_state'] ?>" />
						</div>
						<div class="field">
							<label>Country</label>
							<input type="text" name="shop_country" value="<?= $settings['shop_country'] ?>" />
						</div>
						<div class="field">
							<label>Zip Code</label>
							<input type="text" name="shop_zip" value="<?= $settings['shop_zip'] ?>">
						</div>
					</div>

					<div class="ui horizontal divider">Contact informations</div>
					<div class="three wide column fields ui segment container">
						<div class="eight wide field">
							<label>Phone number</label>
							<input type="text" name="shop_phone" value="<?= $settings['shop_phone'] ?>"/>
						</div>
						<div class="eight wide field">
							<label>Email</label>
							<input type="text" name="shop_email" value="<?= $settings['shop_business_mail'] ?>"/>
						</div>
					</div>
					<div class="center">
						<button name="save_company" class="ui gray button">Update the company informations</button>
					</div>
                </form>