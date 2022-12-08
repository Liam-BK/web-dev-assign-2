<?php
//only function of this file is to update the assigned? section of the database

require_once ("/home/prq2929/public_html/assign2/dbaccess.php");
$conn = mysqli_connect($host, $user, $pswd, $dbnm);
if(!$conn){
    echo "connection failed <br>";
}
if(isset($_POST['reference'])){
    //update status for row with reference in db
    $reference = $_POST['reference'];
    
    $sql = "UPDATE `bookings` SET  `status`= 'assigned' WHERE booking_number = '$reference'";
    mysqli_query($conn, $sql);
    echo "booking has been assigned";
}
?>
