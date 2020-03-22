<?php
include 'config/db_connect.php';
include 'templates/header.php';
?>

<?php
$title = $email = $ingredients = '';
$errors = array('email' => '', 'title' => '', 'ingredients' => '');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $title = $_POST['title'];
    $ingredients = $_POST['ingredients'];

    if (empty($_POST['email'])) {
        $errors['email'] = "An email is required <br/>";
    } else {
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email must be valid email address <br/>";
        }
    }
    if (empty($_POST['title'])) {
        $errors['title'] = "A title is required <br/>";
    } else {
        
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
            $errors['title'] = "Title must be letters and spaces only";
        }
    }
    

    if (empty($_POST['ingredients'])) {
        $errors['ingredients'] = "At least one Ingredient is required <br/>";
    } else {
        
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
            $errors['ingredients'] = "Ingredients must be comma seperated list";
        }
    }

    if (array_filter($errors)) {
        
    } else {
        
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);


        $sql = "INSERT INTO pizzas(title,email,ingredients) VALUES('$title','$email','$ingredients')";

       
        if (mysqli_query($conn, $sql)) {
            
            header('location: index.php');
        } else {
            
            echo "Query Error:" . mysqli_error($conn);
        }
        

    }
}
?>

<div class="container">
<div class="col-sm-10" style="width:80%; margin-left:auto; margin-right: auto; margin-top:10%;">
        <div class="jumbotron">
            <div class="form-group">
                <p class='h1'>
                kindly fill the form below.
                </p>
                
            </div>

            <form class="form form-horizontal" action="" method="POST"  id="">
        
                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="your email" value="<?php echo htmlspecialchars($email); ?>" required>
                    <div class="red-text">
                        <!-- display errors right after the input field -->
                        <?php echo $errors['email']; ?>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="title" placeholder="Pizza Title" value="<?php echo htmlspecialchars($title); ?>" required>
                    <div class="red-text">
                        <?php echo $errors['title']; ?>
                    </div>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="ingredients" placeholder="Your Ingredients" value="<?php echo htmlspecialchars($ingredients); ?>" required>
                    <div class="red-text">
                        <?php echo $errors['ingredients']; ?>
                    </div>
                </div>
                
                
                    <button type="submit" id="submit" name="submit" class="btn btn-primary" >Submit</button>
                

            </form>

        </div>
</div>


<?php

include 'templates/footer.php';

?>