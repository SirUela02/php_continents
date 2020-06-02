<?php
class Continent{
    public $ID;
    public $Name;
    public $Description;
    public $Countries = [];

    function __construct($ID = null, $Name = null, $Description = null){
        $this-> ID = $ID;
        $this-> Name = $Name;
        $this-> Description = $Description;
    }

    public function AddCountry(Country $Country, $ContinentArray = []){
        foreach ($ContinentArray as $Continent){            
            foreach($Continent->Countries as $inArrayCountry){
                if($inArrayCountry->ID == $Country->ID){
                    $Exists = true;
                }
            }            
        }

        if ($Exists) {
            return $Exists;
        }
        else{
            array_push($this->Countries,$Country);
            return false;
        }    
    }

    public function DeleteCountry($ID){
        $CountryIndex = array_search($ID,array_column($this->Countries, 'ID'),false);
        unset($this->Countries[$CountryIndex]);
        $this->Countries = array_values($this->Countries);

       
    }

    public function EditCountry($ID, $NewName, $NewDesc){
        $CountryIndex =  array_search($ID,array_column($this->Countries, 'ID'),false);
        $this->Countries[$CountryIndex]->Name = $NewName;
        $this->Countries[$CountryIndex]->Description = $NewDesc;
    }
}

class Country{
    public $ID;
    public $Name;
    public $Description;

    function __construct($ID = null, $Name = null, $Description = null){
        $this-> ID = $ID;
        $this-> Name = $Name;
        $this-> Description = $Description;
    }
}


class State{
    public $ID;
    public $CountryID;
    public $Name;
    public $Description;

    function __construct($ID = null, $CountryID = null, $Name = null, $Description = null){
        $this->ID = $ID;
        $this->CountryID = $CountryID;
        $this->Name = $Name;
        $this->Description = $Description;
    }

    public static function AddState(State $State, &$StatesArray, $CurrentCountryID){
        foreach($StatesArray as $inArrayState){
            if($State->CountryID == $CurrentCountryID && $State->ID == $inArrayState->ID){          
                $Exists = true;
            }
        }
        if ($Exists) {
            return true;
        }
        else{
            array_push($StatesArray,$State);
            return false;
        }    
    }

    public static function EditState($ID, $NewName, $NewDesc, &$StatesArray){
        $StateIndex =  array_search($ID,array_column($StatesArray, 'ID'),false);
        $StatesArray[$StateIndex]->Name = $NewName;
        $StatesArray[$StateIndex]->Description = $NewDesc;
    }

    public static function DeleteState($ID,  &$StatesArray){
        $StateIndex = array_search($ID,array_column($StatesArray, 'ID'),false);
        unset($StatesArray[$StateIndex]);
        $StatesArray = array_values($StatesArray);
    }
}

class DataBase{
    public static function ConnectDB(){
        $host = "localhost";
        $port = "5432";
        $db = "php_world";

       $connection = pg_connect($host,$port,$db);

        if($connection) {
            return 'connected';
        } 

        return 'there has been an error connecting';       
    }


}

$Continents = [
    new Continent(1,'Americas','The Americas comprise the totality of the continents of North and South America.Together, they make up most of the land in Earths western hemisphere and comprise the New World'),
    new Continent(2,'Africa','Africa is the worlds second-largest and second-most populous continent, after Asia. At about 30.3 million km2 (11.7 million square miles) including adjacent islands, it covers 6% of Earths total surface area and 20% of its land area.'),
    new Continent(3,'Asia','Asia is Earths largest and most populous continent, located primarily in the Eastern and Northern Hemispheres.'),
    new Continent(4,'Oceania','Oceania is a geographic region that includes Australasia, Melanesia, Micronesia and Polynesia.'),
    new Continent(5,'Europa','Europe is a continent located entirely in the Northern Hemisphere and mostly in the Eastern Hemisphere.')
];

$States = [];

?>