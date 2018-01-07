function onKeyPressEvent(element, callback){
	//element = Array.prototype.slice.call(element);

	//element.forEach(function(ele){
		element.addEventListener('keydown', function(){
			/*if(event.keyCode === keycode){
				callback(event.keyCode);
			}*/
			callback(event.keyCode);
		})
	//});
}
let Pointer = class {
	constructor(){
		this.currentpos;
		this.lock = false;
	}
	setFocus(){
		this.currentpos.focus();
		this.currentpos.select();
		this.lock = true;
		this.currentpos.style.border = '5px solid red';
	}
	removeFocus(){
		this.lock = false;
		this.currentpos.style.border = '2px solid green';
	}
	setPointer(pos){
		this.currentpos = pos;
		this.currentpos.focus();
		//console.log(this.currentpos);
		this.currentpos.style.border = '2px solid red';
		//this.lock = true;
	}
	removePointer(){
		this.currentpos.style.border = '';
		this.lock = false;
		//this.currentpos.blur();
	}
}
const HTMLPointer = new Pointer();
let SessionStorage = class {
	constructor(){

	}
	setup(){
		let input_boxes = document.getElementsByClassName('cell');

		for(let i=0;i<input_boxes.length;i++){
		//input_boxes.forEach(function(box){
			if (sessionStorage.getItem("autosave")){
				console.log(input_boxes[i]);
				// Restore the contents of the text field
				input_boxes[i].value = sessionStorage.getItem("autosave");
			}
		};
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

let GeneralLedger = class {
	constructor(){
		/*if(localstored){
			let container = document.querySelector('.ledger-body');
			let localstored = localStorage.html;
			container.innerHTML = localstored;
		}*/
		this.init();
		
	}
	saveChanges(){
		let rows = document.getElementsByClassName('tx-row');
		let dataArray = Array.prototype.slice.call(rows);
		let array = []

		dataArray.forEach(function(d){
			let children = Array.prototype.slice.call(d.children, 1);
			let i = 0;
			let returnData = {
				date: children[0].value,
				tx: children[1].value,
				dr: children[2].value,
				cr: children[3].value,
				desc: children[4].value
			};
			array.push(returnData);

		});
		let ajaxRequest = new AjaxRequest();
		ajaxRequest.setup("PUT", "/ledger/accounts/update", this.updateLedgerFeedback);
		ajaxRequest.send(array);
		localStorage['number_of_rows'] = 0;
		localStorage['cell_inputs'] = '';
	}
	updateLedgerFeedback(data){
		console.log("Request successful");
		console.log("Update ledger feedback: ", data);

		/*let ajaxRequest = new AjaxRequest();
			ajaxRequest.setup("GET", "/ledger/accounts/test", function(){
				console.log("Get request works");
			});
			ajaxRequest.send(array);*/
	}
	ledgerShortCuts(expression){

	}
	ledgerKeypressFunctions(){
		let keycode = event.keyCode;
		
		function leftArrowPress(current){
			let new_element = current.previousSibling;
			if(new_element){
				if(HTMLPointer.lock === false){
					HTMLPointer.removePointer();
					HTMLPointer.setPointer(new_element);
					//new_element.focus();
				}
			}
		}
		function rightArrowPress(current){
			let new_element = current.nextSibling;
			if(new_element){
				if(HTMLPointer.lock === false){

					HTMLPointer.removePointer();
					HTMLPointer.setPointer(new_element);
					//new_element.focus();
				}
			}
		}
		function upArrowPress(current){
			let ele_container = current.parentElement;
			let current_ele_nodes = ele_container.childNodes;
			let current_array = Array.prototype.slice.call(current_ele_nodes);

			let current_offset = current_array.indexOf(current);

			let new_container = ele_container.previousSibling.childNodes;
			let new_element = new_container.item(current_offset);

			if(new_element){
				if(HTMLPointer.lock === false){

					HTMLPointer.removePointer();
					HTMLPointer.setPointer(new_element);
					//new_element.focus();
				}
			}
		}
		function downArrowPress(current){
			let ele_container = current.parentElement;
			let current_ele_nodes = ele_container.childNodes;
			let current_array = Array.prototype.slice.call(current_ele_nodes);

			let current_offset = current_array.indexOf(current);

			let new_container = ele_container.nextSibling.childNodes;
			let new_element = new_container.item(current_offset);
			
			if(new_element){
				if(HTMLPointer.lock === false){

					HTMLPointer.removePointer();
					HTMLPointer.setPointer(new_element);
					//new_element.focus();
				}
			}
		}
		function enterKeyPress(current){
			if(HTMLPointer.lock === true){
				HTMLPointer.removeFocus();
				downArrowPress(current);
				console.log("Hi");
			}
			else{
				HTMLPointer.setFocus();
			}
		}
		function escKeyPress(){
			HTMLPointer.removeFocus();
		}
		let current_position = HTMLPointer.currentpos;
		switch(keycode){
			case 13:
				enterKeyPress(current_position);
				break;
			case 27:
				escKeyPress();
				break;
			case 37:
				if(HTMLPointer.lock === false){
					event.preventDefault();
				}
				leftArrowPress(current_position);
				break;
			case 38:
				if(HTMLPointer.lock === false){
					event.preventDefault();
				}
				upArrowPress(current_position);
				break;
			case 39:
				if(HTMLPointer.lock === false){
					event.preventDefault();
				}
				rightArrowPress(current_position);
				break;
			case 40:
				if(HTMLPointer.lock === false){
					event.preventDefault();
				}
				downArrowPress(current_position);
				break;
		};
	}
	attachEventHandlers(){
		let add_new_row = document.getElementsByClassName("create-new-row")[0];
		let add_new_tx = document.getElementsByClassName("create-new-tx")[0];
		let ledger_body = document.getElementsByClassName('ledger-body')[0];
		
		let btn_save_changes = document.querySelector('.btn-save-changes');
		let input_cells = document.getElementsByClassName('cell');
		let input_cells_array = Array.prototype.slice.call(input_cells);

		input_cells_array.forEach(function(cell){
			cell.addEventListener('change', function(){
				let ledger_body = document.querySelector('.ledger-body');

				this.saveContentsToLocalStorage(cell);
			}.bind(this));

			cell.addEventListener('focus', function(){
				HTMLPointer.setPointer(this);
			});

			//onKeyPressEvent(cell, this.ledgerKeypressFunctions);
			cell.addEventListener('keydown', this.ledgerKeypressFunctions.bind(this));

			cell.addEventListener('blur', function(){
				HTMLPointer.removePointer(this);
			});


		}.bind(this));

		add_new_row.addEventListener('click', this.addLedgerRow.bind(this));
		add_new_row.addEventListener('click', this.incrementRowCounter);


		btn_save_changes.addEventListener('click', this.saveChanges);
	}
	incrementRowCounter(){
		console.log(localStorage['number_of_rows']);
		if(localStorage['number_of_rows']){
			localStorage['number_of_rows']++;
		}
	}
	saveContentsToLocalStorage(){
		let cell = event.target;

		let parent_element = cell.parentElement;
		let parent_element_children = parent_element.childNodes;
		let parent_element_array = Array.prototype.slice.call(parent_element_children);
		let parent_of_parent = parent_element.parentElement.childNodes;
		let parent_of_parent_array = Array.prototype.slice.call(parent_of_parent);

		//this is the "x"
		let cell_index = parent_element_array.indexOf(cell);
		//this is the "y"
		let parent_index = parent_of_parent_array.indexOf(parent_element);

		let data_array = {};
		data_array[`${cell_index}-${parent_index}`] = cell.value;

		if(localStorage['cell_inputs']){
			let retrieval = JSON.parse(localStorage['cell_inputs']);
			retrieval[`${cell_index}-${parent_index}`] = cell.value;
			localStorage['cell_inputs'] = JSON.stringify(retrieval);
		}
		else{
			let obj = data_array;
			localStorage['cell_inputs'] = JSON.stringify(obj);
		}

		let ledger_body = cell.parentElement.parentElement.childNodes;
		let ledger_body_array = Array.prototype.slice.call(ledger_body, 1);
		localStorage['number_of_rows'] = ledger_body_array.length;

		console.log(localStorage['cell_inputs']);

	}
	loadContentsFromLocalStorage(){
		let contents = JSON.parse(localStorage['cell_inputs']);
		for(let key in contents){
			if (!contents.hasOwnProperty(key)) continue;

			var obj = contents[key];
			for (let prop in obj) {
				// skip loop if the property is from prototype
				if(!obj.hasOwnProperty(prop)) continue;

				let key_array = key.split('-');
				console.log("Key ", key_array);

				let key_array_x = parseInt(key_array[0]);
				let key_array_y = parseInt(key_array[1]);

				let ledger_body = document.querySelector('.ledger-body');
				let ledger_body_children = ledger_body.childNodes;
				let ledger_children_array = Array.prototype.slice.call(ledger_body_children);

				let correct_row = ledger_children_array[key_array_y];
				let correct_row_children = Array.prototype.slice.call(correct_row.childNodes);

				let correct_cell = correct_row_children[key_array_x];

				correct_cell.value = obj;

    		}
		}
	}
	addLedgerRow(){
		let ledger_body = document.querySelector('.ledger-body');

		let tx_row = HTMLGenerator.generate('div');
		let number_cell = HTMLGenerator.generate('span');
		let input_date_cell = HTMLGenerator.generate('input');
		let input_tx_cell = HTMLGenerator.generate('input');
		let input_dr_cell = HTMLGenerator.generate('input');
		let input_cr_cell = HTMLGenerator.generate('input');
		let input_desc_cell = HTMLGenerator.generate('input');

		input_date_cell.setAttribute('type', 'text');
		input_tx_cell.setAttribute('type', 'text');
		input_dr_cell.setAttribute('type', 'text');
		input_cr_cell.setAttribute('type', 'text');
		input_desc_cell.setAttribute('type', 'text');

		tx_row.className = 'tx-row';
		number_cell.className = 'cell number-cell';
		input_date_cell.className = 'cell date-cell';
		input_tx_cell.className = 'cell transaction-cell';
		input_dr_cell.className = 'cell debit-cell';
		input_cr_cell.className = 'cell credit-cell';
		input_desc_cell.className = 'cell desc-cell';

		ledger_body.appendChild(tx_row);

		tx_row.appendChild(number_cell);
		tx_row.appendChild(input_date_cell);
		tx_row.appendChild(input_tx_cell);
		tx_row.appendChild(input_dr_cell);
		tx_row.appendChild(input_cr_cell);
		tx_row.appendChild(input_desc_cell);

		input_date_cell.addEventListener('focus', function(){
			HTMLPointer.setPointer(this);
		});
		input_tx_cell.addEventListener('focus', function(){
			HTMLPointer.setPointer(this);
		});
		input_dr_cell.addEventListener('focus', function(){
			HTMLPointer.setPointer(this);
		});
		input_cr_cell.addEventListener('focus', function(){
			HTMLPointer.setPointer(this);
		});
		input_desc_cell.addEventListener('focus', function(){
			HTMLPointer.setPointer(this);
		});

		let tx_row_children = tx_row.childNodes;
		let tx_row_array = Array.prototype.slice.call(tx_row_children);

		tx_row_array.forEach(function(cell){
			cell.addEventListener('blur', function(){
				HTMLPointer.removePointer(this);
			}.bind(this));
			cell.addEventListener('change', this.saveContentsToLocalStorage.bind(this));
			cell.addEventListener('keydown', this.ledgerKeypressFunctions.bind(this));
		}.bind(this));

	}
	init(){
		//this.determinePosition();
		this.attachEventHandlers();
		for(let i=0;i<localStorage['number_of_rows'];i++){
			this.addLedgerRow();
		}
		this.loadContentsFromLocalStorage();
	}
}
let Ledger = new GeneralLedger();


/* Menu Functionality */
let PopupMenu = class {
	constructor(){
		this.body = document.getElementById('container');
		this.div = document.createElement('div');
		this.ledger_container = document.getElementById("ledger-container");
		this.menu_container = document.getElementById('menu-container');
		this.popup_menu = document.getElementsByClassName('popup-menu')[0];
		this.popup_menu_body = document.getElementsByClassName('popup-menu-body')[0];
		this.popup_close_button = document.querySelector('.btn-popup-close');

	}
	attachEventHandlers(){
		let view_acc_button = document.getElementsByClassName('btn-view-accounts')[0];
		view_acc_button.addEventListener('click', function(){
			// Bring up menu
			this.showMenu();
		
			let httpReq = new XMLHttpRequest();
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
		
					 	let PopupAccountView = new PopupAccountViewModule('popup-menu-body	');
					 	PopupAccountView.printViewAccount(accounts);
		
					 	let PopupAddAccount = new PopupAddAccountModule('popup-menu-body');
					 	PopupAddAccount.attachEventHandlers();
					 	PopupAddAccount.printView();
					} 
					else {
					  	console.log('There was a problem with the request.');
					}
  				}
			}
			httpReq.send();
		}.bind(this));

		this.popup_close_button.addEventListener('click', function(){
			this.removeMenu();
		}.bind(this));

		window.addEventListener('keydown', function(){
			this.removeMenu(event.keyCode);
		}.bind(this));
		//onKeyPressEvent(window, this.removeMenu);
	}
	showMenu(){
		//this.body.appendChild(this.div).className = "popup-menu";
		this.popup_menu.style.display = "block";
		this.ledger_container.classList.add("unfocused");
		this.menu_container.classList.add("unfocused");
	}
	init(){
		this.attachEventHandlers();
		//this.showMenu();
	}
	removeMenu(keycode){
		keycode = keycode || '';
		if(keycode){
			if(keycode === 27){
				//this.body.removeChild(this.div);
				this.popup_menu.style.display = "none";
				this.ledger_container.classList.remove("unfocused");
				this.menu_container.classList.remove("unfocused");
				this.popup_menu_body.innerHTML = '';
			}
		}
		else{
			//this.body.removeChild(this.div);
			this.popup_menu.style.display = "none";
			this.ledger_container.classList.remove("unfocused");
			this.menu_container.classList.remove("unfocused");
			this.popup_menu_body.innerHTML = '';
			
		}
	}
}
// Basic financial statement math functions
let FSMath = class {
	constructor(){

	}
}
let AjaxRequest = class {
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
					console.log("Returned from ajax query: ", data);
					func(data);
				} 
				else {
				  	console.log('There was a problem with the request.');
				}
  			}
		}
		this.httpReq.open(type, url);
		this.httpReq.setRequestHeader("Content-type", "application/json");

		let x_csrf_token = document.getElementsByClassName('csrf-token')[0];
		this.httpReq.setRequestHeader('X-CSRF-TOKEN', x_csrf_token.getAttribute('content'));

		this.httpReq.onreadystatechange = callbackFunc.bind(this);
	}
	send(params){
		params = JSON.stringify(params);
		this.httpReq.send(params);
	}
}
// For modules, specify what the container will be
let PopupAddAccountModule = class {
	constructor(htmlElement){
		this.container = htmlElement;
		this.div = HTMLGenerator.generate('div');
		this.h3 = HTMLGenerator.generate('h3');
		this.remove_acc_header = HTMLGenerator.generate('h3');

		this.add_account_header = HTMLGenerator.generate('div');
		this.add_account_body = HTMLGenerator.generate('div');
		this.add_account_footer = HTMLGenerator.generate('div');

		this.add_acc_name_input = HTMLGenerator.generate('input');
		this.add_acc_type_input = HTMLGenerator.generate('input');
		this.add_acc_submit = HTMLGenerator.generate('button');

		this.remove_acc_input = HTMLGenerator.generate('input');
		this.remove_acc_submit = HTMLGenerator.generate('button');

		this.feedback_div = HTMLGenerator.generate('div');

		this.div.className = "add-account-panel";

		this.feedback_div.className = 'feedback-div';

		this.add_account_header.className = 'add-account-header';
		this.add_account_body.className = 'add-account-body';
		this.add_account_footer.className = 'add-account-footer';

		this.add_acc_name_input.className = 'add-acc-name';
		this.add_acc_type_input.className = 'add-acc-type';
		this.add_acc_submit.className = 'add-acc-submit';

		this.remove_acc_input.className = 'remove-acc-input';
		this.remove_acc_submit.className = 'remove-acc-submit';
	}
	attachEventHandlers(){
		this.add_acc_submit.addEventListener('click', function(){
			let acc_name = document.getElementsByClassName('add-acc-name')[0];
			let acc_type = document.getElementsByClassName('add-acc-type')[0];
			let acc_name_val = acc_name.value;
			let acc_type_val = acc_type.value;

			let data = {
				info: [],
				payload: [acc_name_val, acc_type_val]
			};

			let ajaxRequest = new AjaxRequest();
			ajaxRequest.setup("POST", "/ledger/accounts/add", this.addAccountFeedback);
			ajaxRequest.send(data);
		}.bind(this));

		this.remove_acc_submit.addEventListener('click', function(){
			let remove_acc_input = document.querySelector('.remove-acc-submit');
			//console.log(this.remove_acc_input.value);
			let remove_acc_name = this.remove_acc_input.value;

			let data = {
				info: [],
				payload: remove_acc_name
			}

			let ajaxRequest = new AjaxRequest();
			ajaxRequest.setup("POST", "/ledger/accounts/remove", this.removeAccountFeedback);
			ajaxRequest.send(data);
		}.bind(this));
	}
	// This function runs after the promise generated by the ajax request executes on a 200 OKAY status response - data is passed from the promise to this func
	addAccountFeedback(data){
		//console.log("uhhh", data);
		let feedback_div = document.getElementsByClassName('feedback-div')[0];
		feedback_div.innerHTML = data;
	}
	removeAccountFeedback(data){
		let feedback_div = document.querySelector('.feedback-div');
		feedback_div.innerHTML = data;
	}
	refresh(){
		//this.destroyModule();
		//let popup_module = new PopupMenu();
		console.log(popupMenu);

	}
	printView(){
		let container = document.getElementsByClassName(this.container)[0];

		container.appendChild(this.div);

		this.div.appendChild(this.add_account_header).appendChild(this.h3).innerHTML = "Add Account";
		this.div.appendChild(this.add_account_body);
		this.div.appendChild(this.add_account_footer);

		this.add_acc_name_input.setAttribute('placeholder', 'Account Name');
		this.add_acc_type_input.setAttribute('placeholder', 'Account Type');

		this.add_account_body.appendChild(this.add_acc_name_input);
		this.add_account_body.appendChild(this.add_acc_type_input);
		this.add_account_body.appendChild(this.add_acc_submit).innerHTML = "Add Account";
		this.add_account_body.appendChild(HTMLGenerator.generate('br'));

		//this.attachEventHandlers();
		this.add_account_body.appendChild(this.remove_acc_header).innerHTML = "Remove Account";
		this.add_account_body.appendChild(this.remove_acc_input);
		this.add_account_body.appendChild(HTMLGenerator.generate('br'));
		this.add_account_body.appendChild(this.remove_acc_submit);

		this.remove_acc_input.setAttribute('placeholder', 'Account Name');
		this.remove_acc_submit.innerHTML = 'Remove Account';

		this.add_account_body.appendChild(HTMLGenerator.generate('br'));
		this.add_account_body.appendChild(this.feedback_div);
	}
	destroyModule(){
		this.container.innerHTML = '';
	}
}
let PopupAccountViewModule = class {
	constructor(htmlElement){
		this.container = htmlElement;

		this.div = HTMLGenerator.generate('div');

		this.div_assets = HTMLGenerator.generate('div');
		this.div_liabilities = HTMLGenerator.generate('div');
		this.div_equity = HTMLGenerator.generate('div');

		this.ul_assets = HTMLGenerator.generate('ul');
		this.ul_liabilities = HTMLGenerator.generate('ul');
		this.ul_equity = HTMLGenerator.generate('ul');

		this.div.className = "account-name-list";

		this.ul_assets.className = "popup-ul ul-assets";
		this.ul_liabilities.className = "popup-ul ul-liabilities";
		this.ul_equity.className = "popup-ul ul-equity";

		this.ul_assets_header = HTMLGenerator.generate('h3');
		this.ul_liabilities_header = HTMLGenerator.generate('h3');
		this.ul_equity_header = HTMLGenerator.generate('h3');
	}
	attachEventHandlers(){
		
	}
	printViewAccount(accounts){
		let container = document.getElementsByClassName(this.container)[0];
		//let div = document.createElement('div');//.className('account-name-list';

		container.appendChild(this.div);
		let div = document.getElementsByClassName('account-name-list');

		this.div.appendChild(this.div_assets);
		this.div.appendChild(this.div_liabilities);
		this.div.appendChild(this.div_equity);

		this.div_assets.appendChild(this.ul_assets);
		this.div_liabilities.appendChild(this.ul_liabilities);
		this.div_equity.appendChild(this.ul_equity);

		this.ul_assets.appendChild(this.ul_assets_header).innerHTML = 'Assets';
		this.ul_liabilities.appendChild(this.ul_liabilities_header).innerHTML = 'Liability';
		this.ul_equity.appendChild(this.ul_equity_header).innerHTML = 'Equity';

		accounts.forEach(function(acc){
			if(acc.payload.account_type == "Asset"){
				this.ul_assets.appendChild(HTMLGenerator.generate('li')).innerHTML = acc.payload.account_name + ' - ' + acc.payload.balance;
			}
			else if(acc.payload.account_type == "Liability"){
				this.ul_liabilities.appendChild(HTMLGenerator.generate('li')).innerHTML = acc.payload.account_name + ' - ' + acc.payload.balance;
			}
			else if(acc.payload.account_type == "Equity"){
				this.ul_equity.appendChild(HTMLGenerator.generate('li')).innerHTML = acc.payload.account_name + ' - ' + acc.payload.balance;
			}
			else{
				console.log("Error loading account ", acc.identifier);
			}

		}.bind(this));
	}
	destroyModule(){
		this.container.innerHTML = '';
	}
}


const popupMenu = new PopupMenu();
popupMenu.init();

let popup_refresh_button = document.getElementsByClassName('btn-popup-refresh')[0];


popup_refresh_button.addEventListener('click', function(){
	PopupAddAccount.destroyModule();
	PopupAccountView.destroyModule();

	// Bring up menu
	//popupMenu.showMenu();

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
			 	PopupAccountView.attachEventHandlers();

			 	let PopupAddAccount = new PopupAddAccountModule('popup-menu-body');
			 	PopupAddAccount.printView();
			} 
			else {

			}
  		}
	}
	httpReq.send();
});

/* Ledger Event Handlers */

// Event handler for viewing accs




