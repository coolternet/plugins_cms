$(document).ready(function(){

    $('.tabular.menu .item').tab();
    $('.ui.checkbox').checkbox();
	$('.ui.accordion').accordion();
	$('.ui.sticky').sticky({context: '#newprodmenu'});
	
// ADMIN > CONTENTS > PRODUCTS	
	
	// Navbar SEARCH field
	$('input[name=search_prod]').on('keyup', function(){
		var value = $(this).val().toLowerCase();
		var result = $('div[name=result]');
		if(value.length >= 1)
		{
			$('div[name=title_prod]').html('<i class="fas fa-search fa-sm"></i> Search Result');
			result.addClass("active");
		}else{
			result.removeClass("active");
			$('div[name=title_prod]').html('<i class="fas fa-folder fa-sm"></i> Products');
		}
	});
	
	$("a.item").click(function() {
		var button = $(this).attr("data-tab");
		if(button == "newprod"){ 
			$('div[name=title_prod]').html('<i class="far fa-clipboard fa-fm"></i> New Product');
		}
		if(button == "prodlist"){ 
			$('div[name=title_prod]').html('<i class="fas fa-list fa-sm"></i> Products list');
		}
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
				output.slice (0,5).forEach(function(element){
					table.append('<tr><td>' + element.id + '</td><td>' + element.timestamp + '</td><td>' + element.ip + '</td><td>' + element.event.split('!')[0] + '</td></tr>');
				});
				//console.log(output);
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
				output.slice (0,5).forEach(function(element){
					table.append('<tr><td>' + element.id + '</td><td>' + element.date_created + '</td><td>' + element.ip + '</td><td>' + element.event.split('!')[0] + '</td></tr>');
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
/*
    $("#eshop-content").load("?p=eshop/dashboard");

    $('a[name=dash]').click(function(){
        var stateObj = { url: "main" };
        var url = $(this).attr('href');
        $('#eshop-content').load(url);
        history.pushState(stateObj, "page 2", "?p=eshop/main");
        return false;
    });
    
    $('a[name=customers]').click(function(){
        var url = $(this).attr('href');
        var stateObj = { url: "customers" };
        $('#eshop-content').load(url);
        history.pushState(stateObj, "page 2", "?p=eshop/customers");
        return false;
    });
    
    $('a[name=overview]').click(function(){
        var stateObj = { main: "overview" };
        var url = $(this).attr('href');
        $('#eshop-content').load(url);
        history.pushState(stateObj, "page 2", "?p=eshop/overview");
        return false;
    });
    
    $('a[name=paid]').click(function(){
        var stateObj = { main: "paid" };
        var url = $(this).attr('href');
        $('#eshop-content').load(url);
        history.pushState(stateObj, "page 2", "?p=eshop/invoices&state=1");
        return false;
    });
    
    
    $('a[name=unpaid]').click(function(){
        var stateObj = { main: "unpaid" };
        var url = $(this).attr('href');
        $('#eshop-content').load(url);
        history.pushState(stateObj, "page 2", "?p=eshop/invoices&state=0");
        return false;
    });
    
    
    $('a[name=canceled]').click(function(){
        var stateObj = { main: "canceled" };
        var url = $(this).attr('href');
        $('#eshop-content').load(url);
        history.pushState(stateObj, "page 2", "?p=eshop/invoices&state=2");
        return false;
    });
    
    
    $('a[name=refunded]').click(function(){
        var stateObj = { main: "refunded" };
        var url = $(this).attr('href');
        $('#eshop-content').load(url);
        history.pushState(stateObj, "page 2", "?p=eshop/invoices&state=3");
        return false;
    });
    
    $('a[name=patterns]').click(function(){
        var stateObj = { main: "patterns" };
        var url = $(this).attr('href');
        $('#eshop-content').load(url);
        history.pushState(stateObj, "page 2", "?p=eshop/patterns");
        return false;
    });
    
    
    $('a[name=products]').click(function(){
        var stateObj = { main: "products" };
        var url = $(this).attr('href');
        $('#eshop-content').load(url);
        history.pushState(stateObj, "page 2", "?p=eshop/products");
        return false;
    });
    
    $('a[name=categories]').click(function(){
        var stateObj = { main: "categories" };
        var url = $(this).attr('href');
        $('#eshop-content').load(url);
        history.pushState(stateObj, "page 2", "?p=eshop/categories");
        return false;
    });
    
    $('a[name=customer]').click('click', function(){
        var stateObj = { main: "paid" };
        var url = $(this).attr('href');
        history.pushState(stateObj, "page 2", "?p=eshop/customer&user");
        //$.get(url, customers&user, function(data){});

    });

*/

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