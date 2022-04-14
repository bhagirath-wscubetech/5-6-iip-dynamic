<?php
include "app/database.php";
include "app/helper.php";
include "layouts/header.php";
?>
<div class="middle-right">
	<div class="page-status">
		<h1>Courses</h1>
		<h2><i onclick='window.location.href = "index.html" '> Home /</i> Courses</h2>
	</div>
	<div class="course-content">
		<div class="row1">
			<?php
			$sel = "SELECT * FROM courses WHERE status = 1";
			$exe = mysqli_query($conn, $sel);
			while ($data = mysqli_fetch_assoc($exe)) :
			?>
				<div class="course-1" >
					<div class="course-1-icon" style="background-color: <?php echo $data['color'] ?>;">
						<div class="icon-1">
							<img src="images/courses/<?php echo $data['image_name'] ?>">
						</div>
					</div>

					<div class="c-1"  style="color: <?php echo $data['color'] ?>; border-color: <?php echo $data['color'] ?>;">
						<?php echo $data['name'] ?>
					</div>
				</div>
			<?php
			endwhile;
			?>
		</div>
	</div>
</div>
<!-- right part of the middle portion starts here -->
<div class="clear"></div>
</div>
<?php
include "layouts/footer.php";
?>