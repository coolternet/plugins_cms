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
		
/////////////////////////////////// ADMIN > CONTENTS > TAXES

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
						//alert("OMG IT DIDNT WORK" + data.error);
						notifs('error', 'far fa-check-circle fa-3x', $name, data.error, false, 'top-right', 3000);
					}
				});
				return false;
			}
		}

	});



/////////////////////////////////// ADMIN > SETTING'S CURRENCY'S

	// Convertion tool
	$("input[name=amount_to_convert]").on("keyup", function(){
		var currency_value = $("select[name=currency_to_convert] option:selected").dropdown().val();
		var amount_to_convert = $(this).val();
		var current_currency = $("label[name=current_currency]").text();
		var converted = amount_to_convert / currency_value;
		$("h1[name=result_amount_converted]").html(financial(converted) + ' ' + current_currency);
	});
	
	// Change default currency
	$("button[name=update_default_currency]").on('click', function(){
		var $currency = $("select[name=currency] option:selected").dropdown().val();
		
		ajax_post({
			action: 'update_default_currency',
			shop_currency_default: $currency
		}, function(data){
			if (data.success) {
				$("label[name=current_currency]").html($currency);
				notifs('success', 'far fa-check-circle fa-3x', 'Changement de devise par défaut', 'La devise par défaut est maintenant <b>' + $currency + '</b>', false, 'top-right', 3000);
			} else {
				console.log('' + data.error);
			}
		});

		return false;
		
	});
	

/////////////////////////////////// ADMIN > CONTENTS > CATEGORIES

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
						alert('Une catégorie a été créé avec succès');
						$("input[name=new_category_name]").val('');
						$('table[name=cat_table]').append('<tr data-id="'+ data.id +'"><td>'+ data.id +'</td><td>'+ $name +'</td><td>0</td><td>0</td><td></td></tr>');
						notifs('green', 'far fa-check-circle fa-3x', "Congratulation !", 'The new category is create.', false, 'top-right', 2000);
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
			id: $id
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
	
	
	// Réaction du bouton avec le formulaire
	$("input[name=new_category_name]").on('keyup', function(){
		if($("input[name=new_category_name]").parent().hasClass('error')){
			$("button[name=create_cat]").find().addClass('disabled');
		}
		if(!$("input[name=new_category_name]").parent().hasClass('error')){
			$("button[name=create_cat]").find().removeClass('disabled');
		}
	});

	// Select Category for sub-categories
	$("select[name=subselect_category]").on('focus', function(){		
		ajax_get({
			action: 'get_category',
		}, function(data){
			
			if(data.success){
				var s = '<option value="-1">Please select a category</option>';
				for (var i = 0; i < data.length; i++){
					s += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
				}
				$("select[name=subselect_category]").html(s); 
			}else{
				console.log(data.error)
			}
			
		});
	});
	
	$("select[name=subselect_category]").change(function () {
		$('#msg').text('Selected Item: ' + this.options[this.selectedIndex].text);
	});
	
	// Create Sub-Category
	$("button[name=create_subcat]").on('click', function(){
		var $name = $("input[name=new_subcat_name]").val();
		var $subcatid = $("select[name=subselect_category]:selected").val();
		
		if($('#bloc_add_subcategory').form('validate form')) {
			ajax_post({
				action: 'create_subcategory',
				name: $name,
				category_id: $subcatid
			}, function(data){
				if (data.success){
					console.log(success);
				}else{
					console.log(data.error);
				}
			});
			$("input[name=new_category_name]").val('');
			$("select[name=subselect_category]:selected").val('');
			return false;
		}
	});
	


// ADMIN > CONTENTS > PRODUCTS

		// To Do > Search field

// ADMIN > CONTENTS > PREVIEW NEW PRODUCT

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
    
	
    $("a[name=addfund]").click(function(){
        $.ajax({
            url : '/core/function.php',
            type : 'GET',
            data : 'currency=' + base,
            dataType : 'json',
            success : function(success, statut){
                alert("Success");
            },
            error : function(resultat, statut, erreur){
                alert("Error");
            },
            complete : function(resultat, statut){
                alert("Completed");
            }
        });
        
    });
    
    /*$("a[name=custoprofil]").click(function(event){
        $('.ui.modal').modal('show');
        alert($(this).data("userid"));
        var userid = $(this).data("userid");
    });
	*/
	
	$('a[name=custoprofil]').on('click', function() {
		var $id = $(this).data('userid');
		$('.ui.longer.modal').modal('show');
		$('div.tab').attr("data-userid", $id);
		$('button[name=save_profil]').attr("data-userid", $id);
		
		// Request for Profil
		$.ajax({
			type: "GET",
			dataType: 'json',
			url: "index.php?p=eshop/ajax",
			data: {action: 'customer_profil', id: $id},
			success: function(output){
				$('input').empty();
				$('.customname').children().text(output.first_name + ' ' + output.last_name);
				$('input[name=user]').val($id);
				$('input[name=first_name]').val(output.first_name);
				$('input[name=last_name]').val(output.last_name);
				$('input[name=email]').val(output.email);
				$('input[name=address]').val(output.address);
				$('input[name=city]').val(output.city);
				$('input[name=apt]').val(output.apt);
				$('input[name=zip]').val(output.zip);
				$('input[name=country]').val(output.country);
				$('input[name=state]').val(output.state);
				$('input[name=phone]').val(output.phone);
            }
		});
		
		// Request for System Activity's
		$.ajax({
			type: "GET",
			dataType: 'json',
			url: "index.php?p=eshop/ajax",
			data: {action: 'system_activity', id: $id},
			success: function(output){
				var table = $('table[name=system_activity]');
				table.find("tbody tr").remove();
				$.each(output, function(index, value){
					if(value.id){
						var event = value.event;
						var timer = value.timestamp;
						table.append('<tr><td>' + value.id + '</td><td>' + timer + '</td><td>' + value.ip + '</td><td>' + before(event, "!") + '</td></tr>');
					}
				});
            }
		});
		
		// Request for E-Shop Activity's
		$.ajax({
			type: "GET",
			dataType: 'json',
			url: "index.php?p=eshop/ajax",
			data: {action: 'customer_activity', id: $id},
			success: function(output){
				var table = $('table[name=customer_activity]');
				table.find("tbody tr").remove();
				$.each(output, function(index, value){
					if(value.id){
						var event = value.event;
						table.append('<tr><td>' + value.id + '</td><td>' + value.date_created + '</td><td>' + value.ip + '</td><td>' + before(event, "!") + '</td></tr>');
					}
				});
            }
		});
	});
	
	$('button[name=save_profil]').click(function(){
		
		var customer_profil = {
			'user'			: $(this).data('userid'),
			'first_name'	: $('input[name=first_name]').val(),
			'last_name'		: $('input[name=last_name]').val(),
			'email'			: $('input[name=email]').val(),
			'phone'			: $('input[name=phone]').val(),
			'address'		: $('input[name=address]').val(),
			'city'			: $('input[name=city]').val(),
			'apt'			: $('input[name=apt]').val(),
			'zip'			: $('input[name=zip]').val(),
			'state'			: $('input[name=state]').val(),
			'country'		: $('input[name=country]').val(),
		}
		
		$.ajax({
			url			: 'index.php?p=eshop/ajax',
			type		: 'POST',
			dataType	: 'text',
			data		: {action: 'customer_save_profil', customer_profil},
			success		: function(data){
				console.log(customer_profil)
			}
		});
		
	});
    
    $("#checkAll").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    
    $('.ui.dropdown').dropdown();

    function print() {
      window.print();
    }
    
    /* INVOICES ACTION */
    
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
    

    $(".country.item").click(function(){
        var country = $(this).attr("data-value");
        $.ajax({
            url: 'http://dev.evolution-network.ca/plugins/eshop/pages_admin/assets/js/countries/' + country + '.json',
            dataType: 'json',
            type: 'get',
            cache: false,
            success: function(data){
                $('#states').empty();
                $(data.states).each(function(code, name) {
                    $("#states").append("<option value='"+ this.code +"'>"+ this.name +"</option>");
                });
            }
        });
    });

});