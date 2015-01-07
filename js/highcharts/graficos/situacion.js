$(function () {
    // var ingresojs = '<?php echo $ingresos; ?>' ;
    //  var gastojs = '<?php echo $gastos; ?>' ;
    //  //.write("VariableJS = " + ingresojs);
  // '<?php echo $ingresos; ?>'
  //jQuery.getJSON("controllers/charts.php");
  jQuery.each(data, function(key, val)
        {
                       //Aqui viene toda la logica de que harias con estos datos
                       alert("la clave es: "+key+" y el valor es: "+val);
        });  
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Monthly Average Rainfall'
        },
        subtitle: {
            text: 'Source: WorldClimate.com'
        },
        xAxis: {
            categories: [
                'Ingresos',
                'Gastos'                
            ]
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Euros'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Ingresos',
            data: ['<?php echo $ingresos; ?>']

        }, {
            name: 'Gastos',
            data: []

        }]
    });
});
	