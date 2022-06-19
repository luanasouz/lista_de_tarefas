<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <title>Document</title>
    <script src="http://code.jquery.com/jquery-3.1.0.min.js"></script>
</head>
<body>
    <?php
    
    include 'conexao.php';
   
    if(isset($_POST['txt'])) {
        include 'conexao.php';
    
        $title = $_POST['txt'];
    
        if(empty($title)) {
        
             echo "<p style='color: rgb(216, 6, 6);'> Erro: Tarefa nao foi criada</p>";
          
        }else{
            $stmt = ("SELECT * FROM todos");
            $stmt = $conn->prepare("INSERT INTO todos(title)  VALUES (?)");
            
            $res = $stmt->execute([$title]);
    
        }
    
    }


    ?>


    <div class="corpo">

        <h1>Lista de tarefas</h1>

        <div class="header">

            <form action="" method="post">

                <input class="txt" type="text" name="txt"   id="txt"  placeholder="Adicionar Tarefa">
               
                <button class="botao" type="submit" id="submit" value="submit">Adicionar</button>
      
            </form>
        </div>

        <div class="coluna">


            <?php 
            
                if(isset($_GET['id'])) {

                    $id = $_GET['id'];

                    if(empty($id)) {
                    echo 0;
                    }else {

                    $res = $conn->query("UPDATE todos SET checked = 1 WHERE id = $id");
                    $res->execute([$checked]);

        
                    if ([$checked]){

                        header("Location: index.php?mess=success");
           
                    }else {
                        echo "Erro";
                    }
                }
              
    
        $conn = null;
        exit();
        
}
            //fim checar

            $query_tarefas = "SELECT id, title, date_time, checked FROM todos ORDER BY checked ASC";
            $tarefas = $conn->prepare($query_tarefas);
            $tarefas->execute();

                $checked = $tarefas->fetch(PDO::FETCH_ASSOC);
                extract($checked);


            if(($tarefas) AND ($tarefas->rowCount() != 0) ) {
                while($linhaT = $tarefas->fetch(PDO::FETCH_ASSOC)) {
                extract($linhaT);
                    
                    if($checked == 0) {  ?>
                                
                    <div class="tar" id="tar">
                    
                        <?php 
                            echo "Tarefa: " . $title ;
                        
                            echo "<a href='deletar.php?id=$id'> <i class='fas fa-trash'></i></a>" ;
                       
                            echo "<a href='index.php?id=$id'><i class='fas fa-check-circle'></i></a>"; 
                                           
                            echo "<h5>Data: $date_time </h5>"; 
                        ?>

                    </div> 
        
        
                    <?php }else if($checked == 1){ ?>
                    <div class="tar dois" id="tar dois">
                   
                        <?php 
                            echo "Tarefa: " . $title ;
                               
                            echo "<a href='deletar.php?id=$id'> <i class='fas fa-trash'></i></a>" ;
                   
                            echo "<h5>Data: $date_time </h5>"; 
                        ?>

                     </div> 
                <?php 
                } 
     
           } 
        
        } 
        ?>

            </div>
         </div>
               
</body>
</html>