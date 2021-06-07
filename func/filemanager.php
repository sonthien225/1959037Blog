<?php
function validateFile($file,$type, $maxsize = 5000000) {
$file = array_values($_FILES);
$file = $file[0];
$fname = explode(".",$file['name']);
$ftype = $file['type'];
$fsize = $file['size'];
$ftemp = $file['tmp_name'];
$ferror = $file['error'];
$allowed_ext = getAllowedExt($type);
$fext = strtolower(end($fname));
  if(in_array($fext, $allowed_ext)) {
    if($ferror === 0) {
      if($fsize < $maxsize) {
        return moveFile($fname, $fext, $ftemp);
      } else {
        return false;
      }
    } else {
      return false;
    }
  } else {
    return false;
  }
}


function moveFile($fname, $fext, $ftemp) {
  $new_fname = $fname[0] . '_' . uniqid('', false) . '.' . $fext;
  $file_dest = 'images/' . $new_fname;
  if(move_uploaded_file($ftemp,$file_dest)) {
    return $file_dest;
  } else {
    return false;
  }
}

function getAllowedExt($type) {
  if($type === "img") {
    return ['png', 'jpg', 'jpeg', 'gif'];
  } elseif($type = "video") {
    return ['mp4'];
  }
} ?>
