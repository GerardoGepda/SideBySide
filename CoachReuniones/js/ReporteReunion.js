google.charts.load('current');
    google.charts.setOnLoadCallback(drawVisualization);
    

    function maquetar(cantidad){
        let template = ''
        for (let index = 0; index < array.length; index++) {
            
            
        }
    }

    function drawVisualization() {
        var wrapper = new google.visualization.ChartWrapper({
            chartType: 'ColumnChart',
            dataTable: [
                ['', 'Incritos', 'Faltantes'],
                ['', 20, 10]
            ],
            options: {
                'title': 'UB'
            },
            containerId: 'UDB'
        });
        wrapper.draw();
    }

    
    