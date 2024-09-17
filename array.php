<?php
//  echo"<table border=1>";

// $User = [
//     ["S.No"=>1, "Name" => "Ritk", "City" => "darbhanga", "State" => "Bihar", "Eamil-ID" => "abc@gamil.com"],
//     ["S.No"=>2, "Name" => "Pandey", "City" => "darbhanga", "State" => "Bihar", "Eamil-ID" => "pandey@gamil.com"],
//     ["S.No"=>3, "Name" => "Raj", "City" => "darbhanga", "State" => "Bihar", "Eamil-ID" => "ral@gamil.com"],
//     ["S.No"=>4, "Name" => "Rahul", "City" => "darbhanga", "State" => "Bihar", "Eamil-ID" => "rahul@gamil.com"],
// ];
// // print_r($User)."<br>";
// // echo$user['Name'];
// foreach ($User as $key=>$pr) {
//     // echo $key."-is:-".$pr."<br><hr>";
//     echo"<tr>";
//     foreach ($pr as $key=>$pr2) {
//         echo "<td>";
//         echo $key."-is:-".$pr2 . "<br>";
//         echo "</td>";
//     }
   
//     echo"</tr>";
// }
// echo"</table>";
?>

<!-- //2D   array -->

<?php
$host="localhost";
$username = "root";
$password = '';
$database = "ritik";

$conn = new mysqli($host, $username, $password, $database);

$ritik = $conn->prepare("INSERT INTO `student-table` ( `Name`, `email`, `Phone.No`) VALUES ( 'pandey', 'abcd@gamil.com', '79748959612');");
$result = $ritik->execute();
if($result){
    echo"Data inster sucss";
}
?>

