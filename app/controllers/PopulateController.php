<?php

class PopulateController extends BaseController {

    public function populate(){
        require '../vendor/autoload.php';

        // Pacientes
        for ($i=0; $i < 200; $i++)
        {
            $faker = Faker\Factory::create('es_ES');
            //$nb = array('mujer','varon');
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
                $sexo = "mujer";
            }
            //$sexo = $faker->words('mujer','varon');
            $Direccion = $faker->streetAddress;
            $addrnamestre = $faker->streetName;
            $addrtel1 = $faker->phoneNumber;
            $addrtel2 = $faker->phoneNumber;
            $terrdesc = $faker->state;
            $addrpostcode = $faker->postcode;
            $compania = $faker->numberBetween(1, 7);

            $compania2 = $faker->numberBetween(0, 3);
            while ($compania2 == $compania) {
                $compania2 = $faker->numberBetween(0, 3);
            }

            $populator = array('numerohistoria'=>$numerohistoria,'apellido1'=>$apellido1,'apellido2'=>$apellido2,
            'nombre'=>$nombre,'NIF'=>$NIF,'fechanacimiento'=>$fechanacimiento,'sexo'=>$sexo,'Direccion'=>$Direccion,
            'addrnamestre'=>$addrnamestre,'addrtel1'=>$addrtel1,'addrtel2'=>$addrtel2,'terrdesc'=>$terrdesc,
            'addrpostcode'=>$addrpostcode,'compania'=>$compania,'compania2'=>$compania2);


            //Populate::;

            Pacientes::create($populator);

        }
        //$extracto = Populate::table('pacientes')->lists('nombre','sexo');
        //var_dump($extracto);

        // Profesionales
        for ($i=0; $i < 4; $i++)
        {
            $faker = Faker\Factory::create('es_ES');
            $nombre = $faker->firstname;
            $apellido1 = $faker->lastname;
            $apellido2 = $faker->lastname;
            $especialidades_id = $faker->randomNumber(4);
            $populator = array('nombre'=>$nombre, 'apellido1'=>$apellido1,'apellido2'=>$apellido2, 'especialidades_id'=>$especialidades_id);

            PopulateProfesional::create($populator);

        }
    }

}
