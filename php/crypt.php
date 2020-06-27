<?php
    $msg = "test";
    $msg = encryption($msg);

    function encryption($msg) {
        $msg = crypt($msg, "am");
        $msg = md5($msg);
        $msg = sha1($msg);
        $msg = crypt($msg, "hp");
        return $msg;
    }
?>