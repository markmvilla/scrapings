<?php
//database setup
$db_host = 'database_host';
$db_user = 'user_name';
$db_password = 'database_password';
$db_name = 'database_name';
$dbc = new mysqli($db_host, $db_user, $db_password, $db_name);
if ($dbc->connect_errno) {
  echo $dbc->connect_error;
}
//input catalog file
$file = fopen('http://www.tcuexchange.com/database/tcucatalog.txt', "r");
$currentCourse = "";
//setup database table
$query = "SELECT * FROM schools";
$result = $dbc->query($query);
$fetchedresult = $result->fetch_all();
echo json_encode($fetchedresult);
$query = "INSERT INTO schools (school) VALUES ('Texas Christian University')";
$result=$dbc->query($query);
//iterate through file lines
while ($currentClass = trim(fgets($file))) {
	//algorithm to detect course change
  if(substr($currentClass , 0, 4) == substr($currentCourse , 0, 4)) {
    echo substr(json_encode($currentClass) , 0). '<br/>'. json_encode($currentCourse). '<br/>';
    $query = "INSERT INTO classes (class, course, school) VALUES ('$currentClass', '$currentCourse', 'Texas Christian University')";
    $result=$dbc->query($query);
  }
  else {
    $currentCourse = $currentClass;
    echo '<br/><br/>'. substr(json_encode($currentClass) , 0). '<br/>'. json_encode($currentCourse). '<br/>';
    $query = "INSERT INTO courses (course, school) VALUES ('$currentCourse', 'Texas Christian University')";
    $result=$dbc->query($query);
  }
}
fclose($file);
$dbc->close();
?>
