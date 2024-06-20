<?php
include('connection.php');
session_start();
if(isset($_POST['submit'])){
$username = $_POST['username'];
$files = array_filter($_FILES['files']['name']); 
$total_count = count($_FILES['files']['name']); 
for($i = 0 ; $i < $total_count ; $i++) {
$tmpFilePath = $_FILES['files']['tmp_name'][$i]; 
if($tmpFilePath !=""){
$dirusers = "./files/". $username;
if (!is_dir($dirusers)) {
mkdir($dirusers, 0777, true); 
}
$newPathFile = "$dirusers/" .$_FILES['files']['name'][$i];
move_uploaded_file($tmpFilePath, $newPathFile);
}
}
$serializedFiles = serialize($files);
$serializedFiles = serialize($files);
$query = "INSERT INTO yourtable (username, files) VALUES ('$username', 
'$serializedFiles')";
$query_run = mysqli_query($conn, $query);
if($query_run){
echo"<script>alert('success insert into database!');</script>";
} else {
echo"<script>alert('Opps, failed insert into database!');</script>";
}
}
?>