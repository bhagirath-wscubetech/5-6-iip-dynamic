<!DOCTYPE html>
<html>

<head>
    <title>IIP</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
    <div class="main">
        <div class="top-contact">
            <div class="left-cont">
                <img src="images/web.png" class="top-left-img" />
                <div class="top-left-iip"><a href="http://www.iipacademy.com" title="www.iipacademy.com">www.iipacademy.in </a></div>
            </div>
            <div class="right-cont">
                <img src="images/info.png" class="top-right-img" />
                <div class="top-right-info"><a href="mailto:info@iipacademy.com" title="info@iipacademy.com">info@iipacademy.com</a></div>
            </div>
        </div>
        <div class="menu-container">
            <a href="index.php"><img src="images/logo.png" class="logo"></a>
            <div class="menu-bar">
                <div class="active-menu-item"><a href="index.php" title="Home">Home</a></div>
                <div class="menu-items" title="About us"><a href="about.php" title="About us">About Us</a></div>
                <div class="menu-items"><a href="course.php">Courses</a></div>
                <div class="menu-items"><a href="gallery.php">Gallery</a></div>
                <?php
                if (isset($_SESSION['user_id'])) :
                ?>
                    <div class="menu-items"><a href="register.php"><?php echo $_SESSION['user_name'] ?></a></div>
                    <div class="menu-items"><a href="logout.php">Logout</a></div>
                <?php
                else :
                ?>
                    <div class="menu-items"><a href="register.php">Register</a></div>
                    <div class="menu-items"><a href="login.php">Login</a></div>
                <?php
                endif;
                ?>

            </div>
        </div>
        <!-- middle portion with  links, new , banner and course starts here -->
        <div class="middle-container" style="height: 850px;">
            <!-- left part of the middle portion starts here -->
            <div class="middle-left">
                <div class="menu-item-left"><a href="index.php">Home</a></div>
                <div class="menu-item-left"><a href="about.php">About Us</a></div>
                <div class="menu-item-left"><a href="course.php">Courses</a></div>
                <div class="menu-item-left"><a href="gallery.php">Gallery</a></div>
                <div class="menu-item-left"><a href="enquiry.php">Enquiry</a></div>
                <div class="menu-item-left"><a href="contact.php">Contact Us</a></div>
                <div class="middle-left-buttom">
                    <div class="middle-left-buttom-news">
                        News
                    </div>
                    <ul class="news-list">
                        <?php
                        $selAllNews = "SELECT * FROM news WHERE status = 1 ORDER BY id DESC";
                        $exeAllNews = mysqli_query($conn, $selAllNews);
                        while ($allNewsData = mysqli_fetch_assoc($exeAllNews)) {
                        ?>
                            <li>
                                <img src="images/dot.jpg">
                                <a href="news.php?id=<?php echo $allNewsData['id'] ?>">
                                    <?php echo $allNewsData['title'] ?>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <!-- left part of the middle portion ends here -->