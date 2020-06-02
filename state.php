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
            <a href="countries.php" class="btn btn-dark">Countries</a>
            <button class="btn btn-dark" data-toggle="modal" data-target="#addModal">Add State</button>
        </div>
    </nav>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New State</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="state.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="stateID">ID</label>
                            <input type="text" class="form-control" id="stateID" name="stateID" placeholder="Enter id...">
                        </div>
                        <div class="form-group">
                            <label for="contryName">Name</label>
                            <input type="text" class="form-control" id="stateName" name="stateName" placeholder="Enter name...">
                        </div>
                        <div class="form-group">
                            <label for="contryDesc">Description</label>
                            <textarea class="form-control" id="stateDesc" name="stateDesc" placeholder="Enter description..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="stateAdd" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editStateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit state</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="state.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" id="editStateID" name="editStateID" value="<?php echo $_POST["editState"] ?>">
                            </div>
                            <div class="form-group">
                                <label for="editContryName">Name</label>
                                <input type="text" class="form-control" id="editStateName" name="editStateName" placeholder="Enter name...">
                            </div>
                            <div class="form-group">
                                <label for="editContryDesc">Description</label>
                                <textarea class="form-control" id="editStateDesc" name="editStateDesc" placeholder="Enter description..."></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="stateEdit" class="btn btn-primary">Save changes</button>
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
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($States as $State) {
                        if ($State->CountryID == $_SESSION["CurrentCountryID"]) {
                            echo
                            '<tr>
                                <td>' . $State->ID . '</td>
                                <td>' . $State->Name . '</td>
                                <td>' . $State->Description . '</td>
                                <td>
                                    <form method="POST">
                                        <button class="btn btn-success" name="editState"  value="' . $State->ID . '" data-toggle="modal" data-target="#editStateModal">Edit</button>
                                        <button class="btn btn-danger" name="deleteState" value="' . $State->ID . '">Delete</button>
                                    </form>
                                </td>                   
                            </tr>';
                        }
                        
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