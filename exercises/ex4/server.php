<!DOCTYPE html>
<html>
    <body>
        <h1>Youre result:</h1>
        <br/>
        <?php
            $times = intval($_GET["number"]);
            $color = $_GET["color"];

            for ($i = 0; $i < $times; $i++) {
                echo $color . "<br>";
            }
        ?>

    </body>
</html>