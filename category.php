<?php
include 'conn.php';
include 'header.php';

session_start();



if (isset($_GET['category_id'])) {
    $categoryID = $_GET['category_id'];
    
$CategoryNameQuery = $pdo->query("SELECT name FROM categories WHERE category_id='$categoryID'");
$categoryResult = $CategoryNameQuery->fetchAll();

foreach($categoryResult as $category) {
    $categoryName = $category['name'];
}

$ProductQuery = $pdo->query("SELECT * FROM auctions WHERE category_id='$categoryID'");
$getProduct = $ProductQuery->fetchAll();

echo "<h1>Category Listing</h1>";

$productCount = $ProductQuery->rowCount();

if($productCount == 0){
    echo 'There are no product ';
}else{

foreach ($getProduct as $Product){

    $PName = $Product['title'];
    $PCategory = $Product['category_id'];
    $PDescription = $Product['description'];
    $PPrice = $Product['price'];
    $PID = $Product['auction_id'];

    echo '<ul class="productList">
    <li>

    <img src="product.png" alt="product name">.
    <article>
        <h2>'.$PName.'</h2>
        <h3>Category : '.$PCategory.'</h3>
        <p>'.$PDescription.'</p>

        <p class="price">Current bid: £'.$PPrice.'</p>
        <a href=Auction.php?productID='.$PID .' class="more auctionLink"> More &gt;&gt;</a>
</article>
<li>
</ul>';


    }
    

}
}
include 'footer.php';
?>