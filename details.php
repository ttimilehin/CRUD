<?php

include 'config/db_connect.php';

if (isset($_POST['delete'])) {

    $id_delete = mysqli_real_escape_string($conn, $_POST['id_delete']);
    $sql = " DELETE from pizzas where id = $id_delete";

    if(mysqli_query($conn, $sql)) {
        header('location: index.php');
    } else{
        echo 'query error:' . mysqli_error($conn);
    }
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT * from pizzas where id = $id";

    $result = mysqli_query($conn, $sql);

    $pizza = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($conn);

}
include 'templates/header.php';

?>

<div class="container center">
    <?php if ($pizza) : ?>
        <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
        <p>Created by:<?php echo htmlspecialchars($pizza['email']); ?></p>
        <p><?php echo htmlspecialchars($pizza['created_at']); ?></p>
        <h5>Ingredients: </h5>
        <p><?php echo htmlspecialchars($pizza['ingredients']); ?></p>

        <!-- DELETE -->

        <form action="details.php" method="POST">
            <input type="hidden" name="id_delete" value="<?php echo $pizza['id']; ?>">
            <input type="submit" name="delete" value="Delete" class="btn btn-success">
        </form>

    <?php else : ?>
        <h5>No such pizza In our database</h5>
    <?php endif; ?>

</div>

<?php
include 'templates/footer.php';
?>