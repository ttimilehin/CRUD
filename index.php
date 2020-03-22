<?php

include 'config/db_connect.php';

$sql = 'select * from pizzas';

$result = mysqli_query($conn, $sql);

$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);

mysqli_close($conn);

include 'templates/header.php';

?>
<div class='container'>
    <div class='row'>

        <?php

        foreach ($pizzas as $pizza) {
            ?>



            <div class="card" style="width: 18rem; height: 13rem; padding: 10px; margin: auto; margin-bottom: 2%;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($pizza['title']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($pizza['ingredients']); ?></p>
                    <a href="details.php?id=<?php echo $pizza['id']; ?>" class="btn btn-primary">More Info</a>
                </div>
            </div>

        <?php
        } ?>

    </div>

</div>


<?php
include 'templates/footer.php';
?>