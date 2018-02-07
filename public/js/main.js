class AjaxRequest{
	constructor(){
		this.httpReq = new XMLHttpRequest();

	}
	setup(type, url, func, args){
		func = func || function() { };
		args = args || [];

		function callbackFunc(){
			if (this.httpReq.readyState === 4) {
				if (this.httpReq.status === 200) {
					//let data = JSON.parse(this.httpReq.response);
					let data = this.httpReq.response;
					//console.log("Returned from ajax query: ", data);
					func(data);
				} 
				else {
				  	console.log('There was a problem with the request.');
				}
  			}
		}
		this.httpReq.open(type, url);
		this.httpReq.setRequestHeader("Content-type", "application/json");

		// let x_csrf_token = document.getElementsByClassName('csrf-token')[0];
		let x_csrf_token = document.getElementsByName('_token')[0];
		console.log(x_csrf_token);
		this.httpReq.setRequestHeader('X-CSRF-TOKEN', x_csrf_token.getAttribute('value'));

		this.httpReq.onreadystatechange = callbackFunc.bind(this);
	}
	send(params){
		params = params || {};
		params = JSON.stringify(params);
		this.httpReq.send(params);
	}
}

/*function $( cssquery ) {
    var t = document.querySelectorAll(cssquery);
    return (t.length === 0) ? false : (t.length === 1) ? Array.prototype.slice.call(t)[0] : Array.prototype.slice.call(t);
}*/
// $('input[name="due_date"]').mask('0/0/0000');
// $('input#due_date').inputmask({"mask": "9/9/9999"});




var contains = function(needle) {
    var findNaN = needle !== needle;
    var indexOf;

    if(!findNaN && typeof Array.prototype.indexOf === 'function') {
        indexOf = Array.prototype.indexOf;
    } else {
        indexOf = function(needle) {
            var i = -1, index = -1;

            for(i = 0; i < this.length; i++) {
                var item = this[i];

                if((findNaN && item !== item) || item === needle) {
                    index = i;
                    break;
                }
            }

            return index;
        };
    }

    return indexOf.call(this, needle) > -1;
};
function formValidator()
{
	function prevent()
	{
		event.preventDefault();
		event.returnValue = false;

		let list_of_errors = [];
		for (let i = 0; i < cleaned_inputs.length; i++) {
			if(master_bool[i] === 'false') {
				list_of_errors.push(cleaned_inputs[i].split('#')[1]);
			}
		}
		alert("Errors..." + list_of_errors.join(', '));
		return false;
	}
	
	let master_bool = [];
	let registered_inputs = [
		'input#name', 
		'input#email', 
		'wtf',
		'input#address', 
		'input#phone_number', 
		'input#city', 
		'select#state', 
		'input#zip', 
		'input#country',
		'xfd',
	];
	let cleaned_inputs = [];
	registered_inputs.forEach(function(input) {
		if($(input).val() !== undefined) {
			if($(input).val() === '') {
				console.log('Added', input);
				master_bool.push('false');
			}
			else{ 
				master_bool.push('true');
			}
			cleaned_inputs.push(input);
		}

	}.bind(master_bool));


	let pass = contains.call(master_bool, 'false') ? prevent() : true;
	// console.log(registered_inputs);
	console.log(cleaned_inputs);
	console.log(pass);
	console.log($('xfdf').val());

	

}

/*************************************************************
*
*  Input masks - preformatting for textboxes which require 
*     specific formats so we can have consistent DB records
*
*
*
**************************************************************/
$('input#due_date').mask('99/99/9999');
$('input[name="phone_number"]').mask('(999) 999 9999');