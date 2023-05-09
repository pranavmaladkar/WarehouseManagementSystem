<?php
include("database.php");

$db = $conn;
$tableName = "storage_form";
$columns = ['id', 'company_name', 'company_email', 'contact_number', 'pickup_date', 'reason_for_storage','list_of_goods', 'approx_space_needed', 'duration_of_storage', 'submission_date'];
$fetchData = fetch_data($db, $tableName, $columns);

function fetch_data($db, $tableName, $columns){
    if(empty($db)){
        $msg = "Database connection error";
    } elseif (empty($columns) || !is_array($columns)) {
        $msg = "Columns Name must be defined in an indexed array";
    } elseif(empty($tableName)){
        $msg = "Table Name is empty";
    } else{
        $columnName = implode(", ", $columns);
        $query = "SELECT ".$columnName." FROM $tableName"." ORDER BY id DESC";
        $result = $db->query($query);
        if($result == true){ 
            if ($result->num_rows > 0) {
                $rows = $result->fetch_all(MYSQLI_ASSOC);

                $msg = "
                        <h1>Storage Order Data</h1>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Company Name</th>
                                    <th>Company Email</th>
                                    <th>Contact Number</th>
                                    <th>Pickup Date</th>
                                    <th>Reason for Storage</th>
                                    <th>List of Goods</th>
                                    <th>Approx Space Needed</th>
                                    <th>Duration of Storage</th>
                                    <th>Submission Date</th>
                                    <th>Operation</th>
                                    <th>Operation</th>
                                   
                                </tr>
                            </thead>
                            <tbody>";
                foreach($rows as $row)
                {
                    
                    $sen=$row["id"];
                    $msg .= "<tr id='row_".$row["id"]."'>
                                <td>".$row["id"]."</td>
                                <td>".$row["company_name"]."</td>
                                <td>".$row["company_email"]."</td>
                                <td>".$row["contact_number"]."</td>
                                <td>".$row["pickup_date"]."</td>
                                <td>".$row["reason_for_storage"]."</td>
                                <td>".$row["list_of_goods"]."</td>
                                <td>".$row["approx_space_needed"]."</td>
                                <td>".$row["duration_of_storage"]."</td>
                                <td>".$row["submission_date"]."</td>
                                <td><button class='btnR' onclick=deleteData(".$row["id"].")>Reject</button></td>
                                <td> <a  onclick=acceptData(".$row["id"].")  button class='btnA' id='acc'>Accept</a></td>
                              
                            </tr>";
                }
                $msg .= "</tbody></table>";
            } else {
                $msg = "No Data Found"; 
            }
        } else{
            $msg = mysqli_error($db);
        }
    }
    return $msg;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Storage Form Data</title>
	<style type="text/css">
        h1{
            text-align: center;
        }
		table {
			border-collapse: collapse;
			width: 100%;
			color: #333;
			font-family: Arial, Helvetica, sans-serif;
			font-size: 14px;
			text-align: left;
		}
		th, td {
			padding: 10px;
			border: 1px solid #ccc;
		}
		th {
			background-color: #007bff;
			color: #fff;
			font-weight: bold;
			text-align: center;
		}
		tr:nth-child(even) {
			background-color: #f2f2f2;
		}
        .btnR{
            background-color: red;
            width: 75px;
            padding: 5px;
            font-weight: bold;
            border-radius: 3px;
        }
        .btnA{
            background-color: green;
            width: 75px;
            padding: 5px;
            font-weight: bold;
            border-radius: 3px;   
            color: white;         
        }
	</style>
</head>
<body>
	<?php echo $fetchData; ?>
    <script>
    function deleteData(id) {
        if (confirm("Are you sure you want to delete this record?")) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var row = document.getElementById("row_" + id);
                        row.parentNode.removeChild(row);
                    } else {
                        alert("Error deleting record: " + xhr.statusText);
                    }
                }
            };
            xhr.open("POST", "delete.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("id=" + id);
        }
    }
    function acceptData(id)
    {
        if (confirm("Are you sure you want to accept this record?")) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "new.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("id=" + id);
            let acc=document.getElementById('acc');
            acc.innerHTML='Accepted';
        } 
    }
  
</script>

</body>
</html>
