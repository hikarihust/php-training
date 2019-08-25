<?php
    setcookie('name', 'This is a text', time() + 3600);

    echo '<pre>';
    print_r($_COOKIE);
    echo '</pre>';

    setcookie('name', 'This is a text', time() + -3600);
    
    echo '<pre>';
    print_r($_COOKIE);
    echo '</pre>';
