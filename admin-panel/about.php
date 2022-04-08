<?php
include "../app/database.php";
include "../app/helper.php";
$error = 0;
/** 0: no error , 1: yes error */
$msg = "";
// get the data from the data base
$sel = "SELECT * FROM about_us";
$exe = mysqli_query($conn, $sel);
$data = mysqli_fetch_assoc($exe);
if (isset($_POST['save'])) {
    // p($_POST);
    $content = mysqli_escape_string($conn, $_POST['content']);
    // echo $title;
    // echo $description;
    if (!empty($content)) {
        // insert data
        /**
         * Insert query: INSERT INTO table_name SET col1 = val1, col2 = val2, col3 = val3, ... coln = valn;
         * Step 1: Prepare the query
         * Step 2: Execute the query
         */

        $qry = "UPDATE about_us SET about_content = '$content'";
        try {
            $flag = mysqli_query($conn, $qry);
            // all well
        } catch (\Exception $err) {
            $error = 1;
            // echo $err->getMessage();
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
                <div class="h2"> Update About Us </div>
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
                            <div class="mb-3 required">
                                <label for="" class="form-label">Content</label>
                                <textarea id="editor" name="content" required class="form-control" cols="30" rows="10"><?php echo $data['about_content'] ?></textarea>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Content is required
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit" name="save"> Update </button>
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