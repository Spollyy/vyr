<?php

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert(array(
            array('login' => 'admin', 'file'=>'php8bfxwr','name' => 'Дарт Алексеевич Вейдер','email' => 'admin@admin.com', 'password' => Hash::make('123123'),'phone' => '89123456789','add_phone' => '83434567891', 'adress' => 'Ленина 60', 'status'=>'Оба', 'notification1' => true, 'rating' => 5.0, 'save' => 9999, 'being_saved' => 3)));

        DB::table('users')->insert(array(
            array('login' => 'jery', 'file'=>'phpCf6dn1', 'name' => 'Гранд Мастер-Джейдай Йода','email' => 'jery@admin.com', 'password' => Hash::make('123123'),'phone' => '89123456789','add_phone' => '83434567891', 'adress' => 'Ленина 60', 'status'=>'Оба', 'notification1' => true, 'rating' => 5.0, 'save' => 9999, 'being_saved' => 3)));
    }
}


