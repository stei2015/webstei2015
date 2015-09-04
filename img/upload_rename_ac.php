<?php

// Your file name you are uploading 

$uid = $_POST['uid'];
$new_file_name=$uid.".jpg";
$path= "avatar/".$new_file_name;
if($ufile !=none)
{
if(move_uploaded_file($_FILES['ufile']['tmp_name'], $path))
{
echo "Successful<BR/>"; 

//$new_file_name = new file name
//$_FILES['ufile']['size'] = file size
//$_FILES['ufile']['type'] = type of file
echo "File Name :".$new_file_name."<BR/>"; 
echo "File Size :".$_FILES['ufile']['size']."<BR/>"; 
echo "File Type :".$_FILES['ufile']['type']."<BR/>"; 
}
else
{
echo "Error";
}
}

header ("location: review.php");
?>