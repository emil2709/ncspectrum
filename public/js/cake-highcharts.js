Highcharts.chart('container', {

chart: {
    type: 'pie',
    options3d: {
        enabled: true,
        alpha: 45
    }
},
title: {
    text: 'Users, employees and admins'
},
subtitle: {
    text: 'NC-Spectrum'
},
plotOptions: {
    pie: {
        innerSize: 100,
        depth: 45
    }
},
colors : ['#00adef', '#c5e837', '#55c43b'],

series: [{
    name: 'Amount',
    data: [
        ['Users', users],
        ['Employees', employees],
        ['Administrators', admins],
    ]
  }]
});