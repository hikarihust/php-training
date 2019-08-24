<?php
    $array = array(
                    array('course' => 'PHP', 'time' => 80),
                    array('course' => 'html', 'time' => 100),
                    array('course' => 'javascript', 'time' => 100)
                );

    $_SESSION['array'] = $array;

    echo '<pre>';
    print_r($_SESSION);
    echo '</pre>';
