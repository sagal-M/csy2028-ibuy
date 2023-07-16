<?php
session_start();

require 'header.php';

if (isset($_SESSION['username'])) {
    include_once('conn.php');
    $productID = isset($_GET['productID']) ? $_GET['productID'] : null;

    if ($productID !== 0) {
      
        $BidQuery = $pdo->prepare("SELECT * FROM `auctions` WHERE auction_id = ?");
        $BidQuery->execute([$productID]);
        $bidInfoResult = $BidQuery->fetchAll();

        if (count($bidInfoResult) > 0) {
            foreach ($bidInfoResult as $results) {
                $name = $results['title'];

                
                $category = isset($results['category_Id']) ? $results['category_Id'] : 'NO';

                $price = $results['price'];
                $description = $results['description'];
                $userID = $results['user_id'];
            }

            $Username =  $pdo->prepare("SELECT * FROM `users` WHERE id = ?");
            $Username->execute([$userID]);
            $nameResult = $Username->fetchAll();

            foreach ($nameResult as $values) {
                $username = $values['name'];
                $sellerID = $values['id'];
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
                $bidPrice = $_POST['bid'];

                if ($bidPrice > $price) {
                    $updatePriceQuery = $pdo->prepare("UPDATE `auctions` SET `price` = ? WHERE auction_id = ?");
                    $updatePriceQuery->execute([$bidPrice, $productID]);
                }

                
                header('Location: Auction.php?productID=' . $productID);
                exit();
            }
        } else {
            die('Product not found.');
        }
    } else {
        die('Product ID not specified.');
    }
} else {
    echo 'You are not logged in <a href="login.php"><button>Login Now!</button></a>';
}
?>


<h1>Product Page</h1>
<article class="product">
    <img src="product.png" alt="product name">
    <section class="details">
        <h2><?php echo $name; ?></h2>
        <h3>Product category: <?php echo $category; ?></h3>
        <p>Auction created by <a href="#"><?php echo $username; ?></a></p>
        <p class="price">Current bid: £ <?php echo $price; ?></p>
        <time>Time left: 8 hours 3 minutes</time>
        <form action="#" method="POST" class="bid">
            <input type="text" name="bid" placeholder="Enter bid amount" />
            <input type="submit" name="submit" value="Place bid" />
        </form>
    </section>
    <section class="description">
        <p>Product Description: <?php echo $description; ?></p>
    </section>

   
    <section class="reviews">
        <h2>Reviews of <?php echo $username; ?></h2>
        <ul>
           
        </ul>
        <form action="#" method="POST">
            <label for="reviewtext">Add your review</label>
            <textarea name="reviewtext"></textarea>
            <input type="submit" name="submit1" value="Add Review" />
        </form>
    </section>
</article>
<?php
include 'footer.php';
?>