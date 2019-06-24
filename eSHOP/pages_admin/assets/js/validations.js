$('#bloc_add_subcategory').form({
    on: 'blur',
    fields: {
		SubCatName: {
			identifier : 'new_subcat_name',
			rules: [{
				type   : 'empty',
				prompt : 'Please enter a sub-category name'
			}]
		},
		
		SelectorCat: {
			identifier : 'subselect_category',
			rules: [{
				type   : 'empty',
				prompt : 'You need to select a category'
          }]
		},
    }
});

$('#global_company_registration').form({
    on: 'blur',
    fields: {
		ShopName: {
			identifier : 'shop_name',
			rules: [{
				type   : 'empty',
				prompt : 'Shop Name is not valid'
			}]
		},
		
		ShopVAT: {
			identifier : 'shop_vat',
			rules: [{
				type   : 'empty',
				prompt : 'VAT Number is not valid'
          }]
		},
		
		ShopOwner: {
			identifier : 'shop_owner',
			rules: [{
				type   : 'empty',
				prompt : 'Owner Name is not valid'
          }]
		},
		ShopAddr: {
			identifier : 'shop_address',
			rules: [{
				type   : 'empty',
				prompt : 'Address is not valid'
          }]
		},
		ShopState: {
			identifier : 'shop_state',
			rules: [{
				type   : 'empty',
				prompt : 'State is not valid'
          }]
		},
		ShopCountry: {
			identifier : 'shop_country',
			rules: [{
				type   : 'empty',
				prompt : 'Country is not valid'
          }]
		},
		ShopCountry: {
			identifier : 'shop_zip',
			rules: [{
				type   : 'empty',
				prompt : 'Zip Code is not valid'
          }]
		},
		ShopCountry: {
			identifier : 'shop_phone',
			rules: [{
				type   : 'number',
				prompt : 'Phone is not valid.  Format : 000000000000'
          }]
		},
		ShopCountry: {
			identifier : 'shop_email',
			rules: [{
				type   : 'email',
				prompt : 'Email is not valid'
          }]
		}
    }
});

$('#bloc_category').form({
    on: 'blur',
    fields: {
		SubCatName: {
			identifier : 'new_category_name',
			rules: [{
				type   : 'empty',
				prompt : 'Please enter a category name'
			}]
		},
    }
});

$('#bloc_add_company').form({
    on: 'blur',
    fields: {
		CompanyName: {
			identifier : 'company_name',
			rules: [{
				type   : 'empty',
				prompt : "Please enter a company's name"
			}]
		},
		CompanyTagName: {
			identifier : 'tag_sub_catname',
			rules: [{
				type   : 'empty',
				prompt : 'Please choose a sub-category tag name'
			}]
		},
    }
});

$('#bloc_taxe_management').form({
    on: 'blur',
    fields: {
		TaxName: {
			identifier : 'new_taxe_name',
			rules: [{
				type   : 'empty',
				prompt : "Please enter a valid tax's name"
			}]
		},
		TaxAbbr: {
			identifier : 'new_taxe_abbrev',
			rules: [{
				type   : 'empty',
				prompt : 'The abbreviation will be shown on the invoices'
			}]
		},
		TaxRate: {
			identifier : 'new_taxe_value',
			rules: [
				{
					type   	: 'decimal',
					prompt 	: '{name} must be a decimal number'
				}
			]
		},
		TaxGovNum: {
			identifier : 'new_taxe_number',
			rules: [{
				type   : 'empty',
				prompt : "Make sure your tax's number is valid with your government"
			}]
		},
    }
});