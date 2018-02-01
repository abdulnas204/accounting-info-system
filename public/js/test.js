let btn_1 = document.querySelector('.btn-1');
let btn_2 = document.querySelector('.btn-2');
let btn_3 = document.querySelector('.btn-3');
let btn_4 = document.querySelector('.btn-4');
let btn_5 = document.querySelector('.btn-5');
let btn_6 = document.querySelector('.btn-6');
let btn_7 = document.querySelector('.btn-7');
let btn_8 = document.querySelector('.btn-8');
let btn_9 = document.querySelector('.btn-9');
let btn_10 = document.querySelector('.btn-10');
let btn_11 = document.querySelector('.btn-11');
let btn_12 = document.querySelector('.btn-12');

let Alerter = class {
	constructor(message){
		message = message || '';
		this.message = message;
	}
	trigger(){
		alert(this.message);
	}
}

message = new Alerter('Error!');
//message.trigger();
class SVGExceptionHandler{
	constructor() {
		console.log("SVG Exception Handler triggered!");
	}
}
class SVG{
	constructor(type) {
		this.namespace = "http://www.w3.org/2000/svg";
		this.type = type;

		this.element = document.createElementNS(this.namespace, this.type);
	}
	append(location) {
		try{
			location.appendChild(this.element);
			return this.element;
		}
		catch(error) {
			console.log(error);
			return error;
		}
	}

	attr(attr, value) {
		try{
			this.element.setAttribute(attr, value);
			return this;
		}
		catch(error) {
			console.log(error);
			return error;
		} 
	}
}
class DataToolKit {
	constructor(){

	}
	range(min, max) {
		return Array.from({length: max}, (x, i) => i).slice(min);
	}

}

class SVGData extends SVG {
	constructor(type) {
		super(type);
		this.domain;
		this.range;
		this.set;
	}
	
	data(x, y) {
		this.domain = x;
		this.range = y;

		
		this.transpose(this.domain, this.range);
		let data_points = null;

		this.type === 'path' ? data_points = 'd' : data_points = 'points';
		let strung = this.__stringify(this.set);

		this.element.setAttribute(data_points, strung);
		return this;
	}
	transpose(x, y) { 
		//y = y || [];
		let m = y;
		this.set = x.map(x => [x, m.shift()]);
		//return [x.map(x => [x, y.shift()])];
		return this.set;
	}
	transposetest(x, y, ...z) { 
		//z = z || [];
		//let wot = z.map(a => console.log('wot!!', a));
		//let set = [z.map(a => a.map( b => x.map(x => [x, y.shift()].push(b.shift()))))];
		let set = [z.map(a => x.map(x => [x, y.shift()].push(a.shift())))];
		//return [x.map(x => [x, y.shift()])];
		return set;
	}
	setData(x, y) {
		this.domain = x;
		this.range = y;
		return this;
	}
	__stringify(data) {
		const re = /\[(\d+)\,(\d+)\]/;
		let hold = '';
		data.forEach(function(d){
			let string = JSON.stringify(d);
			hold += string.replace(re, "$1 $2, ");
		});
		return hold.replace(/,([^,]*)$/, '$1');
		
	}
	
}
let a = [1,2,3,4,5,6,7,8,9,10];
let b = [10,9,8,7,6,5,4,3,2,1];

let c = [19,18,17,16];
let d = [29,28,27,26];
let e = [39,38,37,36];

let container = document.querySelector('#container');

let new_svg = new SVG('svg')
	.attr('width', 400)
	.attr('height', 400)
	.append(container);

let new_rect = new SVG('rect')
	.attr('fill', 'red')
	.attr('width', '10')
	.attr('height', '10')
	.attr('x', '10')
	.attr('y', '10')
	.append(new_svg);

let polyline = new SVG('polyline')
	.attr('points', '0 5, 10 15, 20 25, 30 35, 40 45, 50 55, 60 65, 70 75, 80 85, 90 95, 100 105')
	.attr('stroke', 'red')
	.append(new_svg);

let polygon = new SVG('polygon')
	.attr('points', "50 160, 55 180, 70 180, 60 190, 65 205, 50 195, 35 205, 40 190, 30 180, 45 180")
	.attr('stroke', 'green')
	.append(new_svg);


/*let svgData = new SVGData('svg');
transposed = svgData.transpose(a,b);
let strung = svgData.__stringify(transposed);*/
//console.log(strung);

//let wot = svgData.transposetest(a,b, c, d);
//console.log('yay', wot);
let another_svg = new SVG('svg')
	.attr('height', '400')
	.attr('width', '400')
	.append(container);


let dtk = new DataToolKit();

let range_1 = dtk.range(1, 200);
let range_2 = dtk.range(201, 400);






/////////////////////////////////////
let func = x => x.map(num => (Math.pow(num, 2)));
let invert = x => x.map(num => 400 - num);

let domain = dtk.range(1,100);
//domain = domain.map(x => x / 10);
let range = dtk.range(101,200);
domain = invert(domain);
range = invert(range);
domain = dtk.range(1,100);

console.log(range);


let hope = new SVGData('polyline')
	.data(domain, range)
	.attr('stroke', 'green')
	.append(another_svg);


///////////////////////////

let input = document.querySelector('test-input');
let output = document.createElement('div');

container.appendChild(output);

output.innerHTML = 'hey';

