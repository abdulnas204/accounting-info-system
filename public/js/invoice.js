let listener = function(response) {
	let date_input = $('input#date')[0];
	date_input.value = `${response[1]}/${response[2]}/${response[0]}`;
}
let due_date_listener = function(response) {
	let due_date_input = $('input#due_date')[0];
	due_date_input.value = `${response[1]}/${response[2]}/${response[0]}`;
}
let customer_preview_args = [
	{customer_id: 'customer_id'},
	{name: 'name'},
	{company: 'company'},
	{email: 'email'},
	{address: 'address'},
];
let customer = new CustomerPreview(customer_preview_args);
customer.attachEvents();
	
let date_input = $('span.fake-button.show-calendar')[0];
let calendar = new Calendar(listener);
calendar.listen(date_input, 'click');
// calendar.listenForClose(date_input, 'blur');
let due_date_input = $('span.fake-button.show-calendar')[1];
let due_date_calendar = new Calendar(due_date_listener, 1);
due_date_calendar.listen(due_date_input, 'click');

class InvoiceLineItemController {
	constructor()
	{
		this.table_body = $('table#line-item-list tbody')[0];
		this.add_new_item_button = $('#add-new-item')[0];

		this.tax_options = [];

		this.__init();
	}
	__lineItemFactory()
	{
		var select_list = document.createElement('select');
		select_list.classList.add('tax-line');
		select_list.setAttribute('name', 'invoice-line-item-tax[]');
		select_list.id = 'tax_id';
		//Create and append the options
		var option = document.createElement('option');
		option.value = 0;
		option.text = 'None';
		select_list.appendChild(option);
        for (var i = 0; i < this.tax_options.length; i++) {
            var option = document.createElement("option");
            option.value = this.tax_options[i].tax_id;
            option.text = this.tax_options[i].name + " - " + this.tax_options[i].percentage;
            select_list.appendChild(option);
        }
		let table_row = 
			`<tr>
				<td><input type="text" class="item-line" name='invoice-line-item-name[]'></td>
				<td><input type="text" class="price-line" name='invoice-line-item-price[]'></td>
				<td><input type="text" class="quantity-line" name='invoice-line-item-quantity[]'></td>
				<td><input type="text" class="unit-line" name='invoice-line-item-unit[]'></td>
				<td>${select_list.outerHTML}</td>
				<td><span id='invoice-line-item-total'></span></td>
			</tr>`;
		return table_row;
	}
	__addNewLine()
	{
		let row = this.__lineItemFactory();
		let tr = document.createElement('tr');
		tr.innerHTML = row;

		this.table_body.appendChild(tr);

		$('input.price-line')[$('input.price-line').length - 1].addEventListener('input', this.__findTotalFromPrice.bind(this));
		$('input.quantity-line')[$('input.quantity-line').length - 1].addEventListener('input', this.__findTotalFromQuantity.bind(this));
		$('select.tax-line')[$('select.tax-line').length - 1].addEventListener('change', this.__findTotalFromTax.bind(this));

	}
	__findTotalFromPrice(event)
	{
		var tax = event.target.parentNode.parentNode.querySelector('.tax-line');
		var tax_id = tax.options[tax.selectedIndex].value;
		var tax_percent = this.__getTaxPercentage(tax_id);
		let total = (event.target.value * (1 + Number(tax_percent / 100)) * event.target.parentNode.nextSibling.nextSibling.childNodes[0].value).toFixed(2);
		let total_span = event.target.parentNode.parentNode.querySelector('#invoice-line-item-total');
		total_span.innerHTML = "$" + total;
		this.__updateTotals();
	}
	__findTotalFromQuantity(event)
	{
		var tax = event.target.parentNode.parentNode.querySelector('.tax-line');
		var tax_id = tax.options[tax.selectedIndex].value;
		var tax_percent = this.__getTaxPercentage(tax_id);
		let total = (event.target.value * (1 + Number(tax_percent / 100)) * event.target.parentNode.previousSibling.previousSibling.childNodes[0].value).toFixed(2);
		let total_span = event.target.parentNode.parentNode.querySelector('#invoice-line-item-total');
		total_span.innerHTML = "$" + total;
		this.__updateTotals();
	}

	__findTotalFromTax(event)
	{
		var tax = event.target.parentNode.parentNode.querySelector('.tax-line');
		var tax_id = tax.options[tax.selectedIndex].value;
		var tax_percent = this.__getTaxPercentage(event.target.value);
		let total = (event.target.parentNode.parentNode.querySelector('.price-line').value * (1+ Number(tax_percent / 100)) * event.target.parentNode.parentNode.querySelector('.quantity-line').value).toFixed(2);
		let total_span = event.target.parentNode.parentNode.querySelector('#invoice-line-item-total');
		total_span.innerHTML = "$" + total;
		this.__updateTotals();

	}

	__findTotalFromShipping(event)
	{
		var subtotal = Number($('#subtotal-number')[0].value);
		var taxes = Number($('#tax-number')[0].value);
		var total = event.target.value + taxes + subtotal;

		var total_span = $('#total-number')[0];
		var shipping_span = $('#shipping-number')[0];

		total_span.innerHTML = "$" + total;
		shipping_span.innerHTML = "$ " + Number(event.target.value);
		this.__updateTotals();
	}
	
	__updateView()
	{

	}

	__getTaxPercentage(tax_id)
	{
		for (var i=0; i<this.tax_options.length; i++) {
			if (this.tax_options[i].tax_id == tax_id) {
				var tax_percentage = this.tax_options[i].percentage;
			}
			else {
				continue;
			}
		}
		if (tax_percentage) {
			return tax_percentage;
		}
		else {
			return 0;
		}
	}

	__updateTotals()
	{
		let subtotal_container = $('td#subtotal-number')[0];
		let total_container = $('td#total-number')[0];
		let tax_container = $('td#tax-number')[0];
		let shipping_container = $('td#shipping-number')[0];


		var shipping = Number($('#shipping')[0].value);
		var line_item_list = document.querySelectorAll('#line-item-list tbody tr');

		var tax = 0;
		var subtotal = 0;
		var total = 0;
		for (var i=0; i<line_item_list.length; i++) {
			//tax += line_item_list[i];
			var price = line_item_list[i].querySelector('.price-line').value;
			var quantity = line_item_list[i].querySelector('.quantity-line').value;
			var calc_subtotal = Number(price) * Number(quantity);

			var line_total = Number(line_item_list[i].querySelector('#invoice-line-item-total').innerHTML.substr(1));

			var single_tax = line_total - calc_subtotal; 

			tax += single_tax;
			subtotal += calc_subtotal;
			total += line_total;
		}
		

		total += shipping;

		shipping_container.innerHTML = "$ " + shipping.toFixed(2);
		subtotal_container.innerHTML = "$ " + subtotal.toFixed(2);
		tax_container.innerHTML = "$ " + tax.toFixed(2);
		total_container.innerHTML = "$ " + total.toFixed(2);

		//let totals = Array.prototype.slice.call($('span#invoice-line-item-total'));
		//let subtotal = 0;

		//totals.forEach(function(total) {
		//	console.log("AHH", total);
		//	subtotal += Number(total.innerHTML.substr(1));
		//});

		//let tax_id = $('select#tax_id')[0].value;
		////this.__getTaxPercentage(tax_id, function() {
		////	console.log
		////});
		//let ajax = new AjaxRequest();
		//ajax.setup('POST', '/api/tax/' + tax_id + '/get', function(data) {
		//	data = JSON.parse(data);
		//	let tax_percent = data['percentage'] / 100;
		//	let taxed = subtotal * tax_percent;
		//	let total = subtotal + taxed;

		//	subtotal_container.innerHTML = "$" + subtotal.toFixed(2);
		//	tax_container.innerHTML = "$" + taxed.toFixed(2);
		//	total_container.innerHTML = "$" + total.toFixed(2);
		//});
		//ajax.send(tax_id)

	}

	/**
	 * Finds the tax options for the new line factory
	 */
	__getTaxOptions()
	{
		var ajax = new AjaxRequest();
		ajax.setup('GET', '/api/tax/all', function(data) {
			this.tax_options = JSON.parse(data);
		}.bind(this));
		ajax.send();
	}

	__init()
	{
		this.__getTaxOptions();
		let price_input = $('input.price-line')[0];
		let quantity_input = $('input.quantity-line')[0];

		let select = $('select')[0];
		select.addEventListener('click', this.__updateTotals.bind(this));

		// let quantity_inputs = Array.prototype.slice.call($('input.quantity-line'));
		// price_input.on('input mouseover', this.__findTotalFromPrice.bind(this));
		$('input.price-line').on('input', this.__findTotalFromPrice.bind(this));
		quantity_input.addEventListener('input', this.__findTotalFromQuantity.bind(this));
		$('select.tax-line').on('change', this.__findTotalFromTax.bind(this));
		$('#shipping').on('input', this.__findTotalFromShipping.bind(this));

		this.add_new_item_button.addEventListener('click', this.__addNewLine.bind(this));
		this.__updateTotals();
	}
}
let LineItemController = new InvoiceLineItemController();
