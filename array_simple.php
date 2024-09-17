<?php

// *************************************************************index array******************
   // $User_name=["Ritik","Rahul","Prabhakar","Anshu","Hrash","yuraj"];
//    echo $User_name[0];
//   for($user=0; $user<count($User_name); $user++){
//     echo $User_name[$user];
//     echo"<br><hr>";
//   }
//  foreach($User_name as $user){
//     echo $user."<br>";
//  }
//


// ***********************************************Associative Array****************

// $User_Name=["Name"=>"Ritik","City"=>"Darbhanga","Roll_no"=>"08"];

//  echo $User_Name["City"];
// foreach( $User_Name as $key=>$User){
//    echo $key. "this  is " .$User."<br>";
// }


// *******************************************Multidimensional Array*****************


// $User=[
//       [1 ,"Ritk","darbhanga","Bihar","abc@gamil.com"],
//     [ 2 ,"Ritk","darbhanga","Bihar","abc@gamil.com"],
//      [ 3 ,"Ritk","darbhanga","Bihar","abc@gamil.com"],
//      [ 4 ,"Ritk","darbhanga","Bihar","abc@gamil.com"],
// ];
// for($i=0;$i<count($User);$i++){
//    // print_r ($User[$i]);
//    // echo "<br>";
//        for($j=0;$j<count($User[$i]);$j++){
//        echo $User[$i][$j];
//        echo "<br>";
//      }
// }

// *************************************Display Array Data in Table****************


// $User=[
//          [1 ,"Ritk","darbhanga","Bihar","abc@gamil.com"],
//        [ 2 ,"Ritk","darbhanga","Bihar","abc@gamil.com"],
//         [ 3 ,"Ritk","darbhanga","Bihar","abc@gamil.com"],
//         [ 4 ,"Ritk","darbhanga","Bihar","abc@gamil.com"],
//         [5,"Ritk","darbhanga","Bihar","abc@gamil.com"],
//        [ 6 ,"Ritk","darbhanga","Bihar","abc@gamil.com"],
//         [ 7 ,"Ritk","darbhanga","Bihar","abc@gamil.com"],
//         [ 8 ,"Ritk","darbhanga","Bihar","abc@gamil.com"],
//    ];
   
//    echo"<table border=1>";
// //   for($i=0; $i<count($User);$i++){
//    echo"<tr>";
// //    for($j=0; $j<count($User[$i]);$j++){
//       echo"<td>";
// //       echo $User [$i][$j];
//       echo"</td>";
// //    }
//    echo"</tr>";
// //   }
// echo"</table>";

// using foreach loop print table *************

// echo"<table border=1>";
// foreach($User as $row){
//     echo"<tr>";
//     foreach($row as $col){
//       echo "<td>";
//       echo $col;
//       echo "</td>";
//     }
//     echo"</tr>";
// }
// echo"</table>";


// ****************************Multidimensional Associative Array****************

// $User=[
//    ["S.N"=>1 ,"Name"=>"Ritk","City"=>"darbhanga","state"=>"Bihar","Email_ID"=>"abc@gamil.com"],
//    ["S.N"=>2 ,"Name"=>"Ritk","City"=>"darbhanga","state"=>"Bihar","Email_ID"=>"abc@gamil.com"],
//    ["S.N"=>3 ,"Name"=>"Ritk","City"=>"darbhanga","state"=>"Bihar","Email_ID"=>"abc@gamil.com"],
//    ["S.N"=>4 ,"Name"=>"Ritk","City"=>"darbhanga","state"=>"Bihar","Email_ID"=>"abc@gamil.com"],
//    ["S.N"=>5 ,"Name"=>"Ritk","City"=>"darbhanga","state"=>"Bihar","Email_ID"=>"abc@gamil.com"],
//    ["S.N"=>6 ,"Name"=>"Ritk","City"=>"darbhanga","state"=>"Bihar","Email_ID"=>"abc@gamil.com"],
//    ["S.N"=>7 ,"Name"=>"Ritk","City"=>"darbhanga","state"=>"Bihar","Email_ID"=>"abc@gamil.com"],
//    ["S.N"=>8 ,"Name"=>"Ritk","City"=>"darbhanga","state"=>"Bihar","Email_ID"=>"abc@gamil.com"],
// ];


// echo"<table border=1>";
// foreach($User as $row){
//     echo"<tr>";
//     foreach($row as $key=>$col){
//       echo "<td>";
//       echo $key .":-".$col;
//       echo "</td>";
//     }
//     echo"</tr>";
// }
// echo"</table>";

?>

<?php

?>