<?php
include "../app/database.php";
include "../app/helper.php";
$error = 0;
$page = $_GET['page'] ?? 0;
$limit = 10;
$start = $page * $limit;
// $start = 0 * 10 = 0
// $start = 1 * 10 = 10
// $start = 2 * 10 = 20
/** 0: no error , 1: yes error */
$msg = "";
if (isset($_POST['toggle'])) {
    $ids = $_POST['ids'];
    foreach ($ids as $id) {
        toggleStatus($id, "news");
    }
}

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
                <div class="h2">View News </div>
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
                <a href="add-news.php">
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
                        $sel = "SELECT * FROM news ORDER BY id ASC LIMIT $start,$limit";
                        // start, per page
                        $exe = mysqli_query($conn, $sel);
                        /**
                         * Functions to fetch the data
                         * mysqli_fetch_assoc($exe) -> Fetch a single at a time in associative array
                         */
                        // $exe = mysqli_fetch_assoc($exe);
                        // p($exe);
                        ?>
                        <form action="" method="post">
                            <button name="delete" class="btn btn-danger">
                                Delete Selcted
                            </button>
                            <button name="toggle" class="btn btn-warning">
                                Toggle Selcted
                            </button>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="" id="check-all">

                                        </th>
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
                                                <input type="checkbox" name="ids[]" value="<?php echo $data['id'] ?>" id="" class="checkbox">
                                            </td>
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
                                                    <a href="view-news.php?id=<?php echo $data['id'] ?>&status=0">
                                                        <button type="button" class="btn btn-success">Active</button>
                                                    </a>
                                                <?php
                                                else :
                                                ?>
                                                    <a href="view-news.php?id=<?php echo $data['id'] ?>&status=1">
                                                        <button type="button" class="btn btn-warning">Inactive</button>
                                                    </a>
                                                <?php
                                                endif;
                                                ?>
                                            </td>
                                            <td>
                                                <a href="view-news.php?id=<?php echo $data['id'] ?>">
                                                    <!-- get request -->
                                                    <butto type="button" class="btn btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                        </button>
                                                </a>
                                                <a href="add-news.php?id=<?php echo $data['id'] ?>">
                                                    <button type="button" class="btn btn-primary">
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
                        </form>
                    </div>
                </div>
            </div>
            <?php
            $totalData = mysqli_num_rows(
                mysqli_query(
                    $conn,
                    "SELECT id FROM news"
                )
            );
            $totalPage = ceil($totalData / $limit);
            // 5/2 -> ceil(2.5) -> 3 , floor(2.5) -> 2
            ?>
            <div class="col-12 mt-2">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="view-news.php?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php
                        for ($n = 0; $n < $totalPage; $n++) :
                        ?>
                            <li class="page-item <?php echo $n == $page ? 'active text-white' : '' ?>">
                                <a class="page-link" href="view-news.php?page=<?php echo $n ?>">
                                    <?php echo $n + 1 ?>
                                </a>
                            </li>
                        <?php
                        endfor;
                        ?>

                        <li class="page-item">
                            <a class="page-link" href="view-news.php?page=<?php echo $page + 1; ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<?php
include "layouts/footer.php";
?>