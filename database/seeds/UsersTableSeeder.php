<?php

use Illuminate\Database\Seeder;
use sis5cs\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //bcrypt
     User::create([
        'name'=>'Juan Carlos',
        'email'=>'admin@sanmartin.com.bo',
        'password'=>bcrypt('123456'),
        'id_rol'=>1         
    ]);
     User::create([
        'name'=>'Hernan Flores',
        'email'=>'jefecredito@sanmartin.com.bo',
        /*'password'=>bcrypt('123456'),v bb   */
        'password'=>bcrypt('jefecredito'),
        'id_rol'=>2
    ]);
     User::create([
        'name'=>'Pedro Lopez',
        'email'=>'oficial@sanmartin.com.bo',
        /*'password'=>bcrypt('123456'),*/
        'password'=>bcrypt('oficial'),
        'id_rol'=>3
    ]);
     User::create([
        'name'=>'Javier Gomez',
        'email'=>'cliente@sanmartin.com.bo',
        /*'password'=>bcrypt('123456'),*/
        'password'=>bcrypt('cliente'),
        'id_rol'=>5
    ]);
     User::create([
        'name'=>'Jeannete Cardozo',
        'email'=>'plataforma@sanmartin.com.bo',
        /*'password'=>bcrypt('123456'),*/
        'password'=>bcrypt('plataforma'),
        'id_rol'=>4
    ]);

     User::create([
        'name'=>'Ivan Romero Ferrufino',
        'email'=>'iromero@sanmartin.com.bo',
        'password'=>bcrypt('ivrofe'),
        'id_rol'=>3
    ]);
     User::create([
        'name'=>'Irma Pacheco Marquez',
        'email'=>'ipacheco@sanmartin.com.bo',
        'password'=>bcrypt('irpama'),
        'id_rol'=>3
    ]);
     User::create([
        'name'=>'Jaime Bravo Cabrera',
        'email'=>'jbravo@sanmartin.com.bo',
        'password'=>bcrypt('jabrca'),
        'id_rol'=>3
    ]);
     User::create([
        'name'=>'Patty',
        'email'=>'riesgos@sanmartin.com.bo',
        'password'=>bcrypt('riesgos'),
        'id_rol'=>6
    ]);

      User::create([
        'name'=>'Limber',
        'email'=>'asesoria@sanmartin.com.bo',
        'password'=>bcrypt('asesoria'),
        'id_rol'=>7
    ]);
    
      User::create([
        'name'=>'Fernando Fernandez',
        'email'=>'comite@sanmartin.com.bo',
        'password'=>bcrypt('comite'),
        'id_rol'=>8
    ]);
 }
}
