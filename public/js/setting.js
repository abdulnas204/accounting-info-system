// class SettingsModule {
// 	constructor()
// 	{
// 		self.view_container = $('#setting-view-container')[0];
// 		self.buttons = {
// 			'home': $('#side-nav-menu li span.side-nav-button')[0],
// 			'general': $('#side-nav-menu li span.side-nav-button')[1],
// 			'reports': $('#side-nav-menu li span.side-nav-button')[2],
// 			'home': $('#side-nav-menu li span.side-nav-button')[3],
// 			'home': $('#side-nav-menu li span.side-nav-button')[4],
// 			'home': $('#side-nav-menu li span.side-nav-button')[5],
// 		}
// 	}
// 	_templates(id)
// 	{
// 		let home_view = 
// 		`
// 			<h2>Home</h2>
// 			<div class="container">
// 				<p>Hello</p>
// 			</div>
// 		`;
		
// 		let map = {
// 			'home': home_view,
// 		};

// 		return map[id];


// 	}
// 	listen()
// 	{

// 	}
// 	render(id)
// 	{
// 		let template = this._templates(id);
// 		self.view_container.innerHTML = template;
// 	}
// }

// let Settings = new SettingsModule();
// Settings.render('home');
class AddActiveClass
{
	constructor()
	{
		this.tab_names = {
			'Home': $('#side-nav-menu li .side-nav-button')[0],
			'General': $('#side-nav-menu li .side-nav-button')[1],
			'Reports': $('#side-nav-menu li .side-nav-button')[2],
			'Taxes': $('#side-nav-menu li .side-nav-button')[3],
			'Localization': $('#side-nav-menu li .side-nav-button')[4],
		}
		this.title = this._pluckTitle();
		this._addActive();
	}
	_pluckTitle()
	{
		let title = $('h1')[0].innerHTML;
		// console.log("'" + title + "'");
		return title.replace('\n', '');
	}
	_addActive()
	{
		let button = this.tab_names[this.title];
		button.classList.add('active');
	}
}

let AddActive = new AddActiveClass();

let listener = function(response) {
	let due_date_input = $('input#start_date')[0];
	due_date_input.value = `${response[1]}/${response[2]}/${response[0]}`;
}
	
let date_input = $('span.fake-button.show-calendar')[0];
let calendar = new Calendar(listener);
calendar.listen(date_input, 'click');
// calendar.listenForClose(date_input, 'blur');
