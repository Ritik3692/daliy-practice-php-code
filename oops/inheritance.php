<?php
class UserAuth
{
    function login($userType)
    {
        echo $userType . " logged in";
    }
}
class Student extends UserAuth
{
    function Name($name)
    {
        echo $name;
    }
}
class Teacher extends UserAuth
{
}
$s1 = new Student();
$s1->name('Ritik');

$s1->login("student");
echo "<br>";
$s2 = new Student();
$s2->name('Rahul');
$s2->login("student");
echo "<br>";
$t2 = new Teacher();
$t2->login("Teacher");
