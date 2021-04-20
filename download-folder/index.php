

<?php

$a = $_SERVER['REQUEST_URI'];

if (sizeof(explode('?', $a))>1) {
    $b = explode('?', $a);
    if (sizeof(explode('&', $b[1]))>1) {
        $c = explode('&', $b[1]);
        $value1 = array();
        foreach ($c as $value) {
            $d = explode('=', $value);
            $key = $d[0];
            $value1[$key] = $d[1];
        }
        $a1 = hash('md5', 'دوره html'.'.@#$*&^.' . $value1['part']);
    
        $favcolor = $value1['type'];
    
        switch ($favcolor) {
            case "1":
                $poshe = "php";
                break;
            case "24":
                $poshe = "html";
                break;
            case "3":
                $poshe = "laravel";
                break;
        }
        $file_url = __DIR__ . '\\' . $poshe . '\\' . $value1['part'] . '.zip';
        //   echo $a1;
        // //  echo $value1['token'];
        // var_dump(hash_equals($value1['token'], $a1));
        if (hash_equals($value1['token'], $a1)) {
            $file_url = __DIR__ . '\\' . $poshe . '\\' . $value1['part'] . '.zip';
            // $sysfile = '/var/www/html/myfile';
            echo $file_url;
            $file_name = "file" . $value1['part'] . ".zip";
            if (file_exists($file_url)) {
                // echo $file_url;
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . $file_name . '"');
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file_url));
                ob_clean();
                ob_end_flush();
                $handle = fopen($file_url, "rb");
                while (!feof($handle)) {
                    echo fread($handle, 1000);
                }
            }
            else {
                echo "";
            }
        }
        else {
            echo "";
        }
    } else {
        echo "";
    }
} else {
    echo "";
}

