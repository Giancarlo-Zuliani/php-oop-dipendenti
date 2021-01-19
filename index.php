<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PHP-OOP-DIPENDENTI</title>
    <script <script src="script/script.js" charset="utf-8"></script>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>

    <?php

      class Person{
        private $name;
        private $lastName;
        private $dateOfBirth;
        private $genre;
        public function __construct($name,$lastName,$dateOfBirth,$genre){
          $this -> setName($name);
          $this -> setLastName($lastName);
          $this -> setDateOfBirth($dateOfBirth);
          $this -> setGenre($genre);
        }
        public function setName($name){
          $this -> name = $name;
        }
        public function getName(){
          return $this -> name;
        }
        public function setLastName($lastName){
          $this -> lastName = $lastName;
        }
        public function getLastName(){
          return $this -> lastName;
        }
        public function setDateOfBirth($dateOfBirth){
          $this -> dateOfBirth = $dateOfBirth;
        }
        public function getDateOfBirth(){
          return $this -> dateOfBirth;
        }
        public function setGenre($genre){
          $this -> genre = $genre;
        }
        public function getGenre(){
          return $this -> genre;
        }
        public function getAge(){
          $x = strtotime(str_replace("/","-", $this -> dateOfBirth));
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

      $gigio = new Person('gigio','fracul',"10/10/2001", 'F');
      $bruno = new Person('bruno','brespa','25/12/1980' ,'M');

      echo $gigio . $bruno;

      class Employee extends Person{
        private $tasks;
        private $salary;
        public function __construct($name,$lastName,$dateOfBirth,$genre,$tasks,$salary){
          parent::__construct($name,$lastName,$dateOfBirth, $genre);
          $this -> setSalary($salary);
          $this -> setTasks($tasks);
        }
        public function setTasks($tasks){
          $this -> tasks = $tasks;
        }
        public function getTasks(){
          return $this -> tasks;
        }
        public function setSalary($salary){
          $this -> salary = $salary;
        }
        public function getSalary(){
          return $this -> salary;
        }
        public function __toString(){
          return parent::__toString()
          . "<ul><li>" . "DO : " . $this -> getTasks() . "</li>"
          ."<li>" . "TAKE : " . $this -> getSalary() . "</li></ul>";
        }
      }

      $caio = new Employee ('caio' , 'santin' , "10/4/1989" ,'M' , "burn stuff" , "400$/week");
      echo $cai0;

      class Boss extends Employee {
        private $benefits;
        public function __construct($name,$lastName,$dateOfBirth,$genre,$tasks,$salary,$benefits){
          parent::__construct($name,$lastName,$dateOfBirth,$genre,$tasks,$salary);
          $this -> setBenefits($benefits);
        }
        public function setBenefits($benefits){
          $this -> benefits = $benefits;
        }
        public function getBenefits(){
          return $this -> benefits;
        }
        public function __toString(){
          return parent::__toString()
          ."<h6>" . $this -> getBenefits() . "</h6>";
        }
      }

      $tulio = new Boss('Tulio','piscopo',"1/1/1919", 'X' , 'Nothing' , 'TooMuch/s','Personal Boat');

      echo $tulio;
     ?>

  </body>
</html>
