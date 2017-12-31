
let add_new_row = document.getElementsByClassName("create-new-tx")[0];
let ledger_body = document.getElementsByClassName('ledger-body')[0];
let ledger_body_text = "<div class=\"tx-row\"><div class=\"row\"><span class=\"cell number-cell\"></span><input type=\"text\" class=\"cell date-cell\"></input><input type=\"text\" class=\"cell transaction-cell\"></input><input type=\"text\" class=\"cell debit-cell\"></input><input type=\"text\" class=\"cell credit-cell\"></input></div><div class=\"row\"><span class=\"cell number-cell\"></span><input type=\"text\" class=\"cell date-cell\"></input><input type=\"text\" class=\"cell transaction-cell\"></input><input type=\"text\" class=\"cell debit-cell\"></input><input type=\"text\" class=\"cell credit-cell\"></input></div></div>";

let date_cell = document.getElementsByClassName('date-cell');
let tx_cell = document.getElementsByClassName('transaction-cell');

/*date_cell.addEventListener('focusout', function(){
	this.
})*/
for(var len=0; len<date_cell.length; len++){
	date_cell[len].addEventListener('focusout', function(){
		let next = len + 1;
		this.parentElement.nextElementSibling.childNodes[3].value = this.value;
	});
}
/*for(var len=0; len<tx_cell.length; len++){
	tx_cell[len].addEventListener('focusout', function(){
		let next = len + 1;
		this.parentElement.nextElementSibling.childNodes[3].value = this.value;
	});
}*/

add_new_row.addEventListener('click', function(){
	ledger_body.innerHTML += ledger_body_text;
})



function popupMenu(){
	let body = document.getElementById('container');
	let div = document.createElement('div');

	body.appendChild(div).className = "popup-menu";
	console.log(body);
}

function viewAccounts(){

}

let view_acc_button = document.getElementsByClassName('btn-view-accounts')[0];
view_acc_button.addEventListener('click', popupMenu());
