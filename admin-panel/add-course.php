<?php
include "../app/database.php";
include "../app/helper.php";
$error = 0;
/** 0: no error , 1: yes error */
$msg = "";
$id = $_GET['id'];
if (isset($id)) {
    // get the data from the data base
    $sel = "SELECT * FROM courses WHERE id = $id";
    $exe = mysqli_query($conn, $sel);
    $data = mysqli_fetch_assoc($exe);
}
if (isset($_POST['save'])) {
    $name = mysqli_escape_string($conn, $_POST['name']);
    $color = mysqli_escape_string($conn, $_POST['color']);
    $image_name = $data['image_name']; // old
    if (!empty($_FILES['image']['name'])) {
        $oldName = $image_name;
        $images = $_FILES['image'];
        $image_name = mysqli_escape_string($conn, md5(time()) . $images['name']);  // new image name
        $desc =  "../images/courses/" . $image_name;
        $flag = move_uploaded_file($images['tmp_name'], $desc);
        if ($flag) {
            // new image | remove the old one
            unlink("../images/courses/$oldName");
        }
    }
    if (isset($id)) {
        // update
        $qry = "UPDATE courses SET name = '$name', color = '$color', image_name = '$image_name' WHERE id = $id";
    } else {
        // insert
        $qry = "INSERT INTO courses SET name = '$name', color = '$color', image_name = '$image_name'";
    }
    try {
        $flag = mysqli_query($conn, $qry);
        if ($flag) {
            header("LOCATION:view-course.php");
        }
        // all well
    } catch (\Exception $err) {
        $error = 1;
        $msg = "Internal server error";
    }
}
include "layouts/header.php";
// die;
?>
<div class="col-10" style="min-height: 100vh;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center mt-2">
                <div class="h2"> <?php echo isset($id) ? 'Update' : 'Add' ?> Course </div>
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
                        <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                            <div class="mb-3 required">
                                <label for="" class="form-label">Name</label>
                                <input type="text" name="name" value="<?php echo $data['name'] ?>" id="" required class="form-control" placeholder="" aria-describedby="helpId">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Name is required
                                </div>
                            </div>
                            <div class="mb-3 required">
                                <label for="" class="form-label">Color</label>
                                <input type="color" name="color" value="<?php echo $data['color'] ?>" id="" required class="form-control" placeholder="" aria-describedby="helpId">
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Color is required
                                </div>
                            </div>
                            <div class="mb-3 required">
                                <label for="" class="form-label">Image</label>
                                <input type="file" data-allowed-file-extensions="png gif jpg jpeg" class="dropify" data-default-file="../images/courses/<?php echo $data['image_name'] ?>" name="image" class="form-control">
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