<?php
    // Kiểm tra tồn tại: $_SESSION['age']
    // Nếu đã tồn tại -> cập nhật
    // Nếu chưa tồn tại -> $_SESSION['age'] = 20
    session_start();
    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';
    if (isset($_SESSION['age'])) {
        $_SESSION['age'] = 30;
    } else {
        $_SESSION['age'] = 20;
    }

    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';
