
<?php
include 'header.php';
include_once 'conn.php';

?>

<?php



		$ProductQuery = $pdo->query("SELECT * FROM auctions ORDER BY endDate ASC LIMIT 10;");
    $ProductQuery->execute();
    $Products = $ProductQuery->fetchAll();
    
    echo "<h1>Latest Listing</h1>";

    $Count = $ProductQuery->rowCount();

    if(empty($Products)) {
      echo 'No Products';
      
    }else{

    echo '<ul class="productList">';
      foreach ($Products as $Product){
        $Pname = $Product['title'];
        $Pcategory = $Product['category_id'];
        $Pdescription = $Product['description'];
        $Pprice = $Product['price'];
        $Pid = $Product['auction_id'];
       

        
        echo '<li>';
        echo '<img src="product.png" alt="product name">';

        echo '<h2>'.$Pname.' </h2>';
        echo '<h3>Category: '.$Pcategory.'</3>';
        echo '<p>'.$Pdescription.'</p>';
        echo '<p class="price">Current bid: £ '.$Pprice.'</p>';
        echo '<a href=bidAuction.php?productID='.$Pid .' class="more auctionLink"> More &gt;&gt;</a>';
        echo '</li>';
        echo '</ul>';

      }
    }
    include 'footer.php';
    ?>
