<?php 
require_once 'classes/Database.php';
require_once 'classes/User.php';
require_once 'classes/Question.php';
require_once 'classes/Answer.php';
require_once 'classes/Category.php';
require_once 'classes/Comment_Answer.php';
?>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>

</head>
<body>
<script type="text/javascript">
    setTimeout(function(){ showUser("1"); },3000);
</script>
<form>

<select name="users" onchange="showUser(this.value)">
  <option value="">Select a person:</option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">Joseph Swanson</option>
  <option value="4">Glenn Quagmire</option>
  </select>

</form>
<br>
<div id="txtHint"></div>



<script>
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","exmpl.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>


<?php
if(isset($_GET['q']) && !empty($_GET['q'])){
    $q = intval($_GET['q']);
    echo "dsafa";
    $sql="SELECT * FROM users WHERE user_id = '$q'";
    $result = $database->query($sql);
    if($database->numRows($result)){
        echo "true";
    }else{
        echo "false";
    }

    echo "<table>
    <tr>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>Age</th>
    <th>Hometown</th>
    <th>Job</th>
    </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['firstname'] . "</td>";
        echo "<td>" . $row['lastname'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['dateOfCreation'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>
</body>
</html> 
