<?php
include "../app/database.php";
include "../app/helper.php";
$error = 0;
/** 0: no error , 1: yes error */
$msg = "";

include "layouts/header.php";
?>
<div class="col-10" style="min-height: 100vh;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center mt-2">
                <div class="h2">View News </div>
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
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "layouts/footer.php";
?>
