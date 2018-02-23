class CustomerPreview
{
	constructor()
	{
		this.form_feedback = document.querySelectorAll('div.form-feedback')[0];
		this.name_input = $('input#name')[0];
		this.customer_id_input = $('input#customer_id')[0];
		this.company_input = $('input#company')[0];
		this.email_input = $('input#email')[0];
		this.address_input = $('input#address')[0];
		this.phone_number_input = $('input#phone')[0];
	}
	attachEvents()
	{
		let name_input = document.querySelectorAll('input#name')[0];
		name_input.addEventListener('input', this.__preview.bind(this));
	}
	__preview()
	{
		let input = event.target.value || ' ';
		let url = '/customer/preview';
		let ajax = new AjaxRequest();
		ajax.setup('POST', url, this.__previewAjaxHandler.bind(this));

		ajax.send(input);
	}
	__previewAjaxHandler(resp)
	{
		let form_feedback = document.querySelectorAll('div.form-feedback')[0];
			resp = JSON.parse(resp);

			this.form_feedback.innerHTML = '';
			resp.forEach(function(r){
				console.log(r);
				let btn = document.createElement('button');
				btn.addEventListener('click', this.__populateFields.bind(this, btn));

				btn.classList.add('btn', 'btn-sm', 'btn-outline-info');
				this.form_feedback.appendChild(btn);

				let btn_text = `<ul>
									<li class="id">${r.id}</li>
									<li class="name">${r.name}</li>
									<li class="company">${r.company}</li>
									<li class="email">${r.email}</li>
									<li class="address">${r.address}</li>
									<li class="phone_number">${r.phone_number}</li>
								</ul>`;
				btn.innerHTML = btn_text;
			}.bind(this));
	}
	__populateFields(btn)
	{
		let form_feedback = $('div.form-feedback')[0];
		let ul = btn.childNodes[0];

		let id = ul.querySelectorAll('li.id')[0].innerHTML;
		let name = ul.querySelectorAll('li.name')[0].innerHTML;
		let company = ul.querySelectorAll('li.company')[0].innerHTML;
		let email = ul.querySelectorAll('li.email')[0].innerHTML;
		let address = ul.querySelectorAll('li.address')[0].innerHTML;
		// let phone_number = ul.querySelectorAll('li.phone_number')[0].innerHTML;

		form_feedback.innerHTML = '';

		this.name_input.value = name;
		this.customer_id_input.value = id;
		this.company_input.value = company;
		this.email_input.value = email;
		this.address_input.value = address;
		// this.phone_number_input.value = phone_number;
	}
}
class VendorSearch {
	constructor()
	{
		this.search_input = $('input#search-vendors')[0];
		this.vendor_list = $('div#vendor-list')[0];
		this.original_content = this.vendor_list.innerHTML;
		this.clear_search_button = $('.input-group-append span.clear-search-field')[0];

		this.__init();
		console.log(this.search_input);
	}
	__addEvents()
	{
		this.search_input.addEventListener('input', this.__searchVendors.bind(this));
		this.clear_search_button.addEventListener('click', this.__clearSearchBar.bind(this));
	}
	__clearSearchBar()
	{
		this.search_input.value = '';
		this.vendor_list.innerHTML = this.original_content;
	}
	__searchVendors()
	{
		let content = event.target.value;
		let ajax = new AjaxRequest();
		if(content === '') {
			this.vendor_list.innerHTML = this.original_content;
		}
		else {
			ajax.setup('POST', '/vendor/search', function(results) {
				console.log(results);
				this.__replaceHTML(results);
			}.bind(this));
			ajax.send(content);
		}
	}
	__init()
	{
		this.__addEvents();
	}
	__replaceHTML(replacement)
	{
		replacement = JSON.parse(replacement);
		console.log(replacement);

		this.vendor_list.innerHTML = '';

		replacement.forEach(function(r) {

		// let rest_of_text = `<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		let rest_of_text = `<div class="row">
						<div class="col-md-12">
								<a class='dropdown-item' href="/vendor/${r['vendor_id']}">
									View Details
								</a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								
								<a class='dropdown-item' href="/vendor/${r['vendor_id']}/edit">
									Edit
								</a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
		    					<button style="cursor:pointer;"class="dropdown-item" onclick="if(confirm('Are you sure?')){$(this).find('form').submit()};">Delete
									<form action="/vendor/${r['vendor_id']}" method="post">
		        						<input type="hidden" name="_method" value="DELETE">
		        						<input type="hidden" name="_method">
		    						</form>
		    					</button>
							</div>
						</div>`;
					// </div>`;
		let dropdown = document.createElement('div');
		dropdown.classList.add('dropdown');

		let dropdown_menu = document.createElement('div');
		dropdown_menu.classList.add('dropdown-menu');
		dropdown_menu.setAttribute('aria-labelledby', 'dropdownMenuButton');

		let button = document.createElement('button');
		button.classList.add('btn', 'btn-sm', 'btn-outline-info', 'dropdown-toggle', 'vendor-info-bar');
		button.setAttribute('type', 'button');
		button.setAttribute('id', 'dropdownMenuButton');
		button.setAttribute('data-toggle', 'dropdown');
		button.setAttribute('aria-haspopup', 'true');
		button.setAttribute('aria-expanded', 'false');


		let text = `${r['vendor_id']}<br>
			${r['name']} | ${r['company']}<br>
			${r['address']} | ${r['state']} ${r['zip']}<br>
			${r['email']} | ${r['phone_number']}<br>`;

		button.innerHTML = text;
		dropdown_menu.innerHTML = rest_of_text;
		console.log(button, dropdown);
		dropdown.appendChild(button);
		dropdown.appendChild(dropdown_menu);
		this.vendor_list.appendChild(dropdown);
		}.bind(this));

	}
}
let vendor_search = new VendorSearch;
