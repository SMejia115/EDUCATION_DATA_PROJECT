<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escolaridad en Colombia</title>
    <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <header>
        <nav>
            <ul>
                <li><a href="index.php" class="active">INICIO</a></li>
                <li><a href="departamentos.html">DEPARTAMENTOS</a></li>
                <li><a href="info_nacional.php">INFO. NACIONAL</a></li>
                <li><a href="contacto.html">CONTACTO</a></li>
            </ul>
        </nav>
        </header>
        <div class="main-section">
            <h2>Nuestro objetivo</h2>
            <p>La escolaridad infantil resulta ser un dato de suma importancia para el desarrollo de una región y se toman mediciones sobre el tema constantemente, buscando facilitar la interpretación de los datos se diseña este aplicativo web, el cual busca mostrar datos tales como una comparativa entre población infantil que se encuentra escolarizada y el total de población en un departamento. El objetivo es permitir que el usuario que utiliza este aplicativo tenga acceso a información bien fundamentada y estructurada que facilite el proceso de análisis y comprensión de un caso particular.</p>
            
            <h2>¿De dónde sacamos los datos?</h2>
            <p>Los datos de esta página los sacamos de una API proporcionada por el gobierno de Colombia en donde se encuentran datos como el total de población entre 5 y 16 años por departamento, nivel de deserción por departamento y demás datos medidos año a año desde el 2011 hasta el 2021. En el siguiente enlace se encuentra información sobre los datos utilizados, enlace a la API utilizada y documentación útil para el desarrollador: <a href="https://www.datos.gov.co/Educaci-n/MEN_ESTADISTICAS_EN_EDUCACION_EN_PREESCOLAR-B-SICA/ji8i-4anb">Enlace a la API</a>.</p>
            
            <h2>¿Qué datos mostramos?</h2>
            <p>Para cada uno de los 32 departamentos mostramos 3 gráficas:</p>
            
            <div class="graph">
                <img src="IMAGES/GRAFICA 1.png" alt="Gráfica 1">
                <p>En esta gráfica, se puede ver una relación utilizando una gráfica de barras entre la cantidad de matriculados y la población total.</p>
            </div>
            
            <div class="graph">
                <img src="IMAGES/GRÁFICA 2.png" alt="Gráfica 2">
                <p>En esta gráfica mostramos las tasas de deserción comparadas con las tasas de matriculación por departamento.</p>
            </div>
            
            <div class="graph">
                <img src="IMAGES/GRÁFICA 3.png" alt="Gráfica 3">
                <p>En esta última gráfica mostramos el porcentaje de cobertura neta, que nos muestra la proporción de la población entre 5 y 16 años que se encuentra asistiendo al sistema educativo.</p>
            </div>
        </div>
    </body>
</html>