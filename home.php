<?php



$servername = "localhost";
//$username = "username";
//$password = "password";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, "","", $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);   
}


$product = new Product($_POST["name"]); 
$product->insertProduct($conn);
$product->retrieveProducts($conn);


Redirect('index.html', false);
die();
function Redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}



class Product { 
    public $name; 
 
function __construct($_name) {
       $this->name=$_name;
   }

function retrieveProducts($conn){
	
	$sql = "SELECT ProductID, Name FROM Products";
	$result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["ProductID"]. " - Name: " . $row["Name"]."<br>";
    }
	} else {
	    echo "0 results";
	}

	    // output data of each row
	$conn->close();
	}

function insertProduct($conn){
	
	$sql = "INSERT INTO Products ( Name)
			VALUES ( '".$this->name."')";
	$result = $conn->query($sql);
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


	

}
} 


?>