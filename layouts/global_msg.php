<?php
if (isset($_SESSION['global_msg'])) :
?>
    <div class="alert <?php echo $_SESSION['global_status'] ? 'alert-success' : 'alert-warning' ?>" id="response" role="alert">
        <?php echo $_SESSION['global_msg'] ?>
    </div>

<?php
    unset($_SESSION['global_msg']);
    unset($_SESSION['global_status']);
endif;
?>