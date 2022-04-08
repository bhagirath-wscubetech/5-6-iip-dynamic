<?php
include "app/database.php";
include "app/helper.php";
include "layouts/header.php";
$sel = "SELECT * FROM about_us";
$exe = mysqli_query($conn, $sel);
$data = mysqli_fetch_assoc($exe);
?>
<!-- right part of the middle portion starts here -->
<div class="middle-right">
	<div class="page-status">
		<h1>About Us:</h1>
		<h2><i onclick='window.location.href = "index.html" '> Home /</i> About Us:</h2>
	</div>
	<div class="about-content">
		<?php echo $data['about_content'] ?>
	</div>
</div>
<!-- right part of the middle portion starts here -->
<div class="clear"></div>
</div>
<!-- middle portion with  links, new , banner and course ends here -->
<?php
include "layouts/footer.php";
?>