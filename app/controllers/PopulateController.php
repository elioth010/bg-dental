<?php

class PopulateController extends BaseController {

  public function populate(){ 
  require '../vendor/autoload.php';
    
  for ($i=0; $i < 200; $i++)
    {
    $faker = Faker\Factory::create('es_ES');
    //$nb = array('hembra','varon');
    $nombre = $faker->firstname;
    $numerohistoria = $faker->unique()->randomNumber(4);
    $apellido1 = $faker->lastname;
    $apellido2 = $faker->lastname;
    $NIF_nr = $faker->randomNumber(8);
    $NIF_ltr = $faker->randomLetter;
    $NIF = $NIF_nr.$NIF_ltr;
    $fechanacimiento = $faker->dateTimeThisCentury;
    $title = $faker->title;
    if($title == 'Mr.'){
	$sexo = "varon";
	} else {
	  $sexo = "hembra";
	  }
    //$sexo = $faker->words('hembra','varon');
    $Direccion = $faker->streetAddress;
    $addrnamestre = $faker->streetName;
    $addrtel1 = $faker->phoneNumber;
    $addrtel2 = $faker->phoneNumber;
    $terrdesc = $faker->state;
    $addrpostcode = $faker->postcode;
    $populator = array('numerohistoria'=>$numerohistoria,'apellido1'=>$apellido1,'apellido2'=>$apellido2,
		'nombre'=>$nombre,'NIF'=>$NIF,'fechanacimiento'=>$fechanacimiento,'sexo'=>$sexo,'Direccion'=>$Direccion,
		'addrnamestre'=>$addrnamestre,'addrtel1'=>$addrtel1,'addrtel2'=>$addrtel2,'terrdesc'=>$terrdesc,'addrpostcode'=>$addrpostcode);
   
    
    //Populate::;
    Populate::create(array('numerohistoria'=>$numerohistoria,'apellido1'=>$apellido1,'apellido2'=>$apellido2,
		'nombre'=>$nombre,'NIF'=>$NIF,'fechanacimiento'=>$fechanacimiento,'sexo'=>$sexo,'Direccion'=>$Direccion,
		'addrnamestre'=>$addrnamestre,'addrtel1'=>$addrtel1,'addrtel2'=>$addrtel2,'terrdesc'=>$terrdesc,'addrpostcode'=>$addrpostcode))->setConnection('quiron');
    
    }
    //$extracto = Populate::table('pacientes')->lists('nombre','sexo');
    //var_dump($extracto);
}

}