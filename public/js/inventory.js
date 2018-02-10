let listener = function(response) {
	let due_date_input = $('input#due_date')[0];
	due_date_input.value = `${response[1]}/${response[2]}/${response[0]}`;
}
let customer = new CustomerPreview();
customer.attachEvents();
	
let date_input = $('span.fake-button.show-calendar')[0];
let calendar = new Calendar(listener);
calendar.listen(date_input, 'click');
// calendar.listenForClose(date_input, 'blur');
