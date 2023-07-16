<?php
session_start();



include 'header.php';
include_once 'conn.php';


if (isset($_GET['categoryID'])) {
    $categoryID = $_GET['categoryID'];


    $stmt = $pdo->prepare("SELECT * FROM categories WHERE category_id = ?");
    $stmt->execute([$categoryID]);
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($category) {
        $originalName = $category['name'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];

            $stmt = $pdo->prepare("UPDATE categories SET name = ? WHERE category_id = ?");
            $stmt->execute([$name, $categoryID]);

            
            header('Location: admincategory.php');
            exit();
        }
    } else {
        
    }
} else {
    
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>
</head>
<body>
   
    <h2>Edit Category</h2>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] . '?categoryID=' . $categoryID; ?>">
        <label for="name">Category Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $originalName; ?>" required><br><br>
        
        <input type="submit" value="Update Category">
    </form>
</body>
</html>
<?php
include 'footer.php';
?>