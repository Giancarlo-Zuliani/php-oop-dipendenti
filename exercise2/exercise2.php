<!DOCTYPE html>
<html lang="" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>php-oop-dipendenti-2</title>
    <link rel="stylesheet" href="../style/style.css">
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
            throw new Exception("name need at least 3 charact");
          };
          $this -> name  = $name;
        }
        public function getName(){
          return $this -> name;
        }
        public function setLastName($lastname){
          if(strlen($lastname) < 3){
            throw new Exception("last name need at least 3 charact");
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
            throw new Exception("Genre must be indentified with m or f");
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
          return '<ul>'
            . '<li>name: ' . $this -> getName() .'</li>'
            . '<li>lastname: ' . $this -> getLastName() .'</li>'
            . '<li>age: ' . $this -> getAge() .'</li>'
            . '<li>genre: ' . $this -> getGenre() .'</li></ul>';
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
            throw new Exception("Ral not in range");
          }
          $this -> ral = $ral;
        }
        public function getRal(){
          return $this -> ral;
        }
        public function setSecLvl($secLvl){
          if($secLvl < 1 || $secLvl > 5 ){
            throw new Exception("Security level not in range for Employee");
          }
          $this -> secLvl = $secLvl;
        }
        public function __toString(){
          return parent::__toString()
          . "tasks: " . $this -> tasks
          . "Ral: " . $this -> ral
          ."seclvl: " . $this -> secLvl;
        }
      }



      class Boss extends Employee {
        private $benefits;
        private $employes;
        public function __construct($name,$lastname,$dateofbirth,$genre,$tasks,$ral,$secLvl,$benefits,$employes){
          parent::__construct($name,$lastname,$dateofbirth,$genre,$tasks,$ral,$secLvl);
          $this -> setBenefits($benefits);
          $this -> setEmployes($employes);
        }
        public function setBenefits($benefits){
          $this -> benefits = $benefits;
        }
        public function getBenefits(){
          return $this -> benefits;
        }
        public function getEmployes(){
          return $this -> employes;
        }
        public function setEmployes($employes){
          if ($employes == [] || !is_array($employes)){
            throw new Exception("employes list not valid");
          }
          $this -> employes = $employes;
        }
        public function getEmployesStr(){
          $str = "";
          for ($i=0; $i < count($this -> getEmployes()) ; $i++) {
            $emp = $this -> getEmployes()[$i];
            $empname = $emp -> getName() . ' ' . $emp -> getLastName();
            $str .= ($i + 1) . ': ' . $empname . '<br>';
          }
          return $str;
        }
        public function setSecLvl($secLvl){
          if($secLvl < 6 || $secLvl > 10){
            throw new Exception("security level not valid for boss class");
          }
          $this -> secLvl = $secLvl;
        }
        public function __toString(){
          return parent::__toString()
          . "<h3>" . $this -> benefits ."</h3>"
          . $this -> getEmployesStr();
        }
      }


        $a = new Employee('tozzi' , 'fan' , "25/12/1989" , "M" , "ragioniere" , 10001 , 4);

        $b = new Employee('fan' ,'tozzi' , '25/15/1988' , "F" , "capitano", 15000 , 3);

        $emparr = [];
        array_push($emparr , $a ,$b , );


        $boss = new Boss('mega' , 'direttore' , '25/12/1955' , 'F' , 'megadirettore' ,25000 , 8 , 'barca' , $emparr);

      try {
        $newperson = new Person('ca' , 'zu' , '11/11/2011' ,'m');
      } catch (Exception $e) {
        echo $e;
      }


    ?>
  </body>
</html>
