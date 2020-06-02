<?php
    include('classes.php');   
    include('php_func.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <form method="POST">
                <input type="submit" class="btn btn-dark" name="SaveDB" value="Save On DB">
            </form>            
        </div>
    </nav>

    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped"> 
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>           
                    <?php
                        foreach($Continents as $Continent){
                            echo
                            '<tr>
                                <td>'.$Continent->ID.'</td>
                                <td>'.$Continent->Name.'</td>
                                <td>'.$Continent->Description.'</td>                              
                                <td>
                                 <form action="countries.php" method="POST">                                     
                                    <button class="btn btn-dark" name="continentID" value="'.$Continent->ID.'">Countries</button>
                                 </form>                          
                                </td>                         
                            </tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
 
   
</body>
</html>