<?php
    if (isset($_SESSION['success'])) {
        echo '<div class="alert alert-success" role="alert">'.$_SESSION['success'].'</div>';
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['warning'])) {
        echo '<div class="alert alert-warning" role="alert">'.$_SESSION['warning'].'</div>';
        unset($_SESSION['warning']);
    }
?>