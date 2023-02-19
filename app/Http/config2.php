<?php
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;

$servername = "127.0.0.1";

$dbname = "gestionbio";

$flag = 0;

$username = "root";

$password = "";

$api_key_value = "tPmAT5Ab3j7F9";

$api_key= $temperatura= $date= $name = $type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $medicion = test_input($_POST["val"]);
        $date = test_input($_POST["date"]);
        $name = test_input($_POST["name"]);
        $type = test_input($_POST["type"]);

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql ="SELECT * FROM senses WHERE name='$name'";
        $resultado = mysqli_query($conn, $sql);
        $array=mysqli_fetch_array($resultado);
        $dato=$array['id'];
        $sql2 = "SELECT * FROM sensors WHERE senses_id ='$dato' ORDER BY id DESC LIMIT 10";
        $result = mysqli_query($conn, $sql2);
        while( $fila = mysqli_fetch_assoc( $result )){
            $nuevo_array[] = $fila;
        }
        if (mysqli_num_rows($result)<10){
            for ($i=0;$i<mysqli_num_rows($result);$i++){
                $nuevo[] = $nuevo_array[$i]['event'];
            }
        }
        else{
            for ($i=mysqli_num_rows($result)-10;$i<mysqli_num_rows($result);$i++){
                $nuevo[] = $nuevo_array[$i]['event'];
            }
        }
        if(in_array(1,$nuevo)){
            $flag = 0;
        }
        else{
            $flag = 1;
        }
        if (mysqli_num_rows($resultado) > 0) {
            if (($medicion>$array['min'] && $medicion<$array['max']) || $flag == 0 ){
                    $evento=0;
            }
            else{
                $evento=1;
            }
            $sql = "UPDATE senses SET val=$medicion, updated_at=CURRENT_TIMESTAMP where id=$dato";
            $sqli = "INSERT INTO sensors (val,event,date, senses_id) VALUES ('$medicion','$evento','$date','$dato')";
            if ($conn->query($sql) === TRUE && $conn->query($sqli) === TRUE) {
                echo "Registro creado satisfactoriamente";
            }
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                echo "Error: " . $sqli . "<br>" . $conn->error;
            }
        }
        else{
            $evento=0;
            $sqli = "INSERT INTO senses (val, name) VALUES ('$medicion','$name')";
            $sql ="SELECT id FROM senses WHERE name='$name'";
            if ($conn->query($sqli) === TRUE) {
                echo "Registro creado satisfactoriamente";
            }
            else {
                echo "Error: " . $sqli . "<br>" . $conn->error;
            }
            $resultado = mysqli_query($conn, $sql);
            $dato=mysqli_fetch_array($resultado);
            $dato=$dato['id'];
            $sqli = "INSERT INTO sensors (val,event,date, senses_id) VALUES ('$medicion','$evento','$date','$dato')";
            if ($conn->query($sqli) === TRUE) {
                echo "Registro creado satisfactoriamente";
            }
            else {
                echo "Error: " . $sqli . "<br>" . $conn->error;

            }
        }

    }
    else {
        echo "LLave de la API errada";
    }
}
else {
    echo "No se enviaron los datos";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
