<?php
include "app/database.php";
include "app/helper.php";
include "layouts/header.php";
$sel = "SELECT * FROM account_setting";
$exe = mysqli_query($conn, $sel);
$data = mysqli_fetch_assoc($exe);
?>
<!-- right part of the middle portion starts here -->
<div class="middle-right">

	<div class="page-status">
		<h1>Contact</h1>
		<h2><i onclick='window.location.href = "index.html" '> Home /</i> Contact</h2>
	</div>
	<div class="contact-content">
		<div class="contact-row">
			<div class="contact-row-left">
				<img src="images/phone.png">
				<p><b>Phone:</b> <?php echo $data['contact_primary'] ?>, <?php echo $data['contact_seconday'] ?></p>
				<p> <b>Email ID:</b>
					<a href="http://www.iipacademy.com/" target="blank">
						<font style="color:#00a8ec; cursor: pointer;"> <?php echo $data['email'] ?></font>
					</a>
				</p>
				<p> <b>Website:</b>
					<a href="http://www.iipacademy.com" target="blank">
						<font style="color:#00a8ec; cursor: pointer;"> <?php echo $data['website_link'] ?> </font>
					</a>
				</p>
			</div>
			<div class="contact-row-right">
				<img src="images/address-pin.png">
				<p>
					<?php echo $data['address'] ?>
				</p>
			</div>

		</div>
		<h1 style="color: #343130;">Find Us On Map</h1>
		<div class="contact-map">
			<?php echo $data['map'] ?>
		</div>

	</div>
</div>
<!-- right part of the middle portion starts here -->
<div class="clear"></div>
</div>
<!-- middle portion with  links, new , banner and course ends here -->
<?php
include "layouts/footer.php";
?>