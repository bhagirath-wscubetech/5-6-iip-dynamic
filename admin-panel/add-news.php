<?php
include "../app/database.php";
include "../app/helper.php";
$error = 0;
/** 0: no error , 1: yes error */
$msg = "";
if (isset($_POST['save'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    if (!empty($title) && !empty($description)) {
        // insert data
    } else {
        $error = 1;
        $msg = "Please fill all the required fields";
    }
}
include "layouts/header.php";
?>
<div class="col-10" style="min-height: 100vh;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center mt-2">
                <div class="h2">Add News </div>
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
                    <img class="card-img-top" src="holder.js/100px180/" alt="">
                    <div class="card-body">
                        <form method="post" class="needs-validation" novalidate>
                            <div class="mb-3 required">
                                <label for="" class="form-label">Title</label>
                                <input type="text" name="title" id="" required class="form-control" placeholder="" aria-describedby="helpId">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Title is required
                                </div>
                            </div>
                            <div class="mb-3 required">
                                <label for="" class="form-label">Description</label>
                                <textarea name="description" required class="form-control" id="" cols="30" rows="10"></textarea>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Description is required
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit" name="save">Save</button>
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