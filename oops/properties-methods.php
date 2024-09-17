<!-- Properties: Variables that belong to a class.
Methods: Functions that belong to a class. -->
<?php
class Person
{
  public $name;
  public $age;

  public function __construct($name, $age)
  {
    $this->name = $name;
    $this->age = $age;
  }

  public function greet()
  {
    return "Hello, my name is " . $this->name . " and I am " . $this->age . " years old.";
  }
}

$person = new Person("John", 30);
echo $person->greet();
echo "<br>";
?>



<!--******************* static method  ************** -->
<?php
class Honda
{
  static public $myname="Ritik kumar";
  static function companyName()
  {
    echo "Honda";
  }
 
  static function companyName1()
  {
    echo " thi the best car on the word";
  }
}

Honda::companyName();
echo "<br/>";
Honda::companyName1();
echo "<br/>";
echo Honda::$myname;
?>


<!--*********************late static binding*********************** -->
<!--- -->
