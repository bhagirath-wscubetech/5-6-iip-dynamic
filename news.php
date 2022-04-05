<?php
include "app/database.php";
include "app/helper.php";
include "layouts/header.php";
?>
<!-- right part of the middle portion starts here -->
<div class="middle-right">
    <div class="page-status">
        <h1>News:</h1>
        <h2><i onclick='window.location.href = "index.html" '> Home /</i> News:</h2>
    </div>
    <?php 
        $id = $_GET['id'];
        $selNews = "SELECT * FROM news WHERE id = $id";
        $exeNews = mysqli_query($conn,$selNews);
        $newsData = mysqli_fetch_assoc($exeNews);
    ?>
    <div class="about-content">
        <h3>
            <?php echo $newsData['title']?>
        </h3>
        <?php
            echo $newsData['description'];
        ?>
    </div>
</div>
<!-- right part of the middle portion starts here -->
<div class="clear"></div>
</div>
<!-- middle portion with  links, new , banner and course ends here -->
<?php
include "layouts/footer.php";
?>