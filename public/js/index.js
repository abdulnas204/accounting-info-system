var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
// var Months = [
//         'January',
//         'February',
//         'March',
//         'April',
//         'May',
//         'June',
//         'July',
//         'August',
//         'September',
//         'October',
//         'November',
//         'December'
//     ];
var config = {
    type: 'bar',
    data: {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
            label: "Revenues",
            backgroundColor: window.chartColors.green,
            borderColor: window.chartColors.green,
            data: [21,42,34,54,31,16,31],
            fill: false,
        }, {
            label: "Expenses",
            fill: false,
            backgroundColor: window.chartColors.red,
            borderColor: window.chartColors.red,
            data: [10,15,21,34,18,4,34],
        }]
    },
    options: {
        responsive: true,
        title:{
            display:true,
            text:'Incomes and Expenses'
        },
        tooltips: {
            mode: 'index',
            intersect: false,
        },
        hover: {
            mode: 'nearest',
            intersect: true
        },
        scales: {
            xAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Month'
                }
            }],
            yAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Value'
                }
            }]
        }
    }
};

window.onload = function() {
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myLine = new Chart(ctx, config);
console.log("WTF");
};


// var colorNames = Object.keys(window.chartColors);
// document.getElementById('addDataset').addEventListener('click', function() {
//     var colorName = colorNames[config.data.datasets.length % colorNames.length];
//     var newColor = window.chartColors[colorName];
//     var newDataset = {
//         label: 'Dataset ' + config.data.datasets.length,
//         backgroundColor: newColor,
//         borderColor: newColor,
//         data: [],
//         fill: false
//     };

//     for (var index = 0; index < config.data.labels.length; ++index) {
//         newDataset.data.push(randomScalingFactor());
//     }

//     config.data.datasets.push(newDataset);
//     window.myLine.update();
// });

// document.getElementById('addData').addEventListener('click', function() {
//     if (config.data.datasets.length > 0) {
//         var month = MONTHS[config.data.labels.length % MONTHS.length];
//         config.data.labels.push(month);

//         config.data.datasets.forEach(function(dataset) {
//             dataset.data.push(randomScalingFactor());
//         });

//         window.myLine.update();
//     }
// });

// document.getElementById('removeDataset').addEventListener('click', function() {
//     config.data.datasets.splice(0, 1);
//     window.myLine.update();
// });

// document.getElementById('removeData').addEventListener('click', function() {
//     config.data.labels.splice(-1, 1); // remove the label first

//     config.data.datasets.forEach(function(dataset, datasetIndex) {
//         dataset.data.pop();
//     });

//     window.myLine.update();
// });