<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Estadisticos</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <?php $dept = $_POST["dept"];
        $jsonResponse = file_get_contents("https://www.datos.gov.co/resource/ji8i-4anb.json?\$select=departamento&\$where=c_digo_departamento=".$dept);
        $data = json_decode($jsonResponse, true);
    ?>
    <style>
        #columnchart_material, #chart_div, #curve_chart{
            width: 75%;
            height: 500px;
            margin: auto;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">INICIO</a></li>
                <li><a href="departamentos.html" class="active">DEPARTAMENTOS</a></li>
                <li><a href="info_nacional.php">INFO. NACIONAL</a></li>
                <li><a href="contacto.html">CONTACTO</a></li>
            </ul>
        </nav>
        
    </header>

    <h1>Información de <?php echo $data[0]["departamento"]; ?></h1>

    <div id="columnchart_material"></div>
    <br><hr>
    <div id="curve_chart"></div>
    <br><hr>
    <div id="chart_div"></div>

    <script type="text/javascript">var dept = <?php echo $dept; ?>;</script>
    <script src="graphics.js"></script>
</body>
</html>