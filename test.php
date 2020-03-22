<?php 

include 'config/db_connect.php';

$sql = 'select * from pizzas';

$result = mysqli_query($conn, $sql);

$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);

mysqli_close($conn);
?>

<?php

foreach ($pizzas as $pizza) {
    ?>

    <ul>
        <li>
            <?php echo $pizza['id'] . ' ' .$pizza['title'] . ' ' .$pizza['ingredients'] . ' ' .$pizza['email'] . ' ' .$pizza['created_at']   ?>
        </li>
    </ul>

<?php 
} ?>

