<html>
<head>
<link rel="stylesheet" href="css/bootstrap.css" />
</head>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">logic design</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li> 
    </ul>
  </div>
</nav>

<div class='col-md-6 col-md-offset-2'>
<form action="" method="post" enctype="multipart/form-data">

<label>Upload File

 
<input id="filefield" type="file" name="filefield"  class='btn btn-default' />

</label>

<label>

<input id="Upload" type="submit" name="Upload" value="Upload"  class='btn btn-primary' />

<!-- This hidden input will force the  PHP max upload size. it may work on all servers. -->

<input type="hidden" name="MAX_FILE_SIZE" value="100000" />

</label></form></div>
</html>
<?php
	include 'material.php';

	$material = new Material;
	$uploded_files=$material->mateials();
?>
<div class='col-md-6 col-md-offset-2'>
<table class='table table-striped'>
    <thead>
    	<tr><th>ID</th><th>Materials</th><th>Action</th></tr>
    </thead>
<?php
foreach ($uploded_files as $key => $u) {
	 
		 echo"<tr><td>$key</td><td><a href=download.php?file=".$u['path'].">".$u['path']."</a></td><td><a  class='btn btn-success' href=download.php?file=".$u['path'].">downlod</td></tr>";


	}
	echo "</tabel></div>";



if(isset($_FILES['filefield'])){

$file=$_FILES['filefield'];

$upload_directory='uploads/';

$ext_str = "gif,jpg,jpeg,mp3,tiff,bmp,doc,docx,ppt,pptx,txt,pdf";

$allowed_extensions=explode(',',$ext_str);

$max_file_size = 10485760;//10 mb remember 1024bytes =1kbytes /* check allowed extensions here */

$ext = substr($file['name'], strrpos($file['name'], '.') + 1); //get file extension from last sub string from last . character

if (!in_array($ext, $allowed_extensions) ) {

echo "only".$ext_str." files allowed to upload"; // exit the script by warning

} /* check file size of the file if it exceeds the specified size warn user */

if($file['size']>=$max_file_size){

echo "only the file less than ".$max_file_size."mb  allowed to upload"; // exit the script by warning

}

//if(!move_uploaded_file($file['tmp_name'],$upload_directory.$file['name'])){

$path=md5(microtime()).'.'.$ext;

if(move_uploaded_file($file['tmp_name'],$upload_directory.$path)){

echo"Your File Successfully Uploaded";

$material->path=$path;

$material->insert();

}

else{

echo "The file cant moved to target directory."; //file can't moved with unknown reasons likr cleaning of server temperory files cleaning

}

}

?>

