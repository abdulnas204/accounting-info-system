class CustomerPreview
{
	constructor(inputs)
	{
		this.form_feedback = document.querySelectorAll('div.form-feedback')[0];

		this.array_of_input_ids = inputs;
		this.array_of_inputs = [];
		this.array_of_responses = [];
		inputs.forEach(function(input) {
			this.array_of_inputs.push($('input#' + input)[0]);
		}.bind(this));
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
		this.array_of_responses = [];
		resp.forEach(function(r){
			this.array_of_responses.push(r);
			let btn = document.createElement('button');
			btn.addEventListener('click', this.__populateFields.bind(this, btn));

			btn.classList.add('btn', 'btn-sm', 'btn-outline-info');
			this.form_feedback.appendChild(btn);

			let btn_text = `<ul>
								<li class="${this.array_of_input_ids[0]}">${r[this.array_of_input_ids[0]]}</li>
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

		let pick = Number(ul.querySelector('li.' + this.array_of_input_ids[0]).innerHTML);
		let chosen_one = null;

		this.array_of_responses.forEach(function(response) {
			if(response.customer_id === pick) {
				chosen_one = response;
				return;
			}
		});

		this.array_of_input_ids.forEach(function(id) {
			$('input#' + id)[0].value = chosen_one[id];
		});


		form_feedback.innerHTML = '';

		
	}
}