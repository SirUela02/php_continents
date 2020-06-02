<?php
    include('classes.php');   
    include('php_func.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <a href="index.php" class="btn btn-dark">Continents</a>
            <button class="btn btn-dark" data-toggle="modal" data-target="#addModal">Add Country</button>
        </div>
    </nav>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Country</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="countries.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="contryID">ID</label>
                            <input type="text" class="form-control" id="countryID" name="countryID" placeholder="Enter id...">
                        </div>
                        <div class="form-group">
                            <label for="contryName">Name</label>
                            <input type="text" class="form-control" id="countryName" name="countryName" placeholder="Enter name...">
                        </div>
                        <div class="form-group">
                            <label for="contryDesc">Description</label>
                            <textarea class="form-control" id="countryDesc" name="countryDesc" placeholder="Enter description..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="countryAdd" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Country</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="countries.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" id="editCountryID" name="editCountryID" value="<?php echo $_POST["editCountry"] ?>">
                            </div>
                            <div class="form-group">
                                <label for="editContryName">Name</label>
                                <input type="text" class="form-control" id="editCountryName" name="editCountryName" placeholder="Enter name...">
                            </div>
                            <div class="form-group">
                                <label for="editContryDesc">Description</label>
                                <textarea class="form-control" id="editCountryDesc" name="editCountryDesc" placeholder="Enter description..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="countryEdit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Actions</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($Continents[$ContinentIndex]->Countries as $Country) {
                        echo
                            '<tr>
                                <td>' . $Country->ID . '</td>
                                <td>' . $Country->Name . '</td>
                                <td>' . $Country->Description . '</td>
                                <td>
                                    <form method="POST">
                                        <button class="btn btn-success" name="editCountry"  value="' . $Country->ID . '" data-toggle="modal" data-target="#editModal">Edit</button>
                                        <button class="btn btn-danger" name="deleteCountry" value="' . $Country->ID . '">Delete</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" action="state.php">   
                                        <button class="btn btn-dark" name="countryID" value="'.$Country->ID.'">States</button>
                                    </form>
                                </td>                    
                            </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>