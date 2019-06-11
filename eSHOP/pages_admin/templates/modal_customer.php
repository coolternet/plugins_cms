<div class="ui grid">
	<div class="four wide column">
		<div class="ui vertical tabular pointing menu" style="min-height: 575px;">
			<a class="item active" data-tab="customer_profil"><i class="user circle left icon"></i> Profil</a>
			<a class="item" data-tab="customer_security"><i class="lock left icon"></i> Security</a>
			<a class="item" data-tab="customer_vault"><i class="usd left icon"></i> Vault</a>
			<a class="item" data-tab="customer_orders"><i class="shopping basket left icon"></i> Orders</a>
			<a class="item" data-tab="customer_note"><i class="sticky note outline left icon"></i> Note's</a>
			<a class="item" data-tab="customer_discount"><i class="tag left icon"></i> Discount's</a>
			<a class="item" data-tab="customer_activity"><i class="newspaper outline left icon"></i> Activity's</a>
		</div>
	</div>
	<div class="twelve wide stretched column">
		<div class="ui stretched active tab" data-tab="customer_profil">
			<div name="form-profil-editor" class="form-horizontal">
				<h4 class="ui dividing header">Profil Informations</h4>
				<div class="form-group">
					<label for="first_name" class="col-sm-4 control-label">First Name</label>
					<div class="col-sm-6">
						<input type="text" name="first_name" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label for="last_name" class="col-sm-4 control-label">Last Name</label>
					<div class="col-sm-6">
						<input type="text" name="last_name" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="col-sm-4 control-label">Email Address</label>
					<div class="col-sm-6">
						<input type="email" name="email" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label for="phone" class="col-sm-4 control-label">Phone Number</label>
					<div class="col-sm-6">
						<input type="tel" name="phone" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" class="ui fluid dropdown form-control" />
					</div>
				</div>
				
				<h4 class="ui dividing header">Billing Address</h4>
				<div class="form-group">
					<label for="address" class="col-sm-4 control-label">Address</label>
					<div class="col-sm-6">
						<input type="text" name="address" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label for="city" class="col-sm-4 control-label">City</label>
					<div class="col-sm-6">
						<input type="text" name="city" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label for="apt" class="col-sm-4 control-label">Apt #</label>
					<div class="col-sm-6">
						<input type="text" name="apt" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label for="zip" class="col-sm-4 control-label">Zip Code</label>
					<div class="col-sm-6">
						<input type="text" name="zip" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label for="state" class="col-sm-4 control-label">State</label>
					<div class="col-sm-6">
						<input type="text" name="state" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label for="country" class="col-sm-4 control-label">Country</label>
					<div class="col-sm-6">
						<input type="text" name="country" class="form-control">
					</div>
				</div>
			</div>
		</div>
		
		<div class="ui stretched tab" data-tab="customer_security">
			<h4 class="ui dividing header">Security System</h4>
			<div class="bs-callout-warning bs-callout" style="margin: 20px 20px 40px 20px;">The new password will be sent directly to the mailbox belonging to this customer account.</div>
			<div class="center">
				<button name="regenpassword" class="btn btn-small btn-success">Generate a new password</button>
			</div>
			
			<h4 class="ui dividing header">Account Settings</h4>
			<div class="ui grid">
				<div class="fourteen wide column">Banishment of the account</div>
				<div class="two wide column">
					<div class="ui form">
						<div class="inline field">
							<div class="ui toggle checkbox">
								<input type="checkbox" tabindex="0" class="hidden">
							</div>
						</div>
					</div>
				</div>
				<div class="fourteen wide column">Allow the profil edition</div>
				<div class="two wide column">
					<div class="ui form">
						<div class="inline field">
							<div class="ui toggle checkbox">
								<input type="checkbox" tabindex="0" class="hidden" checked>
							</div>
						</div>
					</div>
				</div>
				<div class="fourteen wide column">Allow the foreign currency</div>
				<div class="two wide column">
					<div class="ui form">
						<div class="inline field">
							<div class="ui toggle checkbox">
								<input type="checkbox" tabindex="0" class="hidden" checked>
							</div>
						</div>
					</div>
				</div>
				<div class="fourteen wide column">Allow the placing of order</div>
				<div class="two wide column">
					<div class="ui form">
						<div class="inline field">
							<div class="ui toggle checkbox">
								<input type="checkbox" tabindex="0" class="hidden" checked>
							</div>
						</div>
					</div>
				</div>
				<div class="fourteen wide column">Allow the safety deposit box</div>
				<div class="two wide column">
					<div class="ui form">
						<div class="inline field">
							<div class="ui toggle checkbox">
								<input type="checkbox" tabindex="0" class="hidden" checked>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="ui stretched tab" data-tab="customer_orders">
			<div class="bs-callout-warning bs-callout" style="margin: 20px 20px 40px 20px;">No order has been made by this customer.</div>
		</div>

		<div class="ui stretched tab" data-tab="customer_note">
			<div class="bs-callout-warning bs-callout" style="margin: 20px 20px 40px 20px;">No administrative note in this folder.</div>
		</div>

		<div class="ui stretched tab" data-tab="customer_discount">
			<div class="bs-callout-warning bs-callout" style="margin: 20px 20px 40px 20px;">No discount available for this client.</div>
		</div>

		<div class="ui stretched tab" data-tab="customer_activity">
            <h4 class="ui dividing header">eShop Event Log (5 last results)</h4>
            <table name="customer_activity" class="ui very basic table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>IP</th>
                        <th>Événement</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <br>
            <h4 class="ui dividing header">System Event Log (5 last results)</h4>
            <table name="system_activity" class="ui very basic table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>IP</th>
                        <th>Événement</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
		</div>
		
		<div class="ui stretched tab" data-tab="customer_vault">
			<div class="bs-callout-warning bs-callout" style="margin: 20px 20px 40px 20px;">No vault available for this client.</div>
			<div class="ui grid">
				<div class="eight wide column"><h3 class="ui right header">Amount Available</h3></div>
				<div class="eight wide column"><h3 class="ui left header">0.00 $ CAD</h3></div>
			</div>
		</div>
		
	</div>

</div>