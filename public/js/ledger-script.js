
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

/* Menu Functionality */
let PopupMenu = class {
	constructor(){
		this.body = document.getElementById('container');
		this.div = document.createElement('div');
		this.ledger_container = document.getElementById("ledger-container");
		this.menu_container = document.getElementById('menu-container');
		this.popup_menu = document.getElementsByClassName('popup-menu')[0];
		this.popup_menu_body = document.getElementsByClassName('popup-menu-body')[0];
	}
	showMenu(){
		//this.body.appendChild(this.div).className = "popup-menu";
		this.popup_menu.style.display = "block";
		this.ledger_container.classList.add("unfocused");
		this.menu_container.classList.add("unfocused");
	}
	removeMenu(){
		//this.body.removeChild(this.div);
		this.popup_menu.style.display = "none";
		this.ledger_container.classList.remove("unfocused");
		this.menu_container.classList.remove("unfocused");
		this.popup_menu_body.innerHTML = '';
	}
}
/*function popupMenu(){
	let body = document.getElementById('container');
	let div = document.createElement('div');
	let ledger_container = document.getElementById("ledger-container");
	let menu_container = document.getElementById('menu-container');

	body.appendChild(div).className = "popup-menu";
	ledger_container.className += "unfocused";
	menu_container.className += "unfocused";
	console.log(body);
}*/

let PopupViewModules = class {
	constructor(htmlElement){
		this.container = htmlElement;
	}
	printViewAccount(accounts){
		let container = document.getElementsByClassName(this.container)[0];
		let div = document.createElement('div');//.className('account-name-list';
		let ul = document.createElement('ul');

		container.appendChild(div).className = 'account-name-list';
		div.appendChild(ul).className;

		accounts.forEach(function(acc){
			//let li = document.createElement('li');
			let newLi = function(){
				return document.createElement('li');
			}
			ul.appendChild(newLi()).innerHTML = acc.payload.account_name + ' - ' + acc.payload.balance;
			//ul.appendChild(newLi()).innerHTML = acc.payload.balance;
		});
	}
}

let view_acc_button = document.getElementsByClassName('btn-view-accounts')[0];

const popupMenu = new PopupMenu();
let popup_close_button = document.getElementsByClassName('btn-popup-close')[0];
popup_close_button.addEventListener('click', function(){
	popupMenu.removeMenu();
});

/* Ledger Event Handlers */

// Event handler for viewing accs
view_acc_button.addEventListener('click', function(){
	// Bring up menu
	popupMenu.showMenu();

	httpReq = new XMLHttpRequest();
	httpReq.open('GET', '/ledger/accounts/show');
	httpReq.onreadystatechange = function(){
  		// Process the server response here.
  		if (httpReq.readyState === 4) {
			if (httpReq.status === 200) {
				let data = JSON.parse(httpReq.response);
				let returnAccountList = function(data){
					let returnArr = [];
					data.forEach(function(d){
						returnArr.push(d);
					});
					return returnArr;
				}
				let accounts = returnAccountList(data);

			 	let PopupView = new PopupViewModules('popup-menu-body');
			 	PopupView.printViewAccount(accounts);
			} 
			else {
			  	console.log('There was a problem with the request.');
			}
  		}
	}
	httpReq.send();
});


