<?php
/**-----------------------------------
 * Note: 
 * This can only get the
 *  + file name
 *  + file size
 *  + file path
 * ===============================================
 */
function getFiles($dir){
    $files = array_diff(scandir($dir), array('..', '.'));   //Scan the directory for files and omit dir dots
    $json_file_dir = 'results.json';
    if(isset($files) && !empty($files)){
        $json_file_open = fopen($json_file_dir,'w');    //Open the json file
        foreach($files as $file){
            $fileDir = $dir.'/'.$file;      //File Dir
            $file_size_byte = filesize($fileDir);   //File size in Bytes
            $file_path = realpath($fileDir);        //File full path
            $file_size_kilobytes = $file_size_byte / 1000;  //File size in KiloBytes
            if($file_size_kilobytes < 5){   //Get files less than 5Kilobytes
                $arr = [];
                $arr["file_path"] = $file_path;
                $arr["File_name"] = $file;
                $arr["file_size"] = $file_size_kilobytes.'KB';
                fwrite($json_file_open,json_encode($arr));
            }
            
        }
        fclose($json_file_open);    //close the json file
    }else{
        echo "No File is found in the Directory";
    }
 
}

getFiles('css');    //Pass the folder's directory as a parameter


