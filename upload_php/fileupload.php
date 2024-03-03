
<!--ata hocca video link https://youtu.be/R8U043czKUw?si=0xwYeF-_89B4CggZ -->


<?php

$connection = mysqli_connect('localhost','root','','phptestdb');
 

if(!$connection){
  echo mysqli_connect_error();
}


if(isset($_POST['submit'])){

//$_FILES ['upfile'] ['type']; ata dara amra file name diya ki data nita cayce ta dhaka no hoy.

$filename =  $_FILES ['upfile'] ['name'];

// ay jayga amra ay function dara file ar location dakte payace.

 $tmploc = $_FILES ['upfile'] ['tmp_name'];

//  ay jayga ay function dara file type dhakano hoyasa.

$filetype=  $_FILES ['upfile'] ['type'];

// ay function dara file ar size show korano hoy.
$filesize =  $_FILES ['upfile'] ['size'];

$uploc = "Images/".$filename;


if($filesize <300000){

if($filetype=='image/jpeg'){

  // ay function dara bojo hoyasa age thaki kno file exists ashi ki na.
  if(file_exists($uploc)){
 echo "File already exixts .";
    
  }else{
    // ay function dara file ka moved korano hoyasa.

if(move_uploaded_file($tmploc,$uploc)){

$sql="INSERT INTO images(imgname) VALUES('$filename')";

if(mysqli_query($connection,$sql)){
  echo "Data inserted <br>";
}else{
  echo "No inserted";
}

echo "Uploaded";

}else{

echo"Not Uploaded";

}    

}

}else{
echo "Please select an image file.";
}

}else{
  echo "Size must be less then 100000b";
}

}


?> 

<!-- Ay khani jahatu amra file niya kaj korce say jonna "enctype dita hobe." -->

<form actiion="fileupload" method="POST" enctype="multipart/form-data">

Please select a file<br><br>
<input type="file" name="upfile"><br><br>

<input type="submit" value="Upload" name="submit">

</form>


<!--ay jayga thaki img ka database dara query kore show korano hoyasa  -->
<?php

$sql = "SELECT * FROM images";

$query = mysqli_query($connection,$sql);

while($data = mysqli_fetch_assoc($query)){
  $imagename = $data['imgname'];

echo "<img src= 'images/
$imagename '>";


}



?>
