<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>add member</title>
</head>
<body>
<h1>Web Development - assign2</h1>
<?php
//getting passwords and important information from dbaccess file
require_once ("/home/prq2929/public_html/assign2/dbaccess.php");
//setting up connection to the database
$conn = mysqli_connect($host, $user, $pswd, $dbnm);
if(!$conn){
    echo "connection failed <br>";
}
else{
    //deciding what to do if someone searches with an empty form element or not
    if(isset($_POST["bsearch"]) && $_POST["bsearch"] == ""){
        $sql = "SELECT * FROM bookings;";
    }
    else{
        $searchValue = $_POST["bsearch"];
        $sql = "SELECT * FROM bookings WHERE booking_number LIKE '" . $searchValue . '%' . "';";
    }
    $result = mysqli_query($conn, $sql);
    //creating and populating table with recieved data
        echo "<table border=\"1\">";
        echo "<tr>\n"
        ."<th scope=\"col\">Booking Reference Number</th>\n"
        ."<th scope=\"col\">Customer Name</th>\n"
        ."<th scope=\"col\">Phone</th>\n"
        ."<th scope=\"col\">Pickup Suburb </th>\n"
        ."<th scope=\"col\">Destination Suburb</th>\n"
        ."<th scope=\"col\">Pickup Date and Time</th>\n"
        ."<th scope=\"col\">Status</th>\n"
        ."<th scope=\"col\">Assign</th>\n" . "</tr>\n";
        
        while ($row = mysqli_fetch_assoc($result)){
        $str=$row["pickup_date"].$row["pickup_time"];
        echo "<tr>";
        echo "<td>", $row["booking_number"] , "</td>";
        echo "<td>", $row["customer_name"] , "</td>";
        echo "<td>", $row["phone_number"] , "</td>";
        echo "<td>", $row["suburb"] , "</td>";
        echo "<td>", $row["destination_suburb"] , "</td>";
        echo "<td>",$str, "</td>";
        echo "<td>", $row["status"] , "</td>";
        echo "<td> <input type = 'button' value='assign' onclick='func(\"".$row["booking_number"]."\")'/> </td>";
            }
        echo "</table>";
}
?>
//starting javascript code and using xmlhttprequest
<script>
function func(reference){
    var XHR = new XMLHttpRequest();
    XHR.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           // Typical action to be performed when the document is ready:
            alert(XHR.responseText);
        }
    };
    var body = "reference="+reference+"&src=JAVASCRIPT";
    XHR.open("POST", "assign.php", true);
    XHR.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    XHR.send(body);
    alert("Booking has been assigned");
}
</script>
</body>
</html>
<!--reference url-->
<!--http://prq2929.cmslamp14.aut.ac.nz/assign2/results.php-->
