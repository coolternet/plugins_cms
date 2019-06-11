    <div id="evo-section-title">
        <div><i class="fas fa-cogs fa-sm"></i> Settings</div>    
    </div>
   
        <div class="ui equal width grid" style="margin-top:20px">
            <div class="column">
                <form method="POST">
                    <div class="ui form">
                        <h4 class="ui dividing header">Company Details<a class="anchor" id="content"></a></h4>
                    	<div class="field">
                    		<div class="fields">
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
                    	</div>
                      
                    	<div class="field">
                    		<div class="fields">
                    			<div class="eight wide field">
                    			    <label>Address</label>
                    				<input type="text" name="shop_address" value="<?= $settings['shop_address'] ?>">
                    			</div>
                    			<div class="eight wide field">
                    			    <label>City</label>
                    				<input type="text" name="shop_city" value="<?= $settings['shop_city'] ?>">
                    			</div>
                    		</div>
                    	</div>
                        <div class="field">
                        	<div class="fields">
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
                    	</div>
                    	<div class="field">
                        	<div class="fields">
                        		<div class="eight wide field">
                        			<label>Phone number</label>
                        			<input type="text" name="shop_phone" value="<?= $settings['shop_phone'] ?>"/>
                        		</div>
                        		<div class="eight wide field">
                        			<label>Email</label>
                        			<input type="text" name="shop_email" value="<?= $settings['shop_business_mail'] ?>"/>
                        		</div>
                        	</div>
                    	</div>
                	</div>
                	<button name="save_company" class="ui center alligned primary basic button">Update the company informations</button>
                </form>
                <h4 class="ui dividing header">Customers Settings<a class="anchor" id="content"></a></h4>
                <table class="ui red table">
                    <tbody>
                        <tr>
                            <td>Allow customers to change currency</td>
                            <td class="collapsing">
                                <div class="ui fitted slider checkbox">
                                    <input type="checkbox">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Migrate CMS users to the e-shop plugin </td>
                            <td class="collapsing">
                                <form method="POST"></form><button name="migrate_eshop" type="submit" class="ui green basic button">Migrate</button></form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="column">
                <form method="post">
                    <h4 class="ui dividing header">Globals Settings<a class="anchor" id="content"></a></h4>
                    <table class="ui blue table">
                        <tbody>
                            <tr>
                                <td class="seven wide field">Rates System based</td>
                                <td>
                                    <div class="ui form">
                                        <div class="field">
                                            <div class="ui actioninput">
                                                <label name="currency" class="eshop_select">
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
                                                <label name="currency" class="eshop_select">
                                                    <?= $settings['shop_currency_default'] ?>
                                                </label>
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
                                                <select name="currency" class="eshop_select">
                                                    <?php foreach($currency as $key) { echo "<option value='". $key['code'] ."'>". $key['code'] ."</option>"; } ?>
                                                </select>
                                                <button name="save_default_currency" class="ui blue basic button" type="submit" title="Update the default currency">Save</button>
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
                                                <button name="install_currency" class="ui purple basic button floated right" title="Update price and rates">Update Currency</button>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
                <h4 class="ui dividing header">Currency Rates<a class="anchor" id="content"></a></h4>
                <div id="rates-table">
                    <table class="ui table">
                        <tbody>
                            <?php foreach($currency as $key => $val){ echo "<tr><td style='text-align: right'> 1 ". $settings['shop_currency_default'] ." = </td><td>". $val['rate'] ." ". $val['code'] ."</td></tr>"; } ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    