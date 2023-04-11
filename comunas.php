<?php
//obtiene las comunas por region seleccionada
$html = '';
$conn = new mysqli('localhost', 'root', '', 'bd_prueba');
 
$id_region = $_POST['id_region'];
 
$result = $conn->query(
    "SELECT * FROM comuna
    WHERE id_region = ".$id_region
);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $html .= '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
    }
}
echo $html;
?>