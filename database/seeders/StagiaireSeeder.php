<?php

namespace Database\Seeders;

use App\Models\Stagiaire;
use Illuminate\Database\Seeder;

class StagiaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stagiaires = [
            ['firstname' => 'Mohamed', 'lastname' => 'Mellali', 'cef' => '2006123456', 'email' => 'm.mellali@example.com', 'phone' => '06-6544-7890', 'address' => '123 Main Béni Mellal', 'date_of_birth' => '2006-10-07', 'city' => 'Béni Mellal', 'photo' => '/images/mohamed.jpg'],
            ['firstname' => 'Sara', 'lastname' => 'El Amrani', 'cef' => '2006123457', 'email' => 's.elamrani@example.com', 'phone' => '06-6544-7891', 'address' => '456 Oak St', 'date_of_birth' => '2006-11-15', 'city' => 'Casablanca', 'photo' => '/images/sara.jpg'],
            ['firstname' => 'Youssef', 'lastname' => 'Bennani', 'cef' => '2006123458', 'email' => 'y.bennani@example.com', 'phone' => '06-6544-7892', 'address' => '789 Pine Rd', 'date_of_birth' => '2006-12-20', 'city' => 'Rabat', 'photo' => '/images/youssef.jpg'],
            ['firstname' => 'Laila', 'lastname' => 'Zouhri', 'cef' => '2006123459', 'email' => 'l.zouhri@example.com', 'phone' => '06-6544-7893', 'address' => '101 Elm Dr', 'date_of_birth' => '2006-01-25', 'city' => 'Tangier', 'photo' => '/images/laila.jpg'],
            ['firstname' => 'Adnane', 'lastname' => 'Fassi', 'cef' => '2006123460', 'email' => 'a.fassi@example.com', 'phone' => '06-6544-7894', 'address' => '202 Cedar Ln', 'date_of_birth' => '2006-02-28', 'city' => 'Agadir', 'photo' => '/images/adnane.jpg'],
            ['firstname' => 'Nadia', 'lastname' => 'El Idrissi', 'cef' => '2006123461', 'email' => 'n.elidrissi@example.com', 'phone' => '06-6544-7895', 'address' => '303 Maple Ave', 'date_of_birth' => '2006-03-10', 'city' => 'Marrakech', 'photo' => '/images/nadia.jpg'],
            ['firstname' => 'Omar', 'lastname' => 'Chafik', 'cef' => '2006123462', 'email' => 'o.chafik@example.com', 'phone' => '06-6544-7896', 'address' => '404 Birch St', 'date_of_birth' => '2006-04-15', 'city' => 'Fes', 'photo' => '/images/omar.jpg']
        ];

        foreach ($stagiaires as $stagiaire) {
            Stagiaire::create($stagiaire);
        }
    }
}
