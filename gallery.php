<?php
include "app/database.php";
include "app/helper.php";
include "layouts/header.php";
?>
<!-- right part of the middle portion starts here -->
<div class="middle-right">
	<div class="page-status">
		<h1>Gallery</h1>
		<h2><i onclick='window.location.href = "index.html" '> Home /</i> Gallery</h2>
	</div>
	<div class="gallery-content">
		<?php
		$sel = "SELECT * FROM gallery WHERE status = 1";
		$exe = mysqli_query($conn, $sel);
		while ($data = mysqli_fetch_assoc($exe)) :
		?>
			<div class="galleryimgdiv" title="image1">
				<img src="images/gallery/<?php echo $data['image_name']?>" width="225" height="170" alt="gallery" />
				<div class="gallery-img-title"><?php echo $data['title']?></div>
			</div>
		<?php
		endwhile;
		?>

	</div>
</div>
<div class="clear"></div>
</div>
<?php
include "layouts/footer.php";
?>