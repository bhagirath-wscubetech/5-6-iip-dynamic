<?php
include "../app/database.php";
include "../app/helper.php";
$error = 0;
/** 0: no error , 1: yes error */
$msg = "";
$id = $_GET['id'];
$sel = "SELECT * FROM account_setting";
$exe = mysqli_query($conn, $sel);
$data = mysqli_fetch_assoc($exe);
if (isset($_POST['save'])) {
    // p($_POST);
    $contact_primary = mysqli_escape_string($conn, $_POST['contact_primary']);
    $contact_seconday = mysqli_escape_string($conn, $_POST['contact_seconday']);
    $email = mysqli_escape_string($conn, $_POST['email']);
    $website_link = mysqli_escape_string($conn, $_POST['website_link']);
    $map = mysqli_escape_string($conn, $_POST['map']);
    $address = mysqli_escape_string($conn, $_POST['address']);
    // echo $title;
    // echo $description;
    if (!empty($contact_primary)) {
        // insert data
        /**
         * Insert query: INSERT INTO table_name SET col1 = val1, col2 = val2, col3 = val3, ... coln = valn;
         * Step 1: Prepare the query
         * Step 2: Execute the query
         */

        $qry = "UPDATE account_setting SET 
                contact_primary = '$contact_primary',
                contact_seconday = '$contact_seconday',
                email = '$email',
                website_link = '$website_link',
                map = '$map',
                address = '$address'
                ";
        try {
            $flag = mysqli_query($conn, $qry);
            // all well
        } catch (\Exception $err) {
            $error = 1;
            echo $err->getMessage();
            $msg = "Internal server error";
        }
    } else {
        $error = 1;
        $msg = "Please fill all the required fields";
    }
}
include "layouts/header.php";
// die;
?>
<div class="col-10" style="min-height: 100vh;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center mt-2">
                <div class="h2"> Update Account Settings </div>
            </div>
            <?php
            if (!empty($msg)) :
            ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>
                        <?php echo $msg ?>
                    </strong>
                </div>
            <?php
            endif;
            ?>

        </div>
        <div class="row">
            <div class="col-12 mt-2">
                <div class="card">
                    <div class="card-body">
                        <form method="post" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-6 mb-3 required">
                                    <label for="" class="form-label">Contact Number (Primary)</label>
                                    <input type="text" name="contact_primary" value="<?php echo $data['contact_primary'] ?>" id="" required class="form-control" placeholder="" aria-describedby="helpId">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Contact Number is required
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="" class="form-label">Contact Number (Seconday)</label>
                                    <input type="text" name="contact_seconday" value="<?php echo $data['contact_seconday'] ?>" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-6 mb-3 required">
                                    <label for="" class="form-label">Email</label>
                                    <input type="email" name="email" value="<?php echo $data['email'] ?>" id="" required class="form-control" placeholder="" aria-describedby="helpId">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Email is required
                                    </div>
                                </div>
                                <div class="col-6 mb-3 required">
                                    <label for="" class="form-label">Website Link</label>
                                    <input type="url" name="website_link" required value="<?php echo $data['website_link'] ?>" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        URL is required
                                    </div>
                                </div>
                                <div class="col-6 mb-3 required">
                                    <label for="" class="form-label">Address</label>
                                    <textarea name="address" required class="form-control" id="" cols="30" rows="10"><?php echo $data['address'] ?></textarea>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Address is required
                                    </div>
                                </div>
                                <div class="col-6 mb-3 required">
                                    <label for="" class="form-label">Map</label>
                                    <textarea name="map" required class="form-control" id="" cols="30" rows="10"><?php echo $data['map'] ?></textarea>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Map is required
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit" name="save"> <?php echo isset($id) ? 'Update' : 'Add' ?></button>
                                <button class="btn btn-warning" type="reset">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "layouts/footer.php";
?>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
<script>
    var alertList = document.querySelectorAll('.alert');
    alertList.forEach(function(alert) {
        new bootstrap.Alert(alert)
    })
</script>
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor');
</script>