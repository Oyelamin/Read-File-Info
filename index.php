<?php

CONST BR = "<br>";
function getFiles($dir){
    $files = array_diff(scandir($dir), array('..', '.'));   //Scan the directory for files and omit dir dots
    $json_file_dir = 'results.json';
    $json_file_open = fopen($json_file_dir,'w');
    foreach($files as $file){
        $fileDir = $dir.'/'.$file;      //File Dir
        $file_size_byte = filesize($fileDir);   //File size in Bytes
        $file_path = realpath($fileDir);        //File full path
        $file_size_kilobytes = $file_size_byte / 1000;  //File size in KiloBytes
        if($file_size_kilobytes < 5){   //Get files less than 5Kilobytes
            $arr = [];
            $arr["file_path"] = $file_path;
            $arr["File_name"] = $file;
            $arr["file_size"] = $file_size_kilobytes;
            fwrite($json_file_open,json_encode($arr));
        }
        
    }
    

    fclose($json_file_open);
}

getFiles('css');

