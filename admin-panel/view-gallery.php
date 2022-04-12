<?php
include "../app/database.php";
include "../app/helper.php";
$error = 0;
/** 0: no error , 1: yes error */
$msg = "";

$id = $_GET['id'];
if (isset($id)) {
    $status = $_GET['status'];
    if (isset($status)) {
        // change status
        /**
         * update query
         * Syntax: UPDATE <table> SET <col1> = <newData>, <col2> = <newData> ... , <coln> = <newData>
         */
        $upd = "UPDATE news SET status = $status WHERE id = $id";
        try {
            $flag = mysqli_query($conn, $upd);
            if ($flag) {
                $error = 0;
                $msg = "Status changed successfully";
            }
        } catch (\Exception $err) {
            $error = 1;
            $msg = "Unable to update";
        }
    } else {
        // delete query
        /**
         * Step 1: Prepare the query
         * Step 2: Execute the query
         */
        $del = "DELETE FROM news WHERE id = $id";
        try {
            $flag = mysqli_query($conn, $del);
            if ($flag) {
                $error = 0;
                $msg = "Data deleted successfully";
            }
        } catch (\Exception $err) {
            $error = 1;
            $msg = "Unable to delete the data";
        }
    }
}
include "layouts/header.php";
?>
<div class="col-10" style="min-height: 100vh;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center mt-2">
                <div class="h2">View Gallery </div>
            </div>
            <?php
            if (!empty($msg)) :
            ?>
                <!-- ternary operator -->
                <div class="alert <?php echo $error == 1 ? 'alert-warning' : 'alert-success' ?> alert-dismissible fade show" role="alert">
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
            <div class="col-12 text-end">
                <a href="add-gallery.php">
                    <button class="btn btn-primary">
                        <i class="fa fa-plus"></i>
                    </button>
                </a>
            </div>
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
                        // ORDER BY <col_name> ASC | DESC
                        $sel = "SELECT * FROM gallery ORDER BY id DESC";
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
                                    <th>Image</th>
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
                                            <!-- -->
                                            <img src="../images/gallery/<?php echo $data['image_name']; ?> " alt="" width="200">
                                        </td>
                                        <td>
                                            <?php echo $data['created_at']; ?>
                                        </td>
                                        <td>

                                            <?php
                                            if ($data['status'] == 1) :
                                            ?>
                                                <a href="view-gallery.php?id=<?php echo $data['id'] ?>&status=0">
                                                    <button class="btn btn-success">Active</button>
                                                </a>
                                            <?php
                                            else :
                                            ?>
                                                <a href="view-gallery.php?id=<?php echo $data['id'] ?>&status=1">
                                                    <button class="btn btn-warning">Inactive</button>
                                                </a>
                                            <?php
                                            endif;
                                            ?>
                                        </td>
                                        <td>
                                            <a href="view-gallery.php?id=<?php echo $data['id'] ?>">
                                                <!-- get request -->
                                                <button class="btn btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </a>
                                            <a href="add-gallery.php?id=<?php echo $data['id'] ?>">
                                                <button class="btn btn-primary">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                    $i++;
                                endwhile;
                                ?>

                                <?php
                                if ($i == 1) {
                                ?>
                                    <tr>
                                        <td colspan="6" align="center">No data found</td>
                                    </tr>
                                <?php
                                }
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