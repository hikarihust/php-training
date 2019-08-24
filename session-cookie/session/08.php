<?php
    $variable = 'This is a string';

    $_SESSION['variable'] = $variable;

    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';
