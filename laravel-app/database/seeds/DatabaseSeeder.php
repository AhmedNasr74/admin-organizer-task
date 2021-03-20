<?php

use App\Organizer;
use App\Event;
use App\User;
use Illuminate\Console\Concerns\InteractsWithIO;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Output\ConsoleOutput;

class DatabaseSeeder extends Seeder
{
    use InteractsWithIO;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $admin = User::create([
            'name' => 'Ahmed Nsr',
            'email' => 'admin@admin.com',
            'password' => '123456789'
        ]);
        factory(Organizer::class , 10)->create();
        factory(Event::class  , 50)->create();

        $organizer = Organizer::first();
        $out =new ConsoleOutput();
        $out->writeln("Admin Email: $admin->email , Password : 123456789" );
        $out->writeln("Organizer Email: $organizer->email , Password : 123456789" );
    }
}
