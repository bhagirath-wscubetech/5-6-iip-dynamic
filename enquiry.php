<?php
include "app/database.php";
include "app/helper.php";
include "layouts/header.php";
?>
<!-- right part of the middle portion starts here -->
<div class="middle-right enq-height">
	<div class="page-status">
		<h1>Enquiry</h1>
		<h2><i onclick='window.location.href = "index.html" '> Home /</i> Enquiry</h2>
	</div>
	<div class="mainwebsitecontent">
		<form>
			<div class="formrow">
				<div class="formlable">Gender : </div>
				<div class="inputform">
					<input type="radio" name="sex" id="male" class="" />Male
					<input type="radio" name="sex" id="female" class="" />Female
				</div>
			</div>
			<div class="formrow">
				<div class="formlable">Name : </div>
				<div class="inputform"><input type="text" name="name" id="name" class="inputbox" /></div>
			</div>
			<div class="formrow">
				<div class="formlable">Contact No : </div>
				<div class="inputform"><input type="text" name="contact" id="contact" class="inputbox" /></div>
			</div>
			<div class="formrow">
				<div class="formlable">Country : </div>
				<div class="inputform">
					<select name="country" id="country">
						<?php
						$countries = getCountries();
						?>
						<option value="0">-- Select a country --</option>
						<?php
						foreach ($countries as $country) :
						?>
							<option value="<?php echo $country[0] ?>"><?php echo $country[1] ?></option>
						<?php
						endforeach;
						?>
					</select>
				</div>
			</div>
			<div class="formrow">
				<div class="formlable">State : </div>
				<div class="inputform">
					<select name="state" id="state">
						<option value="">---Select a country first---</option>
					</select>
				</div>
			</div>
			<div class="formrow">
				<div class="formlable">Address : </div>
				<div class="inputform">
					<textarea name="address" id="address" class="textarea"></textarea>
				</div>
			</div>
			<div class="formrow">
				<div class="formlable">Email : </div>
				<div class="inputform"><input type="text" name="email" id="email" class="inputbox" /></div>
			</div>
			<div class="formrow">
				<div class="formlable">Enquiry : </div>
				<div class="inputform"><textarea name="enquiry" id="enquiry" class="textarea"></textarea></div>
			</div>
			<div class="formrow">
				<div class="formlable"><input type="submit" value="Send" class="button" /></div>
			</div>
		</form>
	</div>
</div>
<!-- right part of the middle portion starts here -->
<div class="clear"></div>
</div>
<?php
include "layouts/footer.php";
?>

<script>
	$("#country").change(
		function() {
			var cId = $(this).val();
			$.ajax({
				url: "state-ajax.php",
				type: "get",
				data: {
					cId: cId
				},
				beforeSend: function() {
					$("#state").html(
						`
						<option>
							Loading....
						</option>
						`
					).attr("disabled", true)
				},
				success: function(respo) {
					$("#state").html(respo).attr("disabled", false)
				}
			})
		}
	)
</script>