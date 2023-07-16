<?php
session_start();
require 'header.php';
include_once 'conn.php';

if (isset($_SESSION['username'])) {
    
  

    if (isset($_POST['submit1'])) {
        $name = $_POST['productName'];
        $description = $_POST['productDesc'];
        $date = $_POST['date'];
        $categoryID = $_POST['categories'];
        $price = $_POST['price'];
        $userID = $_SESSION['userID'];

        try {
            
            $result = $pdo->prepare("INSERT INTO `auctions` (`title`, `endDate`, `description`, `category_id`, `price`, `user_id`) VALUES (?, ?, ?, ?, ?, ?)");
            $result->execute([$name, $date, $description, $categoryID, $price, $userID]);
            echo "Auction added!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Auction</title>
</head>
<body>
    <main>
        <h1>Add Auction</h1>
        <form action="#" method="POST">
            <label for="productName">Product name</label>
            <input type="text" name="productName" required><br>

            <label for="productDesc">Description</label>
            <textarea name="productDesc" id="desc" cols="10" rows="6" maxlength="255" required></textarea>

            <label for="date">Date</label>
            <input type="date" name="date" required><br>

            <label for="price">Price</label>
            <input type="text" name="price" required><br>

            <label for="categories">Category</label>
            <select name="categories">
                <?php
                
                $getCategory = $pdo->query("SELECT * FROM `categories`");
                $categories = $getCategory->fetchAll();
                foreach ($categories as $category) {
                    $categoryID = $category['category_id']; 
                    $categoryName = $category['name'];
                    echo '<option value="' . $categoryID . '">' . $categoryName . '</option>'; 
                }

        // cited from https://www.youtube.com/watch?v=d9AMuoMkXiU
                ?>

        
            </select><br>

            <button type="submit" value="submit" name="submit1">Submit</button>
        </form>
    </main>
</body>
</html>

<?php
} else {
    echo 'You are not logged in <a href="login.php"><button>Login Now!</button></a>';
}
include 'footer.php';
?>
