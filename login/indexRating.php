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
        <form id="form" action="searchRating.php" method="Post">
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
            $query = "select * from films where rating > 7 order by rating desc";
            $result = mysqli_query($con, $query);
            while($data = mysqli_fetch_assoc($result)){
                ?>
                <div  class="movie">
                    <form id="form" action="trailerDisplay.php" method="Post">
                        <input id="input" value="<?php echo $data['title'];?>" type = "hidden" name="trailer">
                        <button type="submit" name="submit-trailer"> <?php 
                    echo "<img src='{$data['image']}' width='40%'>";
                    ?></button>
                    </form>
                   
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
        ?>
    </main>
</body>
</html>
