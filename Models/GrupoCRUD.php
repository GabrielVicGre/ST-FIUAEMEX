<?php

include_once ("../../Config/connectPOO.php");

class GrupoCRUD {

   function createNewGroupAndReturnId($grupo,$id_tutor,$id_materia){
        global $connection;
        $query = "INSERT INTO grupo VALUES (NULL,'$grupo','$id_tutor', '$id_materia')";
        $connection->query($query);
        return $connection->insert_id;
   }
  
}