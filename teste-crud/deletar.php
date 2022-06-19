<?php


if(isset($_GET['id'])) {
    require 'conexao.php';

    $id = $_GET['id'];

    if(empty($id)){
        echo 'erro';
    }else {
    
              $res = $conn->query("DELETE FROM todos  WHERE id=$id");
              $res->execute();

        if($res){
            header("Location: index.php?mess=success");
        }else{
            echo "erro";
        }
        
        $conn = null;
        exit();
    }
}else {
    header("Location: index.php?mess=error");
}

?>