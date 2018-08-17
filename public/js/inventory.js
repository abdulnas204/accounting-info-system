let listener = function(response) {
    let date_input = $('input#date')[0];
    date_input.value = `${response[1]}/${response[2]}/${response[0]}`;
}
let due_date_listener = (response) => {
    let due_date_input = $('input#due_date')[0];
    due_date_input.value = `${response[1]}/${response[2]}/${response[0]}`;
}

let inventory_preview_args = [
    {inventory_id: "inventory_id"}, 
    {inventory_name: 'name'}, 
    {description: 'description'},
];
let inventory = new InventoryPreview(inventory_preview_args);
inventory.attachEvents();

let vendor = new VendorPreview([{vendor_id: 'vendor_id'}, {vendor_name: 'name'}]);
vendor.attachEvents();
    
let date_input = $('span.fake-button.show-calendar')[0];
let calendar = new Calendar(listener, 1);
calendar.listen(date_input, 'click');

let due_date_input = $('span.fake-button.show-calendar')[1];
let due_date_calendar = new Calendar(due_date_listener, 2);
due_date_calendar.listen(due_date_input, 'click');
// calendar.listenForClose(date_input, 'blur');
