<?php
    session_start();
     
    //CONTINENTS SESSION
    if (!isset($_SESSION["Continents"])) {
        $_SESSION["Continents"] = $Continents; 
    } 

    if (isset($_SESSION["Continents"])) {
       $Continents = $_SESSION["Continents"];
    }
    
    //STATE SESSION
    if (!isset($_SESSION["States"])) {
        $_SESSION["States"] = $States; 
    } 

    if (isset($_SESSION["States"])) {
       $States = $_SESSION["States"];
    }


    //CONTINENT ID
    if (isset($_POST["continentID"])) {
        $ID = $_POST["continentID"];
        $ContinentIndex = array_search($ID, array_column($Continents, 'ID'), false);
        $_SESSION["ContID"] = $ContinentIndex;
    }

    //COUNTRY ID
    if (!isset($_SESSION["CurrentCountryID"])) {
        $_SESSION["CurrentCountryID"] = null;
    }

    if (isset($_POST["countryID"])) {
        $_SESSION["CurrentCountryID"] = $_POST["countryID"];
    }
    

    //CONTINENT INDEX
    if (!isset($_SESSION["ContID"])) {
        $_SESSION["ContID"] = 0;
    }
    
    if (isset($_SESSION["ContID"])) {
        $ContinentIndex = $_SESSION["ContID"];
    }
    
    //COUNTRY ADD
    if (isset($_POST["countryAdd"])) {
        $NewCountry = new Country($_POST["countryID"], $_POST["countryName"], $_POST["countryDesc"]);
        $Exists = $Continents[$ContinentIndex]->AddCountry($NewCountry, $Continents);
        $_SESSION["Continents"] = $Continents;
        if ($Exists == true) {
            echo '<script>';
                echo"alert('INVALID ID')";
            echo '</script>';
        }
    }

    //STATE ADD
    if (isset($_POST["stateAdd"])) {
        $NewState = new State($_POST["stateID"],$_SESSION["CurrentCountryID"], $_POST["stateName"], $_POST["stateDesc"]);
        $Exists = State::AddState($NewState, $States, $_SESSION["CurrentCountryID"]);
        $_SESSION["States"] = $States;
        if ($Exists == true) {
            echo '<script>';
                echo"alert('INVALID ID')";
            echo '</script>';
        }
    }
    
    if (isset($_POST["editCountry"])) {
        echo '<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>';
        echo '<script>';
        echo "
            $(document).ready(function() {
                $('#editModal').modal('show');
            });  
        ";
        echo '</script>';
    }

    if (isset($_POST["editState"])) {
        echo '<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>';
        echo '<script>';
        echo "
            $(document).ready(function() {
                $('#editStateModal').modal('show');
            });  
        ";
        echo '</script>';
    }
    
    //COUNTRY DELETE AND UPDATE
    if (isset($_POST["countryEdit"])) {
        $Continents[$ContinentIndex]->EditCountry($_POST["editCountryID"], $_POST["editCountryName"], $_POST["editCountryDesc"]);
    }
    
    if (isset($_POST["deleteCountry"])) {
        $Continents[$ContinentIndex]->DeleteCountry($_POST["deleteCountry"]);
        foreach($States as $State){
            if ($State->CountryID == $_POST["deleteCountry"]) {
                State::DeleteState($State->ID, $States);
                $_SESSION["States"] = $States;
            }
        }
    }

    //STATE DELETE AND UPDATE
    if (isset($_POST["stateEdit"])) {
        State::EditState($_POST["editStateID"], $_POST["editStateName"], $_POST["editStateDesc"], $States);
    }
    
    if (isset($_POST["deleteState"])) {
        State::DeleteState($_POST["deleteState"], $States);
        $_SESSION["States"] = $States;
    }

    $ConnectionStatus = DataBase::ConnectDB();
    if (isset($_POST["SaveDB"])) {
        
        foreach ($Continents as $Continent) {
            $exists = "SELECT * FROM continents";
            $result = pg_query($exists) or die("Query could not be executed");
            var_dump($result);
            var_dump(pg_num_rows($result));
            if(pg_num_rows($result))
            {
                $existsValidation = true;
            }
            else
            {
                $ContQuery = "INSERT INTO continents VALUES ('$Continent->ID','$Continent->Name',
                '$Continent->Description')";
                $result = pg_query($ContQuery) or die("Query could not be executed"); 
            }           
        }
        
        if ($existsValidation){
            echo '
                    <script>
                        alert("Continents already exists");
                    </script>
            ';
        }
    }
?>
