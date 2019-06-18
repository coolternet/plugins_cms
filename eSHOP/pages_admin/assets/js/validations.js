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