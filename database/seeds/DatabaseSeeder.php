<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $archivo_csv = storage_path().'/app/seeds/entidades_federativas.csv';
        $query = sprintf("
            LOAD DATA local INFILE '%s' 
            INTO TABLE entidades_federativas
            CHARACTER SET utf8 
            FIELDS TERMINATED BY ',' 
            OPTIONALLY ENCLOSED BY '\"' 
            ESCAPED BY '\\\\' 
            LINES TERMINATED BY '\\n' 
            IGNORE 1 LINES", addslashes($archivo_csv));
        DB::connection()->getpdo()->exec($query); 

        \App\User::create([
            'nombre_completo' => 'usuario root',
            'usuario' => 'root',
            'password' => Hash::make('ssa.donadores.txtla.2019'),
            'email' => 'root@localhost'
        ]);
    }
}
