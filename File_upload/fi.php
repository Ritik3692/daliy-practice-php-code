<?php

// if ($_FILES['fileupload']) {
//   $allowed_types = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
//   $path = '' . $_FILES['fileupload']['name'];
//   $upload_path = "./fileupload" . $path;
//   move_uploaded_file($_FILES['fileupload']['tmp_name'], $upload_path) || die('failed to upload');
//   echo '  File Uploaded ';
// }
?>
<?php

if ($_FILES['fileupload']) {

  $allowed_types = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
  $file_info = pathinfo($_FILES['fileupload']['name']);
  $file_extension = strtolower($file_info['extension']);

  if (in_array($file_extension, $allowed_types)) {
    $path = $file_info['basename'];
    $upload_path = "./fileupload/" . $path;

    if (move_uploaded_file($_FILES['fileupload']['tmp_name'], $upload_path)) {
      echo 'File Uploaded';
    } else {
      die('Failed to upload');
    }
  } else {
    die('Invalid file type. Only JPG, PNG, WEBP, and GIF files are allowed.');
  }

  echo " <img src='$upload_path'  height='100px' width='100px'>";
}
?>


