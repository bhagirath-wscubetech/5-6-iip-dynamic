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
                        <!--  Select query 
                            Syntax: SELECT <col1>,<col2>,...<coln> FROM <table_name>
                                Step 1: Prepare the query
                                Step 2: Execute the query
                                Step 3: Fetch the data

                                *: Select all columns
                        -->
                        <?php
                        $sel = "SELECT * FROM news";
                        $exe = mysqli_query($conn, $sel);
                        /**
                         * Functions to fetch the data
                         * mysqli_fetch_assoc($exe) -> Fetch a single at a time in associative array
                         */
                        // $exe = mysqli_fetch_assoc($exe);
                        // p($exe);
                        ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                while ($data = mysqli_fetch_assoc($exe)) :
                                ?>
                                    <tr>
                                        <td>
                                            <?php echo $i ?>
                                        </td>
                                        <td>
                                            <?php echo $data['title']; ?>
                                        </td>
                                        <td>
                                            <?php echo $data['description']; ?>
                                        </td>
                                        <td>
                                            <?php echo $data['created_at']; ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($data['status'] == 1) :
                                            ?>
                                                <button class="btn btn-success">Active</button>
                                            <?php
                                            else :
                                            ?>
                                                <button class="btn btn-warning">Inactive</button>
                                            <?php
                                            endif;
                                            ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <button class="btn btn-primary">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php
                                    $i++;
                                endwhile;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include "layouts/footer.php";
?>