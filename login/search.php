<?php 
session_start();

	include("connection.php");
	include("functions.php");

    //redirection to log in
	$user_data = check_login($con);

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="indexCSS.css">
    <title>My website</title>
</head>
<body>
    <div>
        <a id="logo" href="logout.php"><img src="logout_logo.png" style="margin-left:90vw; margin-top:1vw"></a>
        <a id="logo" href="users.html"><img src="dollar_logo.png"></a>
    </div>
    <header>
        <form id="form" method="Post">
            <input name="search" type = "text" placeholder="What film are you looking for?" id="search" class="search">
            <button id="search_logo_button" type="submit" name="submit-search"><img id="search_logo" src="search_logo.png"></button>
        </form>
    </header>
    <div  class="filters">
        <a id="link" href="index.php">All</a>
        <a id="link" href="indexRating.php">Best Rated</a>
        <a id="link" href="indexGenre.php">Genre</a>
    </div>
  
    <main id="main">
        <?php 
        
            if (isset($_POST['submit-search'])) {
                //making sure teh data is safe
                $search = mysqli_real_escape_string($con, $_POST['search']);
                $query = "select * from films where title like '%$search%'";
                $result = mysqli_query($con, $query);
                $queryResult = mysqli_num_rows($result);
                if ($queryResult > 0) {
                    while($data = mysqli_fetch_assoc($result)){
                        ?>
                        <div class="movie">
                            <?php 
                            echo "<img src='{$data['image']}' width='40%'>";
                            ?>
                            <div class="movie-info">
                                <h3> 
                                    <?php 
                                    echo  $data['title'];
                                    ?>
                                </h3>
                                <span class="green"> 
                                    <?php 
                                        echo  $data['rating'];
                                    ?>
                                </span>
                                <div class="overview">
                                    <?php
                                        echo  $data['description'];
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php 
                    }
                
                }else {
                    echo "There were no results matching your result";
                }

            }
            
            ?>
    </main>
</body>
</html>
