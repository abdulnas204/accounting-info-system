class Calendar {
	constructor()
	{
		let today = new Date();
		this.year = today.getFullYear();
		this.month = today.getMonth() + 1;
		this.date = today.getDate();

		this.day = today.getDay();

		this.months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		this.days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

		this.object = this.__generateRows();

		this.calendar = [[],[],[],[],[]];

		this.calendar_container = document.createElement('div');
		this.calendar_container.classList.add('calendar-container');

		let form = document.querySelectorAll('form')[0];
		form.appendChild(this.calendar_container);

		let calendar_back = document.createElement('button');
		let calendar_forward = document.createElement('button');
		calendar_back.classList.add('calendar-back-button');
		calendar_forward.classList.add('calendar-forward-button');

		let table = document.createElement('table');
		let calendar_month = document.createElement('caption');
		calendar_month.classList.add('calendar-month');
		calendar_month.setAttribute('align', 'top');
		calendar_month.innerHTML = "<button class='btn-raw calendar-back-button'><<</button> " + this.months[this.month-1] + " <button class='btn-raw calendar-forward-button'>>></button>";

		table.appendChild(calendar_month)
		table.classList.add('calendar-widget');

		this.calendar_container.appendChild(table);

		let header_row = document.createElement('tr')

		let sunday_header = document.createElement('th');
		sunday_header.innerHTML = 'Su';
		let monday_header = document.createElement('th');
		monday_header.innerHTML = 'M';
		let tuesday_header = document.createElement('th');
		tuesday_header.innerHTML = 'T';
		let wednesday_header = document.createElement('th');
		wednesday_header.innerHTML = 'W';
		let thursday_header = document.createElement('th');
		thursday_header.innerHTML = 'T';
		let friday_header = document.createElement('th');
		friday_header.innerHTML = 'F';
		let saturday_header = document.createElement('th');
		saturday_header.innerHTML = 'Sa';

		header_row.appendChild(sunday_header);
		header_row.appendChild(monday_header);
		header_row.appendChild(tuesday_header);
		header_row.appendChild(wednesday_header);
		header_row.appendChild(thursday_header);
		header_row.appendChild(friday_header);
		header_row.appendChild(saturday_header);
		table.appendChild(header_row);

		let back_button = $('button.calendar-back-button')[0];
		let forward_button = $('button.calendar-forward-button')[0];

		back_button.addEventListener('click', this.previousMonth.bind(this));
		forward_button.addEventListener('click', this.nextMonth.bind(this));
		
		/*this.object = this.previousMonth(this.start);
		this.object = this.nextMonth(this.object);
		this.object = this.nextMonth(this.object);
		this.object = this.nextMonth(this.object);
		this.object = this.nextMonth(this.object);
		this.object = this.nextMonth(this.object);
		this.object = this.nextMonth(this.object);
*/
	}
	callback(event)
	{
		console.log(event);
		this.__renderCalendar(this.object);
	}
	__destroyCalendar()
	{
		/*let calendar = $('.calendar-container')[0];
		calendar.innerHTML = '';*/
		this.calendar_container.innerHTML = '';
		this.calendar = [[],[],[],[],[]];
	}
	returnDate(obj)
	{

	}
	listen(element, event, callback)
	{
		callback = callback || this.callback;

		element.addEventListener(event, callback.bind(this));

		return this;
	}
	listenForClose(element, event, callback)
	{
		callback = callback || this.__destroyCalendar;

		element.addEventListener(event, callback.bind(this));
		return this;
	}
	__plotCalendar(obj)
	{
		let keys = Object.keys(obj);
		let new_obj = {};
		keys.forEach(function(key){
			new_obj[key] = this.days[obj[key]];
		}.bind(this));

		let row_num = 0;
		

		let pos = 0;
		keys.forEach(function(key){
			
			this.calendar[pos].push(key);

			if(new_obj[key] === "Saturday") {
				pos++;
					
			}
		}.bind(this));
		if(this.calendar[0].length < 7) {
			while(this.calendar[0].length < 7) {
				this.calendar[0].unshift('')
			}
		}
		if(this.calendar[this.calendar.length - 1].length < 7) {
			while (this.calendar[this.calendar.length - 1].length < 7) {
				this.calendar[this.calendar.length - 1].push('');
			}
		}
		console.log(this.calendar);
	}
	__renderCalendar(obj=this.object)
	{
		let keys = Object.keys(obj);
		keys.shift(0);

		this.__plotCalendar(obj[obj.selection]);


		this.calendar.forEach(function(row){
			let tr = document.createElement('tr');
			row.forEach(function(date) {
				let td = document.createElement('td');
				td.innerHTML = "<button class=\"calendar-date btn-raw\">" + date + "</button>";
				tr.appendChild(td);
			});
			table.append(tr);
		});

		
		return table;
	}
	__daysInMonth(month, year)
	{
		return new Date(year, month, 0).getDate();
	}
	__generateRows(day_in_month=this.date, month=this.month, year=this.year, day_of_week=this.day)
	{
		let start_year = year;
		let start_month = month;

		let start_date = day_in_month;

		let start_day = day_of_week;
		
		let start_date_code = start_year + '-' + start_month;

		let date_json = {
			"selection": start_date_code,
		};
		date_json[start_date_code] = {};


		while (day_in_month > 0) {
			date_json[start_date_code][day_in_month] = day_of_week;
			day_of_week = this.__cycleDay(day_of_week, 'dec');
			day_in_month--;
		}

		day_of_week = start_day;
		day_in_month = start_date;
		let days_in_month = this.__daysInMonth(month, year);

		while (day_in_month <= days_in_month) {
			date_json[start_date_code][day_in_month] = day_of_week;
			day_of_week = this.__cycleDay(day_of_week, 'inc');
			day_in_month++;
		}
		return date_json;
	}
	__cycleDay(day, direction)
	{
		if(direction === 'inc') {
			day++;
		}
		else if(direction === 'dec') {
			day--;
		}

		if(day > 6) {
			return 0;
		}
		else if (day === -1) {
			return 6;
		}
		else {
			return day;
		}
	}
	__cycleMonth(date_code, direction)
	{
		let split = date_code.split('-');
		let year = split[0];
		let month = split[1];
		let new_month = null;
		let the_year = year;
		if(direction === 'inc') {
			new_month = Number(month) + 1;
		}
		else if(direction === 'dec') {
			new_month = Number(month) - 1;
		}
		if(new_month === -1) {
			new_month = 11;
			the_year = Number(the_year) - 1;
		}
		else if (new_month === 12) {
			new_month = 0;
			the_year = Number(the_year) + 1;
		}
		let new_datecode = the_year + '-' + new_month;
		return new_datecode;
	}
	previousMonth(obj)
	{
		let selection = obj.selection;
		let new_selection = this.__cycleMonth(selection, 'dec');

		if(obj.hasOwnProperty(new_selection)) {
			return obj[new_selection];
		}
		else {
			let first_day = obj[selection]['1'];
			let new_month_last_day = first_day - 1;

			let new_split = new_selection.split('-');
			let new_year = new_split[0];
			let new_month = new_split[1];
			let days_in_month = this.__daysInMonth(new_month, new_year)

			let results = this.__generateRows(days_in_month, new_month, new_year, new_month_last_day);
			// return results;
			obj[new_selection] = results[new_selection];
			obj.selection = new_selection;
			this.object = obj;
			return obj
		}
	}
	nextMonth(obj=this.start)
	{

		let selection = obj.selection;
		let new_selection = this.__cycleMonth(selection, 'inc');

		let days_in_month = this.__daysInMonth(selection.split('-')[1] , selection.split('-')[0]);

		if(obj.hasOwnProperty(new_selection)) {
			obj.selection = new_selection;
			return obj;
		}
		else {
			let last_day = obj[selection][days_in_month];

			let new_month_first_day = this.__cycleDay(last_day, 'inc');

			let new_split = new_selection.split('-');
			let new_year = Number(new_split[0]);
			let new_month = Number(new_split[1]);

			let results = this.__generateRows(1, new_month, new_year, new_month_first_day);
			// return results;
			obj[new_selection] = results[new_selection];
			obj.selection = new_selection;
			this.object = obj;
			return obj;
		}
	}
	broadcast()
	{
		console.log(this);
	}
}

// let calendar = new Calendar();
// console.log("yip");