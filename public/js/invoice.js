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

		this.__init();
	}
	__lineItemFactory()
	{
		let table_row = 
			`<tr>
				<td><input type="text" name='invoice-line-item-name[]'></td>
				<td><input type="text" class="price-line" name='invoice-line-item-price[]'></td>
				<td><input type="text" class="quantity-line" name='invoice-line-item-quantity[]'></td>
				<td><input type="text" name='invoice-line-item-unit[]'></td>
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

	}
	__findTotalFromPrice(event)
	{
		let total = (event.target.value * event.target.parentNode.nextSibling.nextSibling.childNodes[0].value).toFixed(2);
		let total_span = event.target.parentNode.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.childNodes[0];
		total_span.innerHTML = "$" + total;
		this.__updateTotals();
	}
	__findTotalFromQuantity(event)
	{
		let total = (event.target.value * event.target.parentNode.previousSibling.previousSibling.childNodes[0].value).toFixed(2);
		let total_span = event.target.parentNode.nextSibling.nextSibling.nextSibling.nextSibling.childNodes[0];
		total_span.innerHTML = "$" + total;
		this.__updateTotals();
	}
	__updateView()
	{

	}
	__getTaxPercentage()
	{
		console.log("###", $('select#tax_id')[0].value);

	}
	__updateTotals()
	{
		this.__getTaxPercentage();
		let subtotal_container = $('td#subtotal-number')[0];
		let total_container = $('td#total-number')[0];
		let tax_container = $('td#tax-number')[0];



		let totals = Array.prototype.slice.call($('span#invoice-line-item-total'));
		let subtotal = 0;

		totals.forEach(function(total) {
			subtotal += Number(total.innerHTML.substr(1));
		});

		let tax_id = $('select#tax_id')[0].value;
		let ajax = new AjaxRequest();
		ajax.setup('POST', '/setting/taxes/' + tax_id + '/get', function(data) {
			data = JSON.parse(data);
			let tax_percent = data['percentage'] / 100;
			let taxed = subtotal * tax_percent;
			let total = subtotal + taxed;

			subtotal_container.innerHTML = "$" + subtotal.toFixed(2);
			tax_container.innerHTML = "$" + taxed.toFixed(2);
			total_container.innerHTML = "$" + total.toFixed(2);
			
		});
		ajax.send(tax_id)

	}
	__init()
	{
		let price_input = $('input.price-line')[0];
		let quantity_input = $('input.quantity-line')[0];

		let select = $('select')[0];
		select.addEventListener('click', this.__updateTotals.bind(this));

		// let quantity_inputs = Array.prototype.slice.call($('input.quantity-line'));
		// price_input.on('input mouseover', this.__findTotalFromPrice.bind(this));
		$('input.price-line').on('input', this.__findTotalFromPrice.bind(this));
		quantity_input.addEventListener('input', this.__findTotalFromQuantity.bind(this));

		this.add_new_item_button.addEventListener('click', this.__addNewLine.bind(this));
		this.__updateTotals();
	}
}
let LineItemController = new InvoiceLineItemController();