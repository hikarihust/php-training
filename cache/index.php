<?php
    $fileName  = pathinfo(__FILE__, PATHINFO_FILENAME);
    $cacheFile = 'cached/cache-' . $fileName . '.html';
    $cacheTime = 3600;

    if (file_exists($cacheFile) && $cacheTime > time() - filectime('cached/01.html')) {
        include $cacheFile;
    } else {
        ob_start();
        for ($i = 0; $i < 1000; $i++) {
            echo $i . '<br />';
        }
        file_put_contents($cacheFile, ob_get_contents());
        ob_end_flush();
    }
