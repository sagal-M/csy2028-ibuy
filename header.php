<?php
$host = "localhost";
  $username = "root";
  $password = "";
  $dbname = "as1";

  $conn = mysqli_connect($host, $username, $password, $dbname);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql ="SELECT * FROM categories";
  $result= mysqli_query($conn, $sql);
  ?>

/// cited from https://stackoverflow.com/questions/35442173/how-to-display-products-under-category-in-sql-in-a-table


<!DOCTYPE html>
<html>
	<head>
		<title>ibuy Auctions</title>
		<link rel="stylesheet" href="ibuy.css" />
	</head>

	<body>
		<header>
			<h1><span class="i">i</span><span class="b">b</span><span class="u">u</span><span class="y">y</span></h1>

			<form action="#">
				<input type="text" name="search" placeholder="Search for anything" />
				<input type="submit" name="submit" value="Search" />
			</form>
		</header>

		<nav>
			<ul>
        <?php
				
        while ($row = mysqli_fetch_assoc($result)) {
            $categoryID = $row['category_id'];
            echo '<li><a class="categoryLink" href="category.php?category_id=' . $categoryID . '">' . $row['name'] . '</a></li>';

        }
		/// cited from https://stackoverflow.com/questions/35442173/how-to-display-products-under-category-in-sql-in-a-table
        ?>
			</ul>
		</nav>
		</div>
		
		<button>Users</button>
		<div class="user options">
			
			<a href="addAuction.php">Add auction</a>
			<a href="deleteauction.php">Delete auction</a>
			<a href="
			<a href="register.php">Register</a>
			<a href="login.php">login</a>
			<a href="logout.php">logout</a>
		</div>
	</div>
	
		<button>Admin</button>
		<div class="admin options">
			<a href="adminCategory.php">Show-Categories</a>
			<a href="addCategories.php">Delete-Categories</a>
			<a href="addCategories.php">Add-Categories</a>
			<a href="logout.php">logout</a>
		</div>
		</div>




		</div>
		</div>
		<img src="banners/1.jpg" alt="Banner" />