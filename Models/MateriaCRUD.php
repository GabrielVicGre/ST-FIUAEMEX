
<?php 

include_once ("../../Config/connectPOO.php");
include_once ("../../Models/Materia.php");

class MateriaCRUD {
    
    //CREATE
    function createMateriaSinRetorno($materia) {
        global $connection;
        $query = "INSERT INTO materia VALUES (NULL,'$materia->clave', '$materia->nombre')";
        $connection->query($query);
    }
    
    function getMateriaById($id) {
        global $connection;
    
        $query = "SELECT * FROM materia WHERE id_materia = $id";
        $result = $connection->query($query);
        $materia = $result->fetch_array(MYSQLI_ASSOC);

        $mat = new Materia();
        $mat->id_materia = $materia['id_materia'];
        $mat->clave = $materia['materia'];
        $mat->nombre = $materia['nombre'];

        return $mat;
    }
    
    function getExistenciaMateria($id_materia, $clv_materia, $nom_materia){
        global $connection;
        $query = "SELECT * FROM materia WHERE id_materia = '$id_materia' 
        AND clave LIKE '$clv_materia' and nombre LIKE '$nom_materia'; ";
        $result = $connection->query($query);
        if($result->num_rows == 1){  // Si encuentra algun registro entonces 
            return true;
        }else{
            return false;
        }
    }
/*
    function createMateria($materia) {
        global $connection;
    
        $query = "INSERT INTO materia VALUES (NULL,'$materia->cve_materia', '$materia->materia', '$materia->grupo')";
        $connection->query($query);

        return $connection->insert_id;
    }
*/
    //REPORT
/*
    function getMateriaById($id) {
        global $connection;
    
        $query = "SELECT * FROM materia WHERE id_materia = $id";
        $result = $connection->query($query);
        $materia = $result->fetch_array(MYSQLI_ASSOC);

        $mat = new Materia;
        $mat->id_materia = $materia['id_materia'];
        $mat->cve_materia = $materia['cve_materia'];
        $mat->materia = $materia['materia'];
        $mat->grupo = $materia['grupo'];

        return $mat;
    }

*/
    //UPDATE

    //DELETE
}

?>