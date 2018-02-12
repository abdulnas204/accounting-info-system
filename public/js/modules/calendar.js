class Calendar {
	constructor(listener, id=0)
	{
		this.listener = listener;
		this.identifier = id.toString();
		console.log(this.identifier, typeof(this.identifier));


		let today = new Date();
		this.year = today.getFullYear();
		this.month = today.getMonth() + 1;
		this.date = today.getDate();

		this.day = today.getDay();

		this.months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		this.days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

		this.object = this.__generateRows();

		this.calendar = [[],[],[],[],[], []];

		// let form = document.querySelectorAll('form')[0];

		// form.appendChild(this.calendar_container);


		this.calendar_container = $('.calendar-container' + this.identifier)[0];
	}
	callback(event)
	{
		let calendars = $('.calendar');
		let cal_buttons = Array.prototype.slice.call($('form span.fake-button'));
		console.log(cal_buttons);

		if(event.target.classList.contains('active')) {
			this.__destroyCalendar();
			event.target.classList.remove('active');
		}
		else {

			cal_buttons.forEach(function(cal) {
				cal.classList.remove('active');
			})
			this.__renderCalendar(this.object, event);
			this.__broadcastButtons();
			event.target.classList.add('active');
		}

		cal_buttons.forEach(function(cal) {
			if (cal.classList.contains('active')) {
				// cal.

			}
		}.bind(this));
	}
	__addLeadingZero(number)
	{
		if(Number(number) < 10) {
			number = '0' + `${number}`;
		}
		return number;
	}
	__broadcastButtons(callback)
	{
		callback = callback || function(){};

		let date_cells = $('.calendar-date');
		
		for(let i=0;i<date_cells.length;i++) {
			let date_text = document.querySelector('caption.calendar-month').childNodes[1].textContent;

			if(date_cells[i].innerHTML === '') {
				date_cells[i].classList.remove('fake-button');
				continue;
			}
			let month = date_text.split(' ')[0];
			month = Number(this.months.indexOf(month)) + 1;
			if(this.month === month) {
				if(Number(date_cells[i].innerHTML) === this.date) {
					date_cells[i].classList.add('date-today');
				}
			}

			month = this.__addLeadingZero(month);
			date_cells[i].addEventListener('click', function(event) {

				let day = event.target.innerHTML;
				day = this.__addLeadingZero(day);
				let year = date_text.split(' ')[1];
				this.listener([year, month, day]);
				this.__destroyCalendar();
				$('span.show-calendar')[0].classList.remove('active');

			}.bind(this));
		}
	}
	__destroyCalendar()
	{
		this.calendar_container.innerHTML = '';
		this.calendar = [[],[],[],[],[],[]];
	}
	listen(element, event, callback)
	{
		callback = callback || this.callback;

		this.calendar_container = document.createElement('div');
		this.calendar_container.classList.add('calendar-container' + this.identifier, 'calendar');
		let ele = element.parentNode.parentNode.parentNode.parentNode;

		ele.insertAdjacentHTML('afterEnd', `<div class="calendar-container${this.identifier} calendar"></div>`);
		this.calendar_container = $('.calendar-container' + this.identifier)[0];

		element.addEventListener(event, callback.bind(this));

		// return this;
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

			if(new_obj[key] === "Saturday" || new_obj[key] === 6) {
				pos++;
					
			}
		}.bind(this));

		if(this.calendar[0].length < 7) {
			while(this.calendar[0].length < 7) {
				this.calendar[0].unshift('')
			}
		}
		if(this.calendar[this.calendar.length - 1][0] === undefined) {
			console.log('true');
			this.calendar.pop();
		}
		if(this.calendar[this.calendar.length - 1].length < 7) {
			while (this.calendar[this.calendar.length - 1].length < 7) {
				this.calendar[this.calendar.length - 1].push('');
			}
		}
		console.log(this.calendar);
	}
	__renderCalendar(obj=this.object, event)
	{
		this.__plotCalendar(obj[obj.selection]);

		let table = document.createElement('table');
		let tr = document.createElement('tr');
		let calendar_month = document.createElement('caption');
		calendar_month.classList.add('calendar-month');
		calendar_month.setAttribute('align', 'top');
		let month = obj.selection.split('-')[1] - 1;
		calendar_month.innerHTML = "<span class='fake-button btn-raw calendar-back-button'><<</span>" + "<span>" + this.months[month] + " " + obj.selection.split('-')[0] + "</span>" + "<span class='fake-button btn-raw calendar-forward-button'>>></span>";
		// tr.appendChild()
		table.appendChild(calendar_month);
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


		this.calendar.forEach(function(row){
			let tr = document.createElement('tr');
			row.forEach(function(date) {
				let td = document.createElement('td');
				td.innerHTML = "<span class=\"fake-button calendar-date btn-raw\">" + date + "</span>";
				tr.appendChild(td);
			}.bind(this));
			table.append(tr);
		}.bind(this));

		let back_button = $('span.calendar-back-button')[0];
		let forward_button = $('span.calendar-forward-button')[0];

		back_button.addEventListener('click', this.__renderPrevious.bind(this));
		forward_button.addEventListener('click', this.__renderNext.bind(this));
		
		return table;
	}
	__renderPrevious()
	{
		this.object = this.previousMonth(this.object);
		this.__destroyCalendar();
		this.__renderCalendar(this.object);
		this.__broadcastButtons();
	}
	__renderNext()
	{
		this.object = this.nextMonth(this.object);
		this.__destroyCalendar();
		this.__renderCalendar(this.object);
		this.__broadcastButtons();
		// this.broadcast(callback);
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

		if(day === 7) {
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
		if(new_month === 0) {
			new_month = 12;
			the_year = Number(the_year) - 1;
		}
		else if (new_month === 13) {
			new_month = 1;
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
			obj.selection = new_selection;
			return obj;
		}
		else {
			let first_day = obj[selection]['1'];
			let new_month_last_day = this.__cycleDay(first_day, 'dec');

			let new_split = new_selection.split('-');
			let new_year = new_split[0];
			let new_month = new_split[1];
			let days_in_month = this.__daysInMonth(new_month, new_year)

			let results = this.__generateRows(days_in_month, new_month, new_year, new_month_last_day);

			obj[new_selection] = results[new_selection];
			obj.selection = new_selection;

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

			obj[new_selection] = results[new_selection];
			obj.selection = new_selection;

			return obj;
		}
	}
}


