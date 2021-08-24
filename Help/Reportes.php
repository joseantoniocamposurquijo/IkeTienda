<?php 

function GraficaEnColumnas($titulo, $datos, $Categorias, $yAxis, $xAxis, $TipoGrafica='column'){

    $grafica = "<div id=\"GraficaEnColumnas\" style=\"width: 100%; margin: auto;\"></div>";

    $grafica .= "<script>
    
        Highcharts.chart('GraficaEnColumnas', {

            chart: {
                type: '".$TipoGrafica."',
                styledMode: true
            },

            title: {
                text: '".$titulo."'
            },

            yAxis: [{
                className: 'highcharts-color-0',
                title: {
                    text: '".$yAxis."'
                }
            }, {
                className: 'highcharts-color-1',
                opposite: true,
                title: {
                    text: '".$xAxis."'
                }
            }],

            plotOptions: {
                column: {
                    borderRadius: 5
                }
            },

            xAxis: {
                categories: [".$Categorias."]
            },

            series: [{
                data: [".$datos."],
                yAxis: 1
            }]

        });
    </script>";
    echo  $grafica;
}




 ?>