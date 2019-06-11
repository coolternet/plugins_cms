            <div id="evo-section-title">
                <div><i class="file alternate outline icon"></i> Invoice :: #<?= $_GET['id'] ?></div>    
            </div>
            
            <div class="row">
            
                <div id="invoice-preview-option" class="col s12 m3 l2 xl2">
                    <div class="state-change">
                        <div class="ui basic button" tabindex="0"><i class="icon user"></i>View Profil</div>
                        <div id="email_invoice" class="ui basic button" tabindex="0"><i class="icon envelope outline"></i> Send Mail</div>
                        <div class="ui basic button" tabindex="0"><a href="tel:<?= get_invoice($id)['phone'] ?>"><i class="icon phone"></i> Phone Call</a></div>
                        <h4 class="ui horizontal divider header">Action</h4>
                        <div class="ui form">
                            <div class="field">
                                <select class="inv_state">
                                    <option value="0">UnPaid</option>
                                    <option value="1">Paid</option>
                                    <option value="2">Canceled</option>
                                    <option value="3">Refunded</option>
                                </select>
                            </div>
                        </div>
                        <div class="ui red basic button" tabindex="0"><i class="icon trash"></i> Delete</div>
                    </div>
                </div>
                
                
                <div id="invoice-preview" class="col s12 m9 l10 xl10">
                    <div id="invoice_model" class="ui piled segment">
                        <?= $astate[$invoice['invstate']] ?>
                        <div id="inv_header">
                            <div class="ui left floated small images">
                                <?= '<img src="'.get_asset(Site('theme.logo') ?: '/img/logo.png'). '" alt="logo">'; ?>
                            </div>
                            <div class="ui right floated">
                                <h3 class="ui header text-right"><?= get_business_info()[1]['value'] ?>
                                    <div class="sub ui header">
                                        <div class="ui text-right"></div>
                                        <div class="ui text-right"><?= get_business_info()[3]['value'] ?></div>
                                        <div class="ui text-right"><?= get_business_info()[4]['value'] ?></div>
                                        <div class="ui text-right"><?= get_business_info()[5]['value'] ?></div>
                                        <div class="ui text-right">Canada (Québec)</div>
                                        <div class="ui text-right"><?= get_business_info()[8]['value'] ?></div>
                                    </div>
                                </h3>
                            </div>
                        </div>
                        
                        <div class="clearfix"></div>
                        <div id="inv_recipient">
                            <div class="ui right floated">
                                <h4 class="ui header right_aligned">INVOICE DATE
                                    <div class="sub ui right_aligned header">
                                        <div class="ui right_aligned"><?= $invoice['create_date'] ?></div>
                                    </div>
                                </h4>
                                <h4 class="ui header right aligned">LIMITE DATE
                                    <div class="sub ui right_aligned header">
                                        <div class="ui right_aligned"><?= $invoice['due_date'] ?></div>
                                    </div>
                                </h4>
                                <h4 class="ui header right_aligned">PAYMENT DATE
                                    <div class="sub ui right_aligned header">
                                        <div class="ui right_aligned"><?= $invoice['pay_date'] ?></div>
                                    </div>
                                </h4>
                            </div>
                            <div class="ui left floated">
                                <h4 class="ui header">RECIPIENT
                                    <div class="sub ui header">
                                        <div class="ui"><i class="user icon"></i> <?= $invoice['first_name'] .' '. $invoice['last_name'] ?></div>
                                        <div class="ui"><i class="map marker alternate icon"></i> <?= /*apt() .' '.*/ $invoice['address'] ?></div>
                                        <div class="ui"><i class="icon"></i> <?= $invoice['zip'] .' , '. $invoice['city'] ?></div>
                                        <div class="ui"><i class="icon"></i> <?= '('.$invoice['state'] .') '. $invoice['country'] ?></div>
                                        <div class="ui email"><i class="envelope outline icon"></i> <?= $invoice['email'] ?></div>
                                        <div class="ui phone"><i class="phone icon"></i> <?= $invoice['phone'] ?></div>
                                    </div>
                                </h4>
                            </div>
                        </div>
                        
                        <div class="clearfix"></div>
                        
                        <div class="ui center aligned basic segment">
                            <div class="ui horizontal divider">Invoice content</div>
                        </div>
                        
                        <div id="inv_contents">
                            <table class="ui very basic table">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Informations</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Web Hosting</td>
                                        <td>
                                            <div class="ui list">
                                                <div class="item">Name : Personnal</div>
                                                <div class="item">Host : coolternet.net</div>
                                                <div class="item"></div>
                                            </div>
                                        </td>
                                        <td class="qty">1</td>
                                        <td class="price">1.99</td>
                                    </tr>
                                    <tr>
                                        <td>Virtual Private Server</td>
                                        <td>
                                            <div class="ui list">
                                                <div class="item">Name : Dominator</div>
                                                <div class="item">Addon : Advanced Technical Support</div>
                                            </div>
                                        </td>
                                        <td class="qty">1</td>
                                        <td class="price">139.99</td>
                                    </tr>
                                    <tr>
                                        <td>Minecraft Server</td>
                                        <td>
                                            <div class="ui list">
                                                <div class="item">Name : Stone</div>
                                                <div class="item">Addon : Advanced Technical Support</div>
                                            </div>
                                        </td>
                                        <td class="qty">1</td>
                                        <td class="price">5.99</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="borderless"></td>
                                        <td class="borderless"></td>
                                        <td class="borderless right aligned">Sub-total</td>
                                        <td class="borderless subtotal">147.97 $</td>
                                    </tr>
                                    <tr class="taxe">
                                        <td class="borderless"></td>
                                        <td class="borderless"></td>
                                        <td class="borderless right aligned">TPS 5 %</td>
                                        <td class="borderless taxe">7.40 $</td>
                                    </tr>
                                    <tr class="taxe">
                                        <td class="borderless"></td>
                                        <td class="borderless"></td>
                                        <td class="borderless right aligned">TVQ 9.975 %</td>
                                        <td class="borderless taxe">14.76 $</td>
                                    </tr>
                                    <tr class="fees">
                                        <td class="borderless"></td>
                                        <td class="borderless"></td>
                                        <td class="borderless right aligned">Fees</td>
                                        <td class="borderless fees">0.00 $</td>
                                    </tr>
                                    <tr>
                                        <td class="borderless"></td>
                                        <td class="borderless"></td>
                                        <td class="borderless right aligned"><h3>Total</h3></td>
                                        <td class="borderless total"><h4>170.13 $</h4></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>                        
                </div>
            </div>

            <div id="email_invoice" class="ui modal form">
                <div class="header" style="background-color: #F9FAFB">SendMail composer</div>
                <div class="field" style="padding: 20px 20px 0px 20px">
                    <label>Destination : </label>
                    <input type="email" value="<?= $invoice['email'] ?>">
                </div>
                <div class="field" style="padding: 0px 20px 0px 20px">
                    <label>Subject : </label>
                    <input type="text" value="about what ?">
                </div>
                <div class="ui fitted divider"></div>
                <div class="content">
                    <div class="description">
                        <div class="ui grid">
                            <div class="thirteen wide column">
                                <div class="field">
                                    <label>What is you message ?</label>
                                    <textarea class="form-control" name="mail2customer" style="height:250px;"></textarea>
                                </div>
                                <div class="field">
                                    <div class="ui toggle checkbox">
                                        <input type="checkbox" checked name="copy" tabindex="0" class="hidden">
                                        <label>Send a copy in the inbox of the site.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="three wide column">
                                <h5 class="ui horizontal divider header">Model</h5>
                                <div class="ui link list">
                                    <a class="item">Empty</a>
                                    <a class="item">Recall Invoice</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="actions">
                    <div class="ui black deny button">Cancel</div>
                    <div class="ui positive right labeled icon button">Send it !<i class="checkmark icon"></i></div>
                </div>
            </div>
            
            <style>
                #inv_header, #inv_recipient {
                    margin: 10px 0px;
                }
                #inv_recipient {
                    margin: 30px 0px;
                }
                #inv_header div.sub div,#inv_recipient div.sub div  {
                    margin: 8px 0px;
                    font-size: 9pt;
                }
            </style>
            
            <script>
                $("#email_invoice").click(function(){
                    $('.ui.modal').modal('show');
                    var bbcodeFactory = <?= \Evo\ContentHandlers::getHandler('BBCode')->getEditor() ?>;
                    $('textarea').each(function() {
                    	new bbcodeFactory(this).display();
                    });
                });
            </script>