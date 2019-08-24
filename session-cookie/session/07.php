<?php
    // Kiểm tra tồn tại: $_SESSION['age']
    // Nếu đã tồn tại -> cập nhật
    // Nếu chưa tồn tại -> $_SESSION['age'] = 20
    session_start();

    session_destroy();

    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';