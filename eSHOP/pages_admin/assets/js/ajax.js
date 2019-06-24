$(document).ready(function(){
	
	var imported = document.createElement('script');
	imported.src = '/plugins/eshop/pages_admin/assets/js/validations.js';
	document.head.appendChild(imported);
	
    $('.tabular.menu .item').tab();
    $('.ui.checkbox').checkbox();
	$('.ui.accordion').accordion();
	$('.ui.rating').rating();
	$('.activating.element').popup();
	$('#multiple').dropdown();
	$('.ui.dropdown').dropdown();
	$(function(){ $("ul.checktree").checktree(); });

	(function($){
		$.fn.checktree = function(){
			$(':checkbox').on('click', function (event){
				event.stopPropagation();
				var clk_checkbox = $(this),
				chk_state = clk_checkbox.is(':checked'),
				parent_li = clk_checkbox.closest('li'),
				parent_uls = parent_li.parents('ul');
				parent_li.find(':checkbox').prop('checked', chk_state);
				parent_uls.each(function(){
					parent_ul = $(this);
					parent_state = (parent_ul.find(':checkbox').length == parent_ul.find(':checked').length); 
					parent_ul.siblings(':checkbox').prop('checked', parent_state);
				});
			 });
		};
	}(jQuery));
	
	
	function notifs(type, icon, header, message, sound, location) {
		var pop = $('div.poptart');
		if (pop.length == 0) {
			var pop = $('<div class="poptart ' + location + '" style="display:none"></div>').appendTo('body');
		}
		
		if (pop.html() != message) {
			var $cadre = '<div class="ui icon message ' + type + '"><i class="' + icon + '" style="margin-right: 15px;"></i><div class="content"><div class="header">' + header + '</div><p>' + message + '</p></div>';
			pop.fadeOut(500, function () { $('div.poptart').html($cadre).slideDown(500).delay(3000).fadeOut(3000).hide(0); });
			if (sound) {
				if ($('audio.poptart').length == 0) {
					$('<audio autoplay class="poptart" src="' + site_url + '/assets/audio/beep.mp3"></audio>').appendTo('body');
				} else {
					$('audio.poptart')[0].play();
				}
			}
		}
	}

	function before(string, delim) {
		return string.toString().split(delim)[0];
	}

	function ajax_call(type, data, callback) {
		data.csrf = csrf;
		$.ajax({
			type: type,
			dataType: 'json',
			url: "index.php?p=eshop/ajax",
			data: data,
			success: callback,
			error : function(data,status){
				callback({success: false, error: "Network error"});
			}
		});
	}

	function ajax_get(data, callback) {
		ajax_call("GET", data, callback);
	}

	function ajax_post(data, callback) {
		ajax_call("POST", data, callback);
	}
	
	function financial(x) {
		return Number.parseFloat(x).toFixed(2);
	}
		
	function reload_taxe_selector_after_action(){
		ajax_get({
			action: 'get_taxes',
		}, function(data){
			if (data.success) {
				$('select[name=tax]').find('option').remove();
				$.each(data, function() {
					var $this = $("select[name=tax]");
					if(this.code) {
						$($this).append('<option value="' + this.rate + '" data-id="' + this.id + '">' + this.code + '</option>');
					}
				});
			}
		});
	}
	
	$(document).ready(function(){
		ajax_get({
			action: 'get_taxes',
		}, function(data){
			if (data.success) {

				$.each(data, function() {
					var $this = $("select[name=tax]");
					
					if(this.code) {
						$($this).append('<option value="' + this.rate + '" data-id="' + this.id + '">' + this.code + '</option>');
					}
					
				});

			} else {
				notifs('error', 'fas fa-bug fa-3x', data.error, '', false, 'top-right');
			}
		});
		
		return false;
		
	});

/*
 *  ADMIN > Global's Setting
 */

	// Country and State dropdown
	$("select[name=country]").on('change', function(){
		var country = $("select[name=country] :selected").val();
		alert(country);
		$.get({
			url: 'http://dev.evolution-network.ca/plugins/eshop/pages_admin/assets/js/countries/' + country + '.json',
			cache: false,
			dataType: 'json',
            success: function(data){
				var state = $('select[name=shop_state]');
                state.empty();
                $(data.states).each(function(code, name) {
                    state.append("<option class='item' value='"+ this.code +"'>"+ this.name +"</option>");
                });
            }
		});
    });
	
	// Save changes button
	$("button[name=update_global_company]").on('click', function(){
		var $sname = $("input[name=shop_name]").val();
		var $svat = $("input[name=shop_vat]").val();
		var $sowner = $("input[name=shop_owner]").val();
		var $saddr = $("input[name=shop_address]").val();
		var $scity = $("input[name=shop_city]").val();
		var $sstate = $('select[name=shop_state]').val()
		var $country = $("select[name=country]").val();
		var $szip = $("input[name=shop_zip]").val();
		var $sphone = $("input[name=shop_phone]").val();
		var $semail = $("input[name=shop_email]").val();
		if($('#global_company_registration').form('validate form')) {
			ajax_post({
				action: 'save_company_global',
				shop_name: $sname,
				shop_contractor: $sowner,
				shop_address: $saddr,
				shop_city: $scity,
				shop_zip: $szip,
				shop_state: $sstate,
				shop_country: $country,
				shop_phone: $sphone,
				shop_business_mail: $semail,
				shop_vat: $svat
			}, function(data){
				if (data.success){
					notifs('success', 'far fa-check-circle fa-3x', 'Modification effectuée. !', 'Les informations de votre boutique ont été enregistrées.', false, 'top-right', 3000);
				}else{
					alert(data.error);
				}
			});
		}
		return false;
	});

/*
 *  ADMIN > Customer's Profil editor by Modal
 */

	// Retreive Customer's information for Modal Profil
	$('span[name=custoprofil]').on('click', function() {
		var $id = $(this).closest("tr").data('userid');
		$('.ui.longer.modal').modal('show');
		$("button[name=save_profil]").attr('data-userid', $id);
		ajax_get({
			action: 'get_customer_profil',
			uid: $id
		}, function(data){
			if(data.success){
				$('input').empty();
				$('.customname').children().text(data.first_name + ' ' + data.last_name);
				$('input[name=first_name]').val(data.first_name);
				$('input[name=last_name]').val(data.last_name);
				$('input[name=email]').val(data.email);
				$('input[name=address]').val(data.address);
				$('input[name=city]').val(data.city);
				$('input[name=apt]').val(data.apt);
				$('input[name=zip]').val(data.zip);
				$('select[name=country]').val(data.country);
				$('input[name=state]').val(data.state);
				$('input[name=phone]').val(data.phone);
				$('input[name=currency]').val(data.currency);
			}else{
				console.log(data.error);
			}
		});
	});

	// Save button Profil from Modal
	$('button[name=save_profil]').click(function(){
		var email = $('input[name=email]').val();
		ajax_post({
			action: 'save_customer_profil',
			uid			: $('button[name=save_profil]').data('userid'),
			first_name	: $('input[name=first_name]').val(),
			last_name	: $('input[name=last_name]').val(),
			address		: $('input[name=address]').val(),
			apt			: $('input[name=apt]').val(),
			city		: $('input[name=city]').val(),
			state		: $('input[name=state]').val(),
			zip			: $('input[name=zip]').val(),
			phone		: $('input[name=phone]').val(),
			country		: $('select[name=country]').val(),
			email		: $('input[name=email]').val(),
			currency	: $('input[name=currency]').val(),
		}, function(data){
			if(data.success){
				notifs('success', 'far fa-check-circle fa-3x', 'Modification du profil de : ' + email + 'Les changements ont été pris en compte.', false, 'top-right', 3000);
			}else{
				alert(data.error);
			}
		});
	});

	// Delete button from customers page
	$('span[name=custodel]').click(function(){
		var $id = $(this).closest("tr").data('userid');
		ajax_post({
			action: 'del_customer',
			uid			: $id,
		}, function(data){
			if(data.success){
				alert("Utilisateur supprimé avec succès.")
			}else{
				alert(data.error);
			}
		});
	});

	// New Password button
	$("button[name=regenpassword]").on('click', function(){
		var $id = $("button[name=save_profil]").data('userid');
		ajax_post({
			action: 'customer_regenpassword',
			id: $id
		}, function(data){
			if(data.success){
				console.log(data);
			}else{
				alert(data.error);
			}
		});
	});

	
/*
 *  ADMIN > Tax's Setting
 */

	// Tax Charge Calculator Tool
	$("input[name=ht_amount]").on("keyup", function(){
		
		var $this = Number($(this).val());
		var $tax2 = $("select[name=tax]").dropdown("get values");
		var arr = Array.from(Object.keys($tax2), k=>[$tax2[k]]);
		var sum = 0;
		
		$.each(arr, function(k, v) {
			var $cal = ($this * v / 100 );
			
			sum += +$cal;

			var $ttc = (sum + $this);
			
			$("h1[name=sumtax]").text(financial($ttc));
			
		});
		
	});

	// Tax Remover
	$("body").on('click', 'button[name=delete_tax]', function(){
		var $id = $(this).data('id');
		var row = $(this).closest("tr");
		ajax_post({
			action: 'remove_tax',
			id: $id
		}, function(data){
			if (data.success) {
				row.remove();
				reload_taxe_selector_after_action();
				notifs('success', 'far fa-check-circle fa-3x', 'Un taxe à la poubelle !', 'Enfin on va payer moins cher ! Merci <3', false, 'top-right', 3000);
			} else {
				alert(data.error);
			}
		});
	});

	// Tax Edition
	$("body").on('click', 'button[name=edit_tax]', function(){
		var $id = $(this).data('id');
		ajax_get({
			action: 'get_taxe',
			id: $id
		}, function(data){
			if (data.success){
				$("button[name=create_tax]").removeClass('green').addClass('purple').html('Save Changes').prop('name', 'save_tax').attr('data-id', $id);
				$("button[name=delete_tax]").prop("disabled", true);
				$("button[name=edit_tax]").prop("disabled", true);
				$("input[name=new_taxe_name]").val(data.name),
				$("input[name=new_taxe_abbrev]").val(data.code),
				$("input[name=new_taxe_value]").val(data.rate),
				$("input[name=new_taxe_number]").val(data.tnumber)
				reload_taxe_selector_after_action()
			}else{
				alert(data.error);
			}
		});
	});
	
	// Tax Save Changes or Create
	$("button#megabutton").on('click', function(){
		var $id = $(this).data('id');
		var $name = $("input[name=new_taxe_name]").val();
		var $code = $("input[name=new_taxe_abbrev]").val();
		var $rate = $("input[name=new_taxe_value]").val();
		var $tnum = $("input[name=new_taxe_number]").val();		

		if ($(this).prop('name') == "create_tax") {
			if($('#bloc_taxe_management').form('validate form')) {
				ajax_post({
					action: 'create_tax',
					name: $name,
					code: $code,
					rate: $rate,
					tnumber: $tnum
				}, function(data){
					if (data.success) {
						$("input[name=new_taxe_name]").val('');
						$("input[name=new_taxe_abbrev]").val('');
						$("input[name=new_taxe_value]").val('');
						$("input[name=new_taxe_number]").val('');
						$("table[name=tax_list]").append('<tr data-id="' + data.id + '"><td date-name="' + data.id + '">' + $name + '</td><td date-code="' + data.id + '">' + $code + '</td><td date-rate="' + data.id + '">' + $rate + '</td><td date-num="' + data.id + '">' + $tnum + '</td><td style="text-align: right"><button name="edit_tax" data-id="' + data.id + '" class="ui button blue basic tiny">Edit</button><button name="delete_tax" data-id="' + data.id + '" class="ui button red basic tiny">Delete</button></td></tr>');
						reload_taxe_selector_after_action()
						notifs('success', 'far fa-check-circle fa-3x', $name, 'Cette taxe a été créé et ajouté avec succès.', false, 'top-right', 3000);
					} else {
						alert(data.error);
					}
				});
				return false;
			}
		} 

		if ($(this).prop('name') == "save_tax") {
			if($('#bloc_taxe_management').form('validate form')) {
				ajax_post({
					action: 'save_tax',
					id: $id,
					name: $name,
					code: $code,
					rate: $rate,
					tnumber: $tnum
				}, function(data){
					if (data.success) {
						alert('Taxe enregistrée avec succès');
						$("button#megabutton").removeClass('purple').addClass('green').removeAttr('data-id').html('Create Tax').prop('name', 'create_tax');
						$("button[name=delete_tax]").prop("disabled", false);
						$("button[name=edit_tax]").prop("disabled", false);
						$("input[name=new_taxe_name]").val('');
						$("input[name=new_taxe_abbrev]").val('');
						$("input[name=new_taxe_value]").val('');
						$("input[name=new_taxe_number]").val('');
						$("tr[data-id='" + $id + "']").find("td[data-name='" + $id + "']").html($name);
						$("tr[data-id='" + $id + "']").find("td[data-code='" + $id + "']").html($code);
						$("tr[data-id='" + $id + "']").find("td[data-rate='" + $id + "']").html($rate);
						$("tr[data-id='" + $id + "']").find("td[data-num='" + $id + "']").html($tnum);
						//$("select[name=tax]").find("option[data-id='" + $id + "']").val($rate);
						reload_taxe_selector_after_action()
						notifs('success', 'far fa-check-circle fa-3x', $name, 'Les modifications de cette taxe ont bien été pris en compte.', false, 'top-right', 3000);
					} else {
						notifs('error', 'far fa-check-circle fa-3x', $name, data.error, false, 'top-right', 3000);
					}
				});
				return false;
			}
		}

	});

/*
 *
 *  ADMIN > SETTING'S CURRENCY'S
 * 
 */
	// Update Currency's rate on system and table
	$("button[name=update_currency]").on('click', function(){
		$(this).attr("disabled", true).addClass("loading");
		$("div#currency-globalrates-table tr").remove();
		ajax_post({
			action: 'update_currency_rate',		
		}, function(data) {
			if(data.success){
				notifs('success', 'far fa-check-circle fa-3x', 'Mise à jour du taux de change', 'Le taux de change est maintenant à jours.', false, 'top-right', 3000);
				ajax_get({
					action: 'get_rates',
				}, function(table){
					if(table.success){
						var $table = $("table[name=rates-table]");
						var $currency = $("label[name=current_currency]").text();
						$.each(table, function() {
							if(this.code){
								$table.append('<tr><td class="eight wide" style="text-align: right"> 1 ' + $currency + ' = </td><td class="eight wide">' + this.rate + ' ' + this.code + '</td></tr>');
							}
						});
					}else{
						console.log(table);
					}
				});
				$("button[name=update_currency]").attr("disabled", false).removeClass("loading");
			}else{
				$("button[name=update_currency]").attr("disabled", false).removeClass("loading");
				notifs('error', 'fas fa-bug fa-3x', "Une erreur est survenue !", "Le taux de change n'a pas pu être mis à jours. Veuillez attendre 24h avant de refaire une tentative.", false, 'top-right', 3000);
			}
		});
		return false;
	});

	// Convertion tool
	$("input[name=amount_to_convert]").on("keyup", function(){
		var currency_value = $("select[name=currency_to_convert] option:selected").dropdown().val();
		var amount_to_convert = $(this).val();
		var current_currency = $("label[name=current_currency]").text();
		var converted = amount_to_convert / currency_value;
		$("h1[name=result_amount_converted]").html(financial(converted) + ' ' + current_currency);
	});
	
	// Change default currency
	$("button[name=change_currency]").on('click', function(){
		var $currency = $("select[name=currency] option:selected").dropdown().val();
		ajax_post({
			action: 'change_default_currency',
			shop_currency_default: $currency
		}, function(data){
			if (data.success) {
				$("label[name=current_currency]").html($currency);
				notifs('success', 'far fa-check-circle fa-3x', 'Changement de devise par défaut', 'La devise par défaut est maintenant <b>' + $currency + '</b>', false, 'top-right', 3000);
			} else {
				console.log(data.error);
			}
		});
		return false;
	});
	
	
/*
 *
 *  ADMIN > CONTENTS > CATEGORIES & SUB-CATEFORIES
 * 
 */
	// Category Save Changes or Create
	$("button[name=create_category]").on('click', function(){
		var $id = $(this).data('id');
		var $name = $("input[name=new_category_name]").val();

		if ($(this).prop('name') == "create_category") {
			
			if( $('#bloc_category').form('validate form')) {
				ajax_post({
					action: 'create_category',
					name: $name
				}, function(data){
					if (data.success) {
						$("input[name=new_category_name]").val('');
						$('table[name=cat_table]').append('<tr data-id="'+ data.id +'"><td>'+ data.id +'</td><td>'+ $name +'</td><td>0</td><td>0</td><td style="text-align: right"><button data-id="'+ data.id +'" data-name="' + $name + '" name="category_edit" class="btn btn-primary btn-sm">Edit</button> <button data-id="'+ data.id +'" name="delete_category" class="btn btn-danger btn-sm">Delete</button></td></tr>');
						$('select[name=subselect_category]').append('<option data-id="' + data.id + '">' + $name + '</option>')
						notifs('positive', 'far fa-check-circle fa-3x', "Congratulation !", 'The new category is create.', false, 'top-right', 2000);
					} else {
						console.log(data.error);
					}
				});
				
				return false;
				
			}
		}

		if ($(this).prop('name') == "save_category") {
			
			if( $('#bloc_category').form('validate form')) {
				ajax_post({
					action: 'update_category',
					id: $id,
					name: $name,
				}, function(data){
					if (data.success) {
						alert('Les changements ont été enregistrés avec succès');
						$("button[name=save_category]").removeClass('purple').addClass('green').removeAttr('data-id').html('Create').prop('name', 'create_category');
						$("button[name=delete_category]").prop("disabled", false);
						$("button[name=edit_category]").prop("disabled", false);
						$("input[name=new_category_name]").val('');
						notifs('blue', 'far fa-hdd fa-3x', "Congratulation !", 'The category has been changed.', false, 'top-right', 2000);
					} else {
						console.log(data.error);
					}
				});
				
				return false;
				
			}
		}
	});
	
	// Category Edition
	$("body").on('click', 'button[name=category_edit]', function(){
		var $id = $(this).data('id');
		ajax_get({
			action: 'get_category',
			id: $id,
		}, function(data){
			if (data.success){
				$("button[name=create_category]").removeClass('green').addClass('purple').html('Save Changes').prop('name', 'save_category').attr('data-id', $id);
				$("button[name=delete_category]").prop("disabled", true);
				$("button[name=edit_category]").prop("disabled", true);
				$("input[name=new_category_name]").val(data.name)
			}else{
				console.log(data.error);
			}
		});
	});
	
	// Category Remover
	$("body").on('click', 'button[name=delete_category]', function(){
		var $id = $(this).data('id');
		var row = $(this).closest("tr");
		ajax_post({
			action: 'delete_category',
			id: $id
		}, function(data){
			if (data.success) {
				row.remove();
				alert("La Categorie a été supprimée avec succès");
			} else {
				console.log(data.error);
			}
		});
	});

	// Select Category for sub-categories
	$("input[name=new_subcat_name]").on('change', function(){
		var $select = $("select[name=subselect_category]");
		$(this).empty();
		$select.empty();
		ajax_get({
			action: 'get_categories',
		}, function(data){
			if(data.success){
				$.each(data, function(){
					console.log(data);
					if(this.id){
						$select.append('<option value="' + this.id + '">' + this.name + '</option>');
					}
				})
			}else{
				console.log(data.error)
			}
		});
	});
	
	// Create Sub-Category
	$("button[name=create_subcat]").on('click', function(){
		var $name = $("input[name=new_subcat_name]").val();
		var $cid = $("select[name=subselect_category] :selected").val();
		var $table = $("table[name=subcat_table]").attr("data-cid", $cid);
		if($('#bloc_add_subcategory').form('validate form')) {
			ajax_post({
				action: 'create_subcategory',
				name: $name,
				cid: $cid
			}, function(data){
				if (data.success){
					notifs('positive', 'far fa-hdd fa-3x', "Création d'une sous-catégorie", 'The sub-category named '+ $name +' has just created.', false, 'top-right', 2000);
					$table.append("<tr data-cid='"+ data.id +"'><td>"+ data.id +"</td><td>"+ $name +"</td><td>0</td><td>button</td></tr>");
				}else{
					console.log(data.error);
				}
			});
			$("input[name=new_category_name]").val('');
			$("select[name=subselect_category]:selected").val('');
			return false;
		}
	});


/*
 *
 *  ADMIN > CONTENTS > ADD NEW PRODUCTS
 * 
 */

		// To Do


/*
 *
 *  ADMIN > CONTENTS > PREVIEW'S PRODUCT CREATOR
 * 
 */
	var mainpic_preview = $("input[name=asmain]").val();
	var shipping = $("select[name=newprodshipping]").val();
	
	$("input[name=newprodname]").on('keyup', function(){
		var newprodname = $("input[name=newprodname]").val();
		$("div[name=preview_name]").children().html(newprodname);
		//console.log(newprodname);
	});
	
	$("input[name=newprodprice]").on('keyup', function(){
		var new_prod_price = $(this).val();
		$("h1[name=preview_price]").html(new_prod_price);
	});

    $("#checkAll").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    
    $('.ui.dropdown').dropdown();

    function print() {
      window.print();
    }
    
    // INVOICES ACTION 
    
    $("select.inv_state").change(function(){
    
        var inv_state_txt = $(this).children("option:selected").text();
        var inv_state_val = $(this).children("option:selected").val();
        
        if($("select.inv_state").val() == '0'){
            // Unpaid state
            $("div#state_bg").removeClass("red orange green violet").addClass("orange");
            $("div#state_bg").empty().append(inv_state_txt);
        } else if($("select.inv_state").val() == '1'){
            // Paid state
            $("div#state_bg").removeClass("red orange green violet").addClass("green");
            $("div#state_bg").empty().append(inv_state_txt);
        }else if($("select.inv_state").val() == '2'){
            // Canceled state
            $("div#state_bg").removeClass("red orange green violet").addClass("red");
            $("div#state_bg").empty().append(inv_state_txt);
        }else if($("select.inv_state").val() == '3'){
            // Refunded state
            $("div#state_bg").removeClass("red orange green violet").addClass("violet");
            $("div#state_bg").empty().append(inv_state_txt);
        }
    });

});

$('a.active[data-tab="add_sub_category"]').on('click', function(){
	console.log("category");
});