                <div class="ui horizontal divider">Currency Rate Provider</div>
				<form method="post" class="ui container">
                    <table class="ui blue table">
                        <tbody>
                            <tr>
                                <td class="seven wide field">Rates System based</td>
                                <td>
                                    <div class="ui form">
                                        <div class="field">
                                            <div class="ui actioninput">
                                                <label name="currency_provider" class="eshop_select">
                                                    <?= $settings['provider_name'] ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="seven wide field">Current Currency</td>
                                <td>
                                    <div class="ui form">
                                        <div class="field">
                                            <div class="ui  input">
                                                <label name="current_currency" class="eshop_select"><?= $settings['shop_currency_default'] ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="seven wide field">Change Currency</td>
                                <td>
                                    <div class="ui form">
                                        <div class="field">
                                            <div class="ui action input">
                                                <select name="currency" class="eshop_select ui basic blue">
                                                    <?php foreach($currency as $key) { echo "<option value='". $key['code'] ."'>". $key['code'] ."</option>"; } ?>
                                                </select>
                                                <button name="update_default_currency" class="ui blue basic button" type="submit" title="Update the default currency">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="seven wide field">Last Update</td>
                                <td>
                                    <div class="ui form">
                                        <div class="field">
                                            <div class="ui action">
                                                <label name="currency" style="margin-top: 7px;"><?= $settings['shop_currency_last_update'] ?></label>
												<button name="install_currency" class="ui purple basic button floated right" title="Update price and rates">Update Currency</button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="seven wide field">Allow to change their foreign currency</td>
                                <td>
									<div class="ui toggle checkbox">
										<input type="checkbox" tabindex="0" class="hidden">
									</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
				
				<div class="ui horizontal divider">Currency's Tools</div>
				<div class="container stackable ui grid">
					<div class="eight wide column">
						<div id="currency-globalrates-table">
							<table class="ui table">
								<tbody>
									<?php foreach($currency as $key => $val){ echo "<tr><td style='text-align: right'> 1 ". $settings['shop_currency_default'] ." = </td><td>". $val['rate'] ." ". $val['code'] ."</td></tr>"; } ?>
								</tbody>
							</table>
						</div>
					</div>
					<div class="eight wide column">
						<div id="currency-toolrates-table" class="ui container segment">
							<div class="ui horizontal divider">Amount to convert</div>
							<div class="ui form">
								<div class="field">
									<div class="ui action input" style="width: 30%;position: relative;left: 23%;">
										<input name="amount_to_convert" class="eshop_select"/>
                                        <select name="currency_to_convert" class="eshop_select ui button basic pink"><?php foreach($currency as $key) { echo "<option value='". $key['rate'] ."'>". $key['code'] ."</option>"; } ?></select>
									</div>
								</div>
							</div>
							<div class="ui horizontal divider">Result</div>
							<div class="center">
								<h1 name="result_amount_converted" class="ui header" style="font-weight: 300;">0.00 <?= $settings['shop_currency_default'] ?></h1>
							</div>
						</div>
					</div>
				</div>
				
