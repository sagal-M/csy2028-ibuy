<?php
session_start();



include_once 'conn.php';

if (isset($_GET['categoryID'])) {
    $categoryID = $_GET['categoryID'];

  
    $stmt = $pdo->prepare("DELETE FROM categories WHERE category_id = ?");
    $stmt->execute([$categoryID]);

    
    header('Location: admincategory.php');
    exit();
} else {
  
}

// cited from https://www.youtube.com/watch?v=HhzLpTLu08w
include 'footer.php';


?>
