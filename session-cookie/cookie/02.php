<?php
    echo '<pre>';
    print_r($_COOKIE);
    echo '</pre>';

    if (isset($_COOKIE['name'])) {
        echo $_COOKIE['name'];
    }
