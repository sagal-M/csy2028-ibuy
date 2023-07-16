<?php
session_start();
require 'header.php';   



if (isset($_SESSION['username'])) {
    $userID = $_SESSION['userID'];
        include_once('conn.php');
        $getAuctionQuery = $pdo->query("SELECT  `auction_id`,`title`, `endDate`, `description`, `category_Id`, `price` FROM `auctions` WHERE user_id = '$userID'");
        $getAuctionQuery->execute();
        $getAuction = $getAuctionQuery->fetchAll();

        echo '<strong>Auctions Posted by : '. $_SESSION['username'].'</strong>';
        foreach ($getAuction as $auctions) {
            // getting auction data from database
            $auctionName = $auctions['title'];
            $productID = $auctions['product_id'];
            $strHTML = '<li>' . $auctionName . '</li><a href=editAuction.php?productID=' . $productID . '>edit</a>';
            echo $strHTML;
        }
    
} else {
    echo 'You are not logged in <a href="login.php"><button>Login Now!</button></a>';
}