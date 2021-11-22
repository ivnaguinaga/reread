<!DOCTYPE html>
<html lang="en">

<head>
    <title>Re-Read ebooks</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="icon" href="../img/icon.png">

</head>

<body>

    <div class="logo">
        <h1>Re-Read</h1>
    </div>

    <div class="header">
        <h1>Re-Read</h1>
        <p>En Re-Read podrás encontrar libros de segunda mano en perfecto estado. También vender los tuyos. Porque siempre hay libros leídos y libros por leer. Por eso Re-compramos y Re-vendemos para que nunca te quedes sin ninguno de los dos.</p>
    </div>

    <div class="row">
        <div class="column middle">
            <div class="topnav">
                <a href="index.php">Re-Read</a>
                <a href="libros.php">Libros</a>
                <a href="ebooks.php" class="active">eBooks</a>
            </div>
            <div class="textpage">
                <h3>Toda la actualidad en eBook</h3>
                <div>
                    <form action="ebooks.php" method="post">
                        <input type="text" placeholder="Introduce el autor..." name="autor">
                        <?php
                        include '../services/connection.php';
                        $txt_pais="SELECT DISTINCT Country FROM authors";
                        $qry_pais=mysqli_query($conn,$txt_pais);
                            echo "<select name='pais'>";
                                echo "<option value='%%'>Todos los paises</option>";
                                while($fila = mysqli_fetch_array($qry_pais)){
                                    echo "<option value='".$fila['0']."'>".$fila['0']."</option>";
                                }
                            echo "</select>";
                        ?>
                        <input type="submit" value="filtrar" name="filtrar">
                    </form>
                
                </div>
                <!--<div class="gallery">
                    <img src="../img/cell.jpeg" alt="Cell">
                    <div class="desc">A través de los teléfonos móviles se envía un mensaje que convierte a todos en esclavos asesinos...</div>
                </div>

                <div class="gallery">
                    <img src="../img/elciclodelhombrelobo.jpeg" alt="El ciclo del hombre lobo">
                    <div class="desc">Una escalofriante revisión del mito del hombre lobo por el rey de la literatura de terror...</div>
                </div>

                <div class="gallery">
                    <img src="../img/elresplandor.jpeg" alt="El resplandor">
                    <div class="desc">Esa es la palabra que Danny había visto en el espejo. Y, aunque no sabía leer, entendió que era un mensaje de horror...</div>
                </div>

                <div class="gallery clear">
                    <img src="../img/doctorsleep.jpeg" alt="doctorsleep">
                    <div class="desc">Una novela que entusiasmará a los millones de lectores de El resplandor y que encantará...</div>
                </div>
                
                <div class="gallery">
                    <img src="../img/mientrasescribo.jpeg" alt="Mientras escribo">
                    <div class="desc">Pocas veces un libro sobre el oficio de escribir ha resultado tan clarificador, útil y revelador.</div>
                </div>-->
                <?php
                
                include '../services/connection.php';
                    if(isset($_POST['filtrar'])){
                        $autor=$_POST['autor'];
                        $pais=$_POST['pais'];
                            $txt_filtroautor="SELECT books.Title,books.Description,books.img 
                            FROM books 
                            INNER JOIN booksauthors ON books.Id=booksauthors.BookId 
                            INNER JOIN authors ON booksauthors.AuthorId=authors.Id
                            WHERE authors.Name like '%{$autor}%' and authors.Country like '%{$pais}%';";
                            $qry_filtroautor=mysqli_query($conn,$txt_filtroautor);
                            if (!empty($autor) && mysqli_num_rows($qry_filtroautor) > 0){
                                $contador=2;
                                while ($filtroautor = mysqli_fetch_array($qry_filtroautor)) {
                                    if ($contador==3) {
                                        echo "<div class='gallery clear'>";
                                        echo "<img src=../img/{$filtroautor['img']}>";
                                        echo "<div class='desc'>{$filtroautor['Description']}</div>";
                                        echo "</div>";
                                        $contador=$contador-2;
                                    }else{
                                        echo "<div class='gallery'>";
                                        echo "<img src=../img/{$filtroautor['img']}>";
                                        echo "<div class='desc'>{$filtroautor['Description']}</div>";
                                        echo "</div>";
                                        $contador++;
                                    }
                                }
                            }elseif(!empty($pais) && mysqli_num_rows($qry_filtroautor) > 0){
                                $contador=2;
                                while ($filtroautor = mysqli_fetch_array($qry_filtroautor)) {
                                    if ($contador==3) {
                                        echo "<div class='gallery clear'>";
                                        echo "<img src=../img/{$filtroautor['img']}>";
                                        echo "<div class='desc'>{$filtroautor['Description']}</div>";
                                        echo "</div>";
                                        $contador=$contador-2;
                                    }else{
                                        echo "<div class='gallery'>";
                                        echo "<img src=../img/{$filtroautor['img']}>";
                                        echo "<div class='desc'>{$filtroautor['Description']}</div>";
                                        echo "</div>";
                                        $contador++;
                                    }
                                }
                            }
                    }else{
                        $libros=mysqli_query($conn,"SELECT * FROM Books");
                            // datos de salida de cada fila (fila = row)
                            $contador=2;
                                while ($row = mysqli_fetch_array($libros)) {
                                    if ($contador==3) {
                                        echo "<div class='gallery clear'>";
                                        echo "<img src=../img/{$row['img']}>";
                                        echo "<div class='desc'>{$row['Description']}</div>";
                                        echo "</div>";
                                        $contador=$contador-2;
                                    }else{
                                        echo "<div class='gallery'>";
                                        echo "<img src=../img/{$row['img']}>";
                                        echo "<div class='desc'>{$row['Description']}</div>";
                                        echo "</div>";
                                        $contador++;
                                    }
                                }
                            }
                    
                
                
                ?>
            </div>
        </div>
        <div class="column side">
            <h2>Top ventas</h2>
            <?php
                // 1. Conexión con la base de datos	
                include '../services/connection.php';

                // 2. Selección y muestra de datos de la base de datos
                $result = mysqli_query($conn, "SELECT Books.Title FROM Books WHERE eBook != '0'");

                if (!empty($result) && mysqli_num_rows($result) > 0) {
                // datos de salida de cada fila (fila = row)
                    while ($row = mysqli_fetch_array($result)) {
                    echo "<p>".$row['Title']."</p>";
                    }
                } else {
                    echo "0 resultados";
                }
                ?>
        </div>
    </div>

</body>

</html>