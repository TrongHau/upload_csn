<?php
    foreach ($musicDownload as $item) {
        echo "window.open('".$item['url']."');";
    }
?>