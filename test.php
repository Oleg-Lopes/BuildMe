<?php

    session_start();
    if (isset($_POST['obj']) && !empty($_POST['obj'])) {
        $data = json_decode($_POST['obj'], true);
        $_SESSION[$data['objTarget']]['H'] = $data['objH'];
        $_SESSION[$data['objTarget']]['W'] = $data['objW'];
    }

?>
