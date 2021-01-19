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
            throw new invalidName;
          };
          $this -> name  = $name;
        }
        public function getName(){
          return $this -> name;
        }
        public function setLastName($lastname){
          if(strlen($lastname) < 3){
            throw new invalidName;
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
            throw new invalidGenre;
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
            throw new invalidRal;
          }
          $this -> ral = $ral;
        }
        public function getRal(){
          return $this -> ral;
        }
        public function setSecLvl($secLvl){
          if($secLvl < 1 || $secLvl > 5 ){
            throw new invalidSecLvl;
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
        private $Employees;
        public function __construct($name,$lastname,$dateofbirth,$genre,$tasks,$ral,$secLvl,$benefits,$Employees = []){
          parent::__construct($name,$lastname,$dateofbirth,$genre,$tasks,$ral,$secLvl);
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
            throw new invalidEmployeesList;
          }
          $this -> Employees = $Employees;
        }
        public function getEmployeesStr(){
          $str = "";
          for ($i=0; $i < count($this -> getEmployees()) ; $i++) {
            $emp = $this -> getEmployees()[$i];
            $empname = $emp -> getName() . ' ' . $emp -> getLastName();
            $str .= ($i + 1) . ': ' . $empname . '<br>';
          }
          return $str;
        }
        public function setSecLvl($secLvl){
          if($secLvl < 6 || $secLvl > 10){
            throw new invalidSecLvl;
          }
          $this -> secLvl = $secLvl;
        }
        public function __toString(){
          return parent::__toString()
          . "<h3>" . $this -> benefits ."</h3>"
          . $this -> getEmployeesStr();
        }
      }

      class invalidName extends Exception{};
      class invalidRal extends Exception{};
      class invalidSecLvl extends Exception{};
      class invalidEmployeesList extends Exception{};
      class invalidGenre extends Exception{};

        $a = new Employee('tozzi' , 'fan' , "25/12/1989" , "M" , "ragioniere" , 10001 , 4);

        $b = new Employee('fan' ,'tozzi' , '25/15/1988' , "F" , "capitano", 15000 , 3);

        $emparr = [];
        array_push($emparr , $a ,$b , );


        $boss = new Boss('mega' , 'direttore' , '25/12/1955' , 'F' , 'megadirettore' ,25000 , 8 , 'barca' , $emparr);

      try {
        $bestBoss = new Boss('mega' , 'direttore' , '25/12/1998', 'F' ,'megadirettore' , 20000 , 8 , 'personal boat party every week' );
      }
        catch (invalidName $e) {
          echo 'name too short';
        }
        catch (invalidRal $e){
          echo 'R.A.L not valid';
        }
        catch (invalidSecLvl $e){
          echo "invalid security level";
        }
        catch (invalidGenre $e){
          echo 'invalid genre character';
        }
        catch(invalidEmployeesList $e){
          echo 'invalide employees list';
        }

    ?>
  </body>
</html>
