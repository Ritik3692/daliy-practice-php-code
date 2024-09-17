<?php
class Mtha
{
    function sum($a,$b)
    {
        echo $a+$b;
    }
    function sub($a,$b)
    {
        echo $a-$b;
    }
    function multi($a,$b)
    {
        echo $a*$b;
    }
}
$math1 = new Mtha();
$math1->sum(45,45);
echo"<br>";
$math2 = new Mtha();
$math2->sum(10000,4512);
echo"<br>";
$math3 = new Mtha();
$math3->sum(2541,278);
?>
<!-- the both ar class and object exp -->
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
