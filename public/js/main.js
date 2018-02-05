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
$('input#due_date').mask('99/99/9999');
$('input[name="phone_number"]').mask('(999) 999 9999');