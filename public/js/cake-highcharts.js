Highcharts.chart('container', {


chart: {
    type: 'pie',
    options3d: {
        enabled: true,
        alpha: 45
    }
},
title: {
    text: 'Active users and employees registered in the system'
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
series: [{
    name: 'Amount',
    data: [
        ['Users', 33],
        ['Employees', 3],
    ]
  }]
});