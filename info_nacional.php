<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Estadisticos</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        #columnchart_material, #chart_div, #curve_chart{
            width: 75%;
            height: 500px;
            margin: auto;
            padding-top: 20px;
        }
        /* Styling the table */
        table {
          width: 80%;
          margin: auto;
          border-collapse: collapse;
        }

        /* Styling the table header */
        th {
          background-color: #1567d1;
          color: #fff;
          font-weight: bold;
          padding: 8px;
          border: 1px solid #ccc;
        }

        /* Styling the table cells */
        td {
          padding: 8px;
          border: 1px solid #ccc;
        }

        /* Alternating row colors */
        tr:nth-child(even) {
          background-color: #f9f9f9;
        }
    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>var dept = 0;</script>
    <script src="graphics.js"></script>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">INICIO</a></li>
                <li><a href="departamentos.html">DEPARTAMENTOS</a></li>
                <li><a href="info_nacional.php" class="active">INFO. NACIONAL</a></li>
                <li><a href="contacto.html">CONTACTO</a></li>
            </ul>
        </nav>
    </header>

    <!-- Resto del contenido de la página -->
    <h1>Información Nacional</h1>
    <br><hr>
    <div id="columnchart_material" style="width: 75%; height: 500px; margin: auto; padding-top: 20px;"></div>
    <br><hr>
    <div id="curve_chart" style="width: 75%; height: 500px; margin: auto;"></div>
    <br><hr>
    <div id="chart_div" style="width: 75%; height: 500px; margin: auto; padding-top: 20px;"></div>
    <br><hr>
    <?php
        function promedios($array) {
            $result = [];
            $cont = 0; $ppob = 0; $pmat = 0; $pcob = 0; $pdes = 0;
            for ($i = 0; $i < count($array); $i++) {
                if ($array[$i]["tasa_matriculacion_5_16"] < 1.0) {
                    $array[$i]["tasa_matriculacion_5_16"] *= 100;
                }
                
                if ($array[$i]["desercion"] < 1.0) {
                    $array[$i]["desercion"] *= 100;
                }
                
                if ($array[$i]["cobertura_neta"] < 1.0) {
                    $array[$i]["cobertura_neta"] *= 100;
                }
                
                $ppob += $array[$i]["poblacion_5_16"];
                $pmat += $array[$i]["tasa_matriculacion_5_16"];
                $pcob += $array[$i]["cobertura_neta"];
                $pdes += $array[$i]["desercion"];
                $cont++;
                if ($cont == 11) {
                    array_push($result, [$array[$i]["c_digo_departamento"], $array[$i]["departamento"], round(($ppob/11), 2), round(($pmat/11), 2), round(($pcob/11), 2), round(($pdes/11), 2)]);
                    $cont = 0; $ppob = 0; $pmat = 0; $pcob = 0; $pdes = 0;
                }
            }
            return $result;
        }
        
        $apiUrl = 'https://www.datos.gov.co/resource/ji8i-4anb.json?$select=ano,c_digo_departamento,departamento,poblacion_5_16,tasa_matriculacion_5_16,cobertura_neta,desercion&$where=c_digo_departamento!=0&$order=c_digo_departamento%20ASC';
        $jsonResponse = file_get_contents($apiUrl);
        $data = json_decode($jsonResponse, true);
        $education = promedios($data);
        echo "<h1> Datos Promedio de todos los años por Departamento </h1>";
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th> Código Dept. </th>";
        echo "<th> Departamento </th>";
        echo "<th> Problacion entre 5 y 16 </th>";
        echo "<th> Tasa de matricula </th>";
        echo "<th> Tasa de cobertura </th>";
        echo "<th> Tasa de deserción </th>";
        echo "</tr>";
        foreach ($education as $education) {
            echo "<tr>";
            echo "<td>" . $education[0] . "</td>";
            echo "<td>" . $education[1] . "</td>";
            echo "<td>" . $education[2] . "</td>";
            echo "<td>" . $education[3] . "</td>";
            echo "<td>" . $education[4] . "</td>";
            echo "<td>" . $education[5] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    ?>
</body>
</html>