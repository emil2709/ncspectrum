/**
 * Dashboard Diagram / Statistics
 *
 * This JavaScript Sheet contains the code for the Dashboard PieChart.
 */

Highcharts.chart('piechart', {

chart: {
    type: 'pie',
    options3d: {
        enabled: true,
        alpha: 45
    }
},
title: {
    text: 'NC-Spectrum'
},
subtitle: {
    text: 'Guests, Employees and Administrators'
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
        ['Guests', guests],
        ['Employees', employees],
        ['Administrators', admins],
    ]
  }],
colors : ['#00adef', '#c5e837', '#55c43b'],
credits: { enabled: false },
exporting: { enabled: false },

});