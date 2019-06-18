	<form id="customer_contact_form" class="ui form" method="POST">
		<h4 class="ui dividing header">Profil Informations</h4>
		<div class="field">
			<div class="three fields">
				<div class="field">
					<label>First Name</label>
					<input type="text" id="first_name" name="first_name" placeholder="First Name" value="">
				</div>
				<div class="field">
					<label>Last Name</label>
					<input type="text" id="last_name" name="last_name" placeholder="Last Name" value="">
				</div>
				<div class="field">
					<label>Email</label>
					<input type="text" id="email" name="email" placeholder="Email" value="">
				</div>
			</div>
		</div>

		<h4 class="ui dividing header">Billing Address</h4>
		<div class="field">
			<div class="three fields">
				<div class="eight wide field">
					<label>Address</label>
					<input type="text" id="address" placeholder="Street Address" name="address" value="">
				</div>
				<div class="four  wide field">
					<label>City</label>
					<input type="text" id="city" placeholder="city" name="city" value="">
				</div>
				<div class="two wide field">
					<label>Apt</label>
					<input type="text" id="apt" placeholder="Apt #" name="apt" value="">
				</div>
				<div class="three wide field">
					<label>Zip Code</label>
					<input type="text" id="zip" placeholder="Zip Code" name="zip" value="">
				</div>
			</div>
		</div>

		<div class="three fields">
			<div class="field">
				<label>State</label>
				<select id="states" name="state" class="ui fluid dropdown"></select>
			</div>

			<div class="field">
				<label>Country</label>
				<div class="ui fluid search selection dropdown">
					<input type="hidden" name="country" id="country">
					<i class="dropdown icon"></i>
					<div class="default text">Select Country</div>
					<div class="menu">
						<?php foreach(COUNTRIES as $key => $val) { echo '<div class="country item" data-value="'. $key .'"><i class="'. strtolower($key) .' flag"></i>'. $val .'</div>'; } ?>
					</div>
				</div>
			</div>
			
			<div class="field">
				<label>Phone Number</label>
				<input id="phonenumber" name="phone" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" placeholder="Telephone Number" type="tel" class="ui fluid dropdown" />
			</div>
		</div>
		<input type="hidden" name="user" />
		<button class="ui primary green button" name="save_customer" type="submit">Save Change</button>
	</form>