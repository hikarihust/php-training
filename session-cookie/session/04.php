<?php
    session_start();
    if (isset($_SESSION['name'])) {
        echo 'Ton tai';
    } else {
        echo 'Chua ton tai';
    }
    