<?php

class Controller {
    private $conn;

    public function __construct($host, $dbname, $username, $password)
    {

        $conn = new PDO("mysql:host=".$host.";dbname=".$dbname.";",$username, $password);

        $this->conn = $conn;

    }

    // DISPLAY ALL EMPLOYEES
    public function show_employees()
    {
        $query = "SELECT * FROM employee";
        $stm = $this->conn->prepare($query);
        
        if($stm->execute() == true)
        {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach($result as $key => $i)
            {
            echo "<option>".
                $i -> EmployeeName."</br>".
                "</option>";
            } 
        }
        
    }

    // DISPLAY ALL PROJECTS
    public function show_projects()
    {
        $query = "SELECT * FROM project";
        $stm = $this->conn->prepare($query);
        
        if($stm->execute() == true)
        {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach($result as $key => $i)
            {
            echo "<option>".
                $i -> ProjectTitle."</br>".
                "</option>";
            } 
        }
        
    }

    // CALCULATE HOURS
    public function calculate_hours($calculate)
    {
        $hours = intval($calculate/3600);
        $seconds = ($calculate - ($hours *3600));
        $minutes = intval($seconds/60);

        echo $hours.":".$minutes;
    }

    // GET EMPLOYEE NUMBER FROM DB
    public function getId($name) {

        $query = "SELECT * FROM Employee WHERE Employee.EmployeeName = :eName";
        $stm = $this->conn->prepare($query);
        $stm->bindparam(":eName", $name);

        if($stm->execute() == true)
        {
            $i = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach($i as $item)
            {
                echo $item -> EmployeeNo;
            }
        }
    }

    // GET PROJECT CODE FROM DB
    public function getProjectCode($project) {

        $query = "SELECT * FROM Project WHERE project.ProjectTitle = :projectT";
        $stm = $this->conn->prepare($query);
        $stm->bindparam(":projectT", $project);

        if($stm->execute() == true)
        {
            $i = $stm->fetchAll(PDO::FETCH_OBJ);
            foreach($i as $item)
            {
                echo $item -> ProjectCode;
            }
        }
    }
    
    // SAVE DATA IN DB
    public function register($projectCode, $employeeNo, $date, $total)
    {
        $query = "INSERT INTO worked (ProjectCode, EmployeeNo, WorkDate, Duration) VALUES ('$projectCode', '$employeeNo', '$date', $total)";
        $stm= $this -> conn ->prepare($query);
        if($stm->execute()) {
            echo "Uren opgeslagen";
        }
        else {
            echo "Sommige velden zijn niet ingevoeld. Probeer opnieuw";
        }
    }
}
