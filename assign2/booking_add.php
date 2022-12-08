<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>add member</title>
</head>
<body>
<h1>Web Development - Lab05</h1>
<?php
require_once ("/home/prq2929/public_html/assign2/dbaccess.php");
//creating a random reference number in hexadecimal
function generate_Reference($customer_name, $pickup_date, $pickup_time){
    $hash = hash("sha256", ($customer_name.$pickup_date.$pickup_time));
    $formattedReference = strtoupper(substr($hash, 0, 6));
    return $formattedReference;
}

//function that creates a table if it doesn't already exist, then inserts the data entered by the user on the booking.html page into said database
function addbooking($conn){
    $sql="CREATE TABLE IF NOT EXISTS bookings(
    booking_number varchar(10),
    customer_name varchar(150),
    phone_number varchar(12),
    unit_number varchar(6),
    street_number varchar(7),
    street_name varchar(100),
    suburb varchar(100),
    destination_suburb varchar(100),
    pickup_date date,
    pickup_time time,
    status varchar(10)
    );"
    ;
    $cname = $_POST["cname"];
    $phone = $_POST["phone"];
    $unumber = $_POST["unumber"];
    $snumber = $_POST["snumber"];
    $stname = $_POST["stname"];
    $sbname = $_POST["sbname"];
    $dsbname = $_POST["dsbname"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $newBookingNumber = "BRN" . generate_Reference($cname, $date, $time);
    mysqli_query($conn,"INSERT INTO `bookings`(`booking_number`, `customer_name`, `phone_number`, `unit_number`, `street_number`, `street_name`, `suburb`, `destination_suburb`, `pickup_date`, `pickup_time`) VALUES ('$newBookingNumber','$cname','$phone','$unumber','$snumber', '$stname', '$sbname', '$dsbname', '$date ', '$time');");
    }
    $conn = mysqli_connect($host, $user, $pswd, $dbnm);
    if(!$conn){
        echo "Connection failed" . "<br>";
    }
    else{
//        echo "Connection established" . "<br>";
        addbooking($conn);
        mysqli_close($conn);
        echo "booking saved to database<br>";
    }
?>
//hyperlink to booking.html page. unused since the xmlhttprequest object was used instead of post and get
<a href="http://prq2929.cmslamp14.aut.ac.nz/assign2/booking.html">Home</a>
</body>
</html>
<!--reference URL-->
<!--http://prq2929.cmslamp14.aut.ac.nz/lab05/booking_add.php-->
