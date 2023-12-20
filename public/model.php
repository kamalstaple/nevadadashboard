<?php
// include 'db.php';

class Model
{
    
    public function __construct(){
       
    }
    private function executeQuery($query){
        $conn = mysqli_connect('localhost','root','','nevadadashboard');
        $result = mysqli_query($conn, $query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {            
                $data = $row['data'];
                return $data;
            }
        } else {
            return "Error executing query: " . mysqli_error($conn);
        }
    }
    public function home($action)
    {
       
        $query = "SELECT `data` FROM `home` WHERE `action` = '".$action."'";
        return $this->executeQuery($query);
        
    }
    public function statewide_data($tab, $action)
    {
        $query = "SELECT `data` FROM `statewide_data` WHERE `tab` = '".$tab."' AND `action` = '".$action."'";
        return $this->executeQuery($query);

    }
    public function quick_chart($ids,$action){
        
        $query = "SELECT `data` FROM `statewide_data` WHERE  `ids` = '".$ids."' AND `action` = '".$action."'";
        return $this->executeQuery($query);
    }
    public function economic_development($action){
    
        $query = "SELECT `data` FROM `economic_development` WHERE `action` = '".$action."'";
        return $this->executeQuery($query);
    }
    public function location_comparison($action){
       
        $query = "SELECT `data` FROM `location_comparison` WHERE `action` = '".$action."'";
        return $this->executeQuery($query);
    }
}
$Model = new Model();
 // echo $Model->home('home');
?>