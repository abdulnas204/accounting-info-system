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

class SVGData extends SVG {
	constructor(type) {
		super(type);
		this.domain;
		this.range;
		this.set;
	}
	transpose(x, y) { 
		this.set = [x.map(x => [x, y.shift()])];
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
	}
	__stringify(data) {
		//data = JSON.stringify(data);
		//data = String(data);
		let string = data.map(x => [JSON.stringify(x)]);
		console.log(data);
	}
	
}
let a = [1,2,3,4];
let b = [9,8,7,6];
let c = [19,18,17,16];
let d = [29,28,27,26];
let e = [39,38,37,36];

let test = x => y => [x.map(x => [x, y.shift()])];
//let zip = x => x.map((e, i) => [e, b[i]]);

//console.log(test(a)(b));
let container = document.querySelector('#container');

let new_svg = new SVG('svg')
	.attr('width', 200)
	.attr('height', 200)
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


let svgData = new SVGData('svg');
transposed = svgData.transpose(a,b);
svgData.__stringify(transposed);

let wot = svgData.transposetest(a,b, c, d);
console.log('yay', wot);
