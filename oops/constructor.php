<?php
class ConstructorDemo{
  public $name,$age;
    function __construct($name ,$age){
   $this->name=$name.":-age is".$age;
    }
    function displayName(){
        echo $this->name; 
    }
}

$cd=new ConstructorDemo("ritik jha",19);
$cd->displayName();
echo"<br/>";
$cd1=new ConstructorDemo( "Ritik Kashyap",22);
$cd1->displayName();
?>
<!--***************the both is the exp of __construct *********** -->
<?php
class Car {
  public $color;
  public $model;

  public function __construct($color, $model) {
    $this->color = $color;
    $this->model = $model;
  }

  public function message() {
    return "My car is a " . $this->color . " " . $this->model . ".";
  }
}

$myCar = new Car("black", "Volvo");
echo $myCar->message();
?>
