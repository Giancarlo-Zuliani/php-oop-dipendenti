<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>PHP-OOP-DIPENDENTI</title>
    <script <script src="script/script.js" charset="utf-8"></script>
    <link rel="stylesheet" href="style/style.css">
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
          return $this -> lastname;
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
      }

      $gigio = new Person('gigio','fracul',"10/10/2001", 'F');

      echo $gigio -> getName() . $gigio -> getDateOfBirth() . "<br>" . $gigio -> getAge();
     ?>

  </body>
</html>
