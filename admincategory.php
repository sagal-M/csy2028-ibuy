<?php
session_start();
include 'header.php';
include_once 'conn.php';



if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}

 
    $query = $pdo->query("SELECT * FROM categories");
    $categories = $query->fetchAll(PDO::FETCH_ASSOC);

    if (count($categories) > 0) {
        echo "<ul>";
        foreach ($categories as $category) {
            $categoryName = $category['name'];
            $categoryID = $category['category_id'];

            echo "<li>$categoryName</li>";
            echo "<a href='addCategory.php?categoryID=$categoryID'>Add</a> /  ";
            echo "<a href='editCategory.php?categoryID=$categoryID'>Edit</a> / ";
            echo "<a href='deleteCategory.php?categoryID=$categoryID'>Delete</a>";
        }
        echo "</ul>";
    }
    include 'footer.php';
    ?>
