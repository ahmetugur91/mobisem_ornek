<?php

use App\Location;
use App\LocationDetail;
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
        \App\User::create([
            "name" => "Demo",
            "email" => "demo@mobisem.com",
            "password" => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi",
        ]);


        factory(App\User::class, 50)->create()->each(function ($user) {

            $user->locations()->saveMany(factory(App\Location::class,5)->make());

            $user->locations->each(function ($location){
                $location->detail()->save(factory(App\LocationDetail::class)->make());
            });

        });
    }
}
