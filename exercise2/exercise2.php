<!DOCTYPE html>
<html lang="" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>php-oop-dipendenti-2</title>
    <link rel="stylesheet" href="../style.css">
  </head>
  <body>

    <?php

      class Person {
        private $name;
        private $lastname;
        private $dateofbirth;
        private $genre;

        public function __construct($name ,$lastname ,$dateofbirth, $genre){
          $this -> setName($name);
          $this -> setLastName($lastname);
          $this -> setDateOfBirth($dateofbirth);
          $this -> setGenre($genre);
        }

        public function setName($name){
          if (strlen($name) < 3){
            throw new Exception('name must contain at least 3 character');
          };
          $this -> name  = $name;
        }

        public function getName(){
          return $this -> name;
        }

        public function setLastName($lastname){
          if(strlen($lastname) < 3){
            throw new Exception('name must contain at least 3 character');
          }
          $this -> lastname = $lastname;
        }

        public function getLastName(){
          return $this -> lastname;
        }
        public function setDateOfBirth($dateofbirth){
          $this -> dateofbirth = $dateofbirth;
        }

        public function getDateOfBirth(){
          return $this -> dateofbirth;
        }

        public function setGenre($genre){
          if(!(strtolower($genre) == "m" || strtolower($genre) == "f")){
            throw new Exception('genre must be declared with M or F');
          }
          $this -> genre = $genre;
        }

        public function getGenre(){
          return $this -> genre;
        }

        public function getAge(){
          $x = strtotime(str_replace("/","-", $this -> dateofbirth));
          $tdate = time();
          $age = 0;
          while ($tdate > $x = strtotime('+1 year' , $x)){
            ++$age;
          }
          return $age;
        }

        public function __toString(){
          return
              '<h5>name: ' . $this -> getName() .'</h5>'
            . '<h5>lastname: ' . $this -> getLastName() .'</h5>'
            . '<h5>age: ' . $this -> getAge() .'</h5>'
            . '<h5>genre: ' . $this -> getGenre() .'</h5>';
        }
      }

      class Employee extends Person{

        private $tasks;
        private $ral;
        private $secLvl;

        public function __construct($name,$lastname,$dateofbirth,$genre,$tasks,$ral,$secLvl){
          parent::__construct($name,$lastname,$dateofbirth,$genre);
          $this -> setTasks($tasks);
          $this -> setRal($ral);
          $this -> setSecLvl($secLvl);
        }

        public function setTasks($tasks){
          $this -> tasks = $tasks;
        }

        public function getTasks(){
          return $this -> tasks;
        }

        public function setRal($ral){
          if ($ral > 100000 || $ral < 10000){
            throw new Exception('R.A.L must be set between 10.000 and 100.000');
          }
          $this -> ral = $ral;
        }

        public function getRal(){
          return $this -> ral;
        }

        public function setSecLvl($secLvl){
          if($secLvl < 1 || $secLvl > 5 ){
            throw new Exception('Employee security level must be between 1 and 5');
          }
          $this -> secLvl = $secLvl;
        }

        public function __toString(){
          return parent::__toString()
          . "<h5>tasks: " . $this -> tasks . "</h5>"
          . "<h5>Ral: " . $this -> ral . "</h5>"
          . "<h5>seclvl: " . $this -> secLvl . "</h5>";
        }
      }

      class Boss extends Employee {

        private $benefits;
        private $Employees;

        public function __construct($name,$lastname,$dateofbirth,$genre,$tasks,$ral,$secLvl,$benefits,$Employees = []){
          parent::__construct($name,$lastname,$dateofbirth,$genre,$tasks,$ral,$secLvl);
          $this -> setSecLvl($secLvl);
          $this -> setBenefits($benefits);
          $this -> setEmployees($Employees);
        }

        public function setBenefits($benefits){
          $this -> benefits = $benefits;
        }

        public function getBenefits(){
          return $this -> benefits;
        }

        public function getEmployees(){
          return $this -> Employees;
        }

        public function setEmployees($Employees){
          if ($Employees == [] || !is_array($Employees)){
            throw new Exception('employees list must contain at least one Employee');
          }
          $this -> Employees = $Employees;
        }

        public function getEmployeesStr(){
          $str = "<ol><h4> Employees list</h4>";
          for ($i=0; $i < count($this -> getEmployees()) ; $i++) {
            $emp = $this -> getEmployees()[$i];
            $empname = $emp -> getName() . ' ' . $emp -> getLastName();
            $str .= "<li>" . $empname . '</li>';
          }
          $str .= "</ol>";
          return $str;
        }

        public function setSecLvl($secLvl){
          if($secLvl < 6 || $secLvl > 10){
            throw new Exception('security level for Boss must be between 5 and 10');
          }
          $this -> secLvl = $secLvl;
        }

        public function __toString(){
          return
            '<h5>name: ' . $this -> getName() .'</h5>'
          . '<h5>lastname: ' . $this -> getLastName() .'</h5>'
          . '<h5>age: ' . $this -> getAge() .'</h5>'
          . '<h5>genre: ' . $this -> getGenre() .'</h5>'
          . "<h5>tasks: " . $this -> tasks . "</h5>"
          . "<h5>Ral: " . $this -> ral . "</h5>"
          . "<h5>seclvl: " . $this -> secLvl . "</h5>"
          ."<h5> secLVL: " . $this -> secLvl ."</h5>"
          . "<h5>" . $this -> benefits ."</h5>"
          . $this -> getEmployeesStr();
        }
      }
      ?>

      <main>

        <?php

          try {

            $a = new Employee('tozzi' , 'fan' , "25/12/1989" , "M" , "ragioniere" , 10001 , 4);
            $b = new Employee('fan' ,'tozzi' , '25/15/1988' , "F" , "capitano", 15000 , 3);
            $emparr = [];
            array_push($emparr , $a ,$b);
            $boss = new Boss('mega' , 'direttore' , '25/12/1955' , 'F' , 'megadirettore' ,25000 , 8 , 'barca' , $emparr);
            $bestBoss = new Boss('mega' , 'direttore' , '25/12/1998', 'f' ,'megadirettore' , 20000 , 8 , 'personal boat party every week',$emparr );
          }

          catch (Exception $e) {
            echo '<h4>'. $e -> getMessage() .'</h4><br>';
          }

          finally{
            echo '<hr>';
            echo $bestBoss;
            echo '<hr>';
          }

        ?>

      </main>


  </body>
</html>
