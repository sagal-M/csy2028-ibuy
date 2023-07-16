<?php
session_start();

include 'header.php';
include_once 'conn.php';


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];

    
    $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->execute([$name]);


    header('Location: admincategory.php');
    exit();
}

// cited from https://www.youtube.com/watch?v=HhzLpTLu08w
include 'footer.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
</head>
<body>
    
    <h2>Add New Category</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="name">Category Name:</label>
        <input type="text" name="name" id="name" required><br><br>
        
        <input type="submit" value="Add Category">
    </form>
</body>
</html>