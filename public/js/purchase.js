/*class VendorPreview
{
    constructor()
    {
        this.form_feedback = document.querySelectorAll('div.form-feedback')[0];
        this.name_input = $('input#vendor_name')[0];
        this.vendor_id_input = $('input#vendor_id')[0];
    }
    attachEvents()
    {
        let name_input = document.querySelectorAll('input#vendor_name')[0];
        name_input.addEventListener('input', this.__preview.bind(this));
    }
    __preview()
    {
        let input = event.target.value || ' ';
        let url = '/vendor/preview';
        let ajax = new AjaxRequest();
        ajax.setup('POST', url, this.__previewAjaxHandler.bind(this));

        ajax.send(input);
    }
    __previewAjaxHandler(resp)
    {
        let form_feedback = document.querySelectorAll('div.form-feedback')[0];
            resp = JSON.parse(resp);

            this.form_feedback.innerHTML = '';
            resp.forEach(function(r){
                console.log(r);
                let btn = document.createElement('button');
                btn.addEventListener('click', this.__populateFields.bind(this, btn));

                btn.classList.add('btn', 'btn-sm', 'btn-outline-info');
                this.form_feedback.appendChild(btn);

                let btn_text = `<ul>
                                    <li class="id">${r.id}</li>
                                    <li class="name">${r.name}</li>
                                    <li class="company">${r.company}</li>
                                    <li class="email">${r.email}</li>
                                    <li class="address">${r.address}</li>
                                    <li class="phone_number">${r.phone_number}</li>
                                </ul>`;
                btn.innerHTML = btn_text;
            }.bind(this));
    }
    __populateFields(btn)
    {
        let form_feedback = $('div.form-feedback')[0];
        let ul = btn.childNodes[0];

        let id = ul.querySelectorAll('li.id')[0].innerHTML;
        let name = ul.querySelectorAll('li.name')[0].innerHTML;
        let company = ul.querySelectorAll('li.company')[0].innerHTML;
        let email = ul.querySelectorAll('li.email')[0].innerHTML;
        let address = ul.querySelectorAll('li.address')[0].innerHTML;
        // let phone_number = ul.querySelectorAll('li.phone_number')[0].innerHTML;

        form_feedback.innerHTML = '';

        this.name_input.value = name;
        this.vendor_id_input.value = id;
        // this.phone_number_input.value = phone_number;
    }
}*/


let listener = function(response) {
    let date_input = $('input#date')[0];
    date_input.value = `${response[1]}/${response[2]}/${response[0]}`;
}
let due_date_listener = (response) => {
    let due_date_input = $('input#due_date')[0];
    due_date_input.value = `${response[1]}/${response[2]}/${response[0]}`;
}


let vendor = new VendorPreview([{vendor_id: 'vendor_id'}, {vendor_name: 'name'}]);
vendor.attachEvents();
    
let date_input = $('span.fake-button.show-calendar')[0];
let calendar = new Calendar(listener, 76);
calendar.listen(date_input, 'click');

let due_date_input = $('span.fake-button.show-calendar')[1];
let due_date_calendar = new Calendar(due_date_listener, 66);
due_date_calendar.listen(due_date_input, 'click');
console.log(date_input, due_date_input);


