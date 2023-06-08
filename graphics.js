var responseData; // Variable to store the data
var API_URL = 'https://www.datos.gov.co/resource/ji8i-4anb.json?$select=ano,c_digo_departamento,departamento,poblacion_5_16,tasa_matriculacion_5_16,cobertura_neta,desercion&$where=c_digo_departamento='+dept+'&$order=ano%20ASC';

fetch(API_URL)
.then(response => response.json())
.then(data => {
    // Process and utilize the retrieved data here
    responseData = data; // Assign the data to the variable
    console.log(responseData);

    drawChart1();
    drawChart2();
    drawChart3();
})
.catch(error => {
    // Handle any errors that occur during the request
    console.error('Error:', error);
});

function extract_all(array) {
    var result = [];
    result.push(['Año', 'Código Departamento', 'Departamento', 'Población', 'Matriculados', 'Cobertura Neta', 'Deserción']);
    for (var i = 0; i < array.length; i++) {
        var matriculados = ceil(array[i]["poblacion_5_16"] * array[i]["tasa_matriculacion_5_16"]);
        result.push([array[i]["ano"], array[i]["c_digo_departamento"], array[i]["departamento"], array[i]["poblacion_5_16"], matriculados, array[i]["cobertura_neta"], array[i]["desercion"]]);
    }
    return result;
}

function extract_graphic1(array) {
    var result = [['Año', 'Matriculados', 'Población Total']];
    for (var i = 0; i < array.length; i++) {
        var matriculados = array[i]["poblacion_5_16"] * array[i]["tasa_matriculacion_5_16"]
        if (array[i]["tasa_matriculacion_5_16"] > 1.0) {
            matriculados = matriculados / 100;
        }
        matriculados = Math.ceil(matriculados);
        result.push([array[i]["ano"], matriculados, parseFloat(array[i]["poblacion_5_16"])]);
    }
    console.log(result);
    return result;
}

function extract_graphic2(array) {
    var result = [['Año', '% Matriculación', '% Deserción']];
    for (var i = 0; i < array.length; i++) {
        if (array[i]["tasa_matriculacion_5_16"] < 1.0) {
            array[i]["tasa_matriculacion_5_16"] = array[i]["tasa_matriculacion_5_16"] * 100;
        }
        if (array[i]["desercion"] < 1.0) {
            array[i]["desercion"] = array[i]["desercion"] * 100;
        }
        result.push([array[i]["ano"], parseFloat(array[i]["tasa_matriculacion_5_16"]), parseFloat(array[i]["desercion"])]);
    }
    console.log(result);
    return result;
}

function extract_graphic3(array) {
    var result = [['Año', '% Cobertura Neta']];
    for (var i = 0; i < array.length; i++) {
        if (array[i]["cobertura_neta"] < 1.0) {
            array[i]["cobertura_neta"] = array[i]["cobertura_neta"] * 100;
        }
        result.push([array[i]["ano"], parseFloat(array[i]["cobertura_neta"])]);
    }
    return result;
}

google.charts.load('current', {'packages':['bar']});
//google.charts.setOnLoadCallback(drawChart1);

function drawChart1() {
    var data = google.visualization.arrayToDataTable(extract_graphic1(responseData));

    var options = {
        chart: {
            title: 'Población Total y Matriculados',
            subtitle: 'Datos Población Total y Matriculados por Año: 2011-2021',
        },
        bars: 'vertical',
        vAxis: {format: 'decimal'},
        colors: ['#d95f02', '#7570b3']
        };

    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
}

google.charts.load('current', {'packages':['corechart']});
//google.charts.setOnLoadCallback(drawChart2);

function drawChart2() {
    var data = google.visualization.arrayToDataTable(extract_graphic2(responseData));

    var options = {
        title: 'Tasa de Matriculación y Deserción',
        curveType: 'function',
        legend: { position: 'bottom' }
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

    chart.draw(data, options);
}

google.charts.load('current', {'packages':['bar']});
//google.charts.setOnLoadCallback(drawChart3);

function drawChart3() {
    var data = google.visualization.arrayToDataTable(extract_graphic3(responseData));

    var options = {
        chart: {
            title: 'Cobertura Neta',
            subtitle: 'Porcentaje Cobertura Neta por Año: 2011-2021',
        },
        bars: 'vertical',
        vAxis: {format: 'decimal'},
        colors: ['#1b9e77']
    };

    var chart = new google.charts.Bar(document.getElementById('chart_div'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
}