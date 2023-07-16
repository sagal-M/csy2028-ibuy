<?php
session_start();
require 'header.php';
include 'conn.php';

if (isset($_SESSION['username'])) {

    

    if (isset($_POST['delete'])) {
        $auctionID = $_POST['auction_id'];

        try {
            
            $result = $pdo->prepare("DELETE FROM `auctions` WHERE `auction_id` = ?");
            $result->execute([$auctionID]);
            echo "Auction deleted successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
  // cited from https://www.youtube.com/watch?v=d9AMuoMkXiU
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Auction</title>
</head>
<body>
    <main>
        <h1>Delete Auction</h1>
        <form action="#" method="POST">
            <label for="auction_id">Auction ID</label>
            <input type="number" name="auction_id" required><br>

            <button type="submit" value="delete" name="delete">Delete</button>
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
