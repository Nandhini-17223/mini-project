<?php
include('connection.php');
include('upload.php');
if (isset($_POST['search_submit'])) {
$search_username = $_POST['search_username'];
$query = "SELECT files FROM yourtable WHERE username = '$search_username'";
$result = mysqli_query($conn, $query);
if ($result) {
$row = mysqli_fetch_assoc($result);
if ($row) {
if (!empty($row['files'])) {
$files = unserialize($row['files']);
if ($files !== false) {
echo "<h3>Files uploaded by $search_username:</h3>";
foreach ($files as $files) {
echo "<img src='files/$search_username/$files' alt='$files'><br> " ;
}
} else {
echo "Error: Unable to unserialize data.";

}
} else {
echo "No files found for the username: $search_username";
}
} else {
echo "No records found for the username: $search_username";
}
} else {
echo "Query failed";
}
}
?>