
let add_new_row = document.getElementsByClassName("create-new-tx")[0];
let ledger_body = document.getElementsByClassName('ledger-body')[0];
let ledger_body_text = "<div class=\"tx-row\"><div class=\"row\"><span class=\"cell number-cell\"></span><input type=\"text\" class=\"cell date-cell\"></input><input type=\"text\" class=\"cell transaction-cell\"></input><input type=\"text\" class=\"cell debit-cell\"></input><input type=\"text\" class=\"cell credit-cell\"></input></div><div class=\"row\"><span class=\"cell number-cell\"></span><input type=\"text\" class=\"cell date-cell\"></input><input type=\"text\" class=\"cell transaction-cell\"></input><input type=\"text\" class=\"cell debit-cell\"></input><input type=\"text\" class=\"cell credit-cell\"></input></div></div>";

let date_cell = document.getElementsByClassName('date-cell');
let tx_cell = document.getElementsByClassName('transaction-cell');

for(var len=0; len<date_cell.length; len++){
	date_cell[len].addEventListener('focusout', function(){
		let next = len + 1;
		this.parentElement.nextElementSibling.childNodes[3].value = this.value;
	});
}


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

let HTMLElementGenerator = class {
	constructor(){
		this.element;
	}
	generate(element){
		this.element = element;
		return document.createElement(this.element);
	}

}
// Use this to generate new HTML modules
const HTMLGenerator = new HTMLElementGenerator();

// Basic financial statement math functions
let FSMath = class {
	constructor(){

	}
}

// For modules, specify what the container will be
let PopupAddAccountModule = class {
	constructor(htmlElement){
		this.container = htmlElement;
	}
	printView(){
		let container = document.getElementsByClassName(this.container)[0];
		let div = HTMLGenerator.generate('div');
		div.className = "add-account-panel";

		let h1 = HTMLGenerator.generate('h3');

		container.appendChild(div);

		let add_account_header = HTMLGenerator.generate('div');
		let add_account_body = HTMLGenerator.generate('div');
		let add_account_footer = HTMLGenerator.generate('div');

		add_account_header.className = 'add-account-header';
		add_account_body.className = 'add-account-body';
		add_account_footer.className = 'add-account-footer';

		//div.appendChild(h1).innerHTML = "Add Account";
		div.appendChild(add_account_header).appendChild(h1).innerHTML = "Add Account";
		div.appendChild(add_account_body);
		div.appendChild(add_account_footer);

		/*add_account_header.className = "add-account-header";
		add_account_body.className = "add-account-body";
		add_account_footer.className = "add-account-footer";*/

		/*let add_account_header = document.getElementsByClassName('add-account-header')[0];
		let add_account_body = document.getElementsByClassName('add-account-body')[0];
		let add_account_footer = document.getElementsByClassName('add-account-footer')[0];*/
		

		let add_acc_name_input = HTMLGenerator.generate('input');
		let add_acc_type_input = HTMLGenerator.generate('input');
		let add_acc_submit = HTMLGenerator.generate('button');

		add_acc_name_input.className = 'add-acc-name';
		add_acc_type_input.className = 'add-acc-type';
		add_acc_submit.className = 'add-acc-submit';

		//add_acc_submit.setAttribute('value', 'Add Account');
		add_acc_name_input.setAttribute('placeholder', 'Account Name');
		add_acc_type_input.setAttribute('placeholder', 'Account Type');

		add_account_body.appendChild(add_acc_name_input);
		add_account_body.appendChild(add_acc_type_input);
		add_account_body.appendChild(add_acc_submit).innerHTML = "Add Account";
		/*;
		HTMLGenerator.generate('div');
		HTMLGenerator.generate('div');*/
	}
	destroyModule(){
		this.container.innerHTML = '';
	}
}

let PopupAccountViewModule = class {
	constructor(htmlElement){
		this.container = htmlElement;
	}
	printViewAccount(accounts){
		let container = document.getElementsByClassName(this.container)[0];
		let div = document.createElement('div');//.className('account-name-list';
		div.className = "account-name-list";

		container.appendChild(div).className = "account-name-list";

		let div_assets = HTMLGenerator.generate('div');
		let div_liability = HTMLGenerator.generate('div');
		let div_equity = HTMLGenerator.generate('div');

		div.appendChild(div_assets).appendChild(HTMLGenerator.generate('ul')).className = "popup-ul ul-assets";
		div.appendChild(div_liability).appendChild(HTMLGenerator.generate('ul')).className = "popup-ul ul-liabilities";
		div.appendChild(div_equity).appendChild(HTMLGenerator.generate('ul')).className = "popup-ul ul-equity";

		let ul_asset = document.getElementsByClassName('ul-assets')[0];
		ul_asset.appendChild(HTMLGenerator.generate('h3')).innerHTML = 'Assets'

		let ul_liability = document.getElementsByClassName('ul-liabilities')[0];
		ul_liability.appendChild(HTMLGenerator.generate('h3')).innerHTML = 'Liability'

		let ul_equity = document.getElementsByClassName('ul-equity')[0];
		ul_equity.appendChild(HTMLGenerator.generate('h3')).innerHTML = 'Equity'

		accounts.forEach(function(acc){
			//let li = document.createElement('li');
			console.log(acc);

			if(acc.payload.account_type == "Asset"){
				ul_asset.appendChild(HTMLGenerator.generate('li')).innerHTML = acc.payload.account_name + ' - ' + acc.payload.balance;
			}
			else if(acc.payload.account_type == "Liability"){
				ul_liability.appendChild(HTMLGenerator.generate('li')).innerHTML = acc.payload.account_name + ' - ' + acc.payload.balance;
			}
			else if(acc.payload.account_type == "Equity"){
				ul_equity.appendChild(HTMLGenerator.generate('li')).innerHTML = acc.payload.account_name + ' - ' + acc.payload.balance;
			}
			else{
				console.log("Error loading account ", acc.identifier);
			}

		});
	}
	destroyModule(){
		this.container.innerHTML = '';
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
				console.log("Returned from ajax query: ", data);
				let returnAccountList = function(data){
					let returnArr = [];
					data.forEach(function(d){
						returnArr.push(d);
					});
					return returnArr;
				}
				let accounts = returnAccountList(data);
				//console.log(accounts);

			 	let PopupAccountView = new PopupAccountViewModule('popup-menu-body');
			 	PopupAccountView.printViewAccount(accounts);

			 	let PopupAddAccount = new PopupAddAccountModule('popup-menu-body');
			 	PopupAddAccount.printView();
			} 
			else {
			  	console.log('There was a problem with the request.');
			}
  		}
	}
	httpReq.send();
});


