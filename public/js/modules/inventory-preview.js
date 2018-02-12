class InventoryPreview
{
	constructor(inputs)
	{
		this.form_feedback = $('div.form-feedback')[0];

		this.array_of_inputs = inputs;
		this.array_of_responses = [];

		this.array_keys = Object.keys(this.array_of_inputs);
		this.id_key = Object.keys(this.array_of_inputs[0]);
	}
	attachEvents()
	{
		let name_input = document.querySelectorAll('input#inventory_name')[0];
		name_input.addEventListener('input', this.__preview.bind(this));
	}
	__preview()
	{
		let input = event.target.value || ' ';
		if(input != ' ') {
			let url = '/inventory/preview';
			let ajax = new AjaxRequest();
			ajax.setup('POST', url, this.__previewAjaxHandler.bind(this));

			ajax.send(input);
		}
		else {

		}
	}
	__clearInfo()
	{
		this.form_feedback.innerHTML = '';
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
								<li class="${this.array_of_inputs[0][this.id_key[0]]}">${r[this.array_of_inputs[0][this.id_key[0]]]}</li>
								<li class="inventory_name">${r.name}</li>
								<li class="description">${r.description}</li>
							</ul>`;
			btn.innerHTML = btn_text;
		}.bind(this));
	}
	__populateFields(btn)
	{
		let ul = btn.childNodes[0];

		let pick = Number(ul.querySelector('li.' + this.array_of_inputs[0][this.id_key[0]]).innerHTML);
		let chosen_one = null;

		this.array_of_responses.forEach(function(response) {
			if(response[this.array_of_inputs[0][this.id_key[0]]] === pick) {
				chosen_one = response;
				return;
			}
		}.bind(this));

		this.array_of_inputs.forEach(function(obj) {
			let key = Object.keys(obj)[0];
			$('input#' + key)[0].value = chosen_one[obj[key]];
		}.bind(this));

		this.__clearInfo();
	}
}