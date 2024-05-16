<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $KEStates = [
            "NBO"=>'Nairobi',
            "MBA"=>'Mombasa',
        ];
        $USStates = [
            "NY"=>'NewYork',
            "CA"=>'California',
        ];

        $countries = [
          ['code'=>'KE', 'name'=>'Kenya','states'=>json_encode($KEStates)],
          ['code'=>'USA', 'name'=>'UNITED STATES','states'=>json_encode($USStates)],
          ['code'=>'UK', 'name'=>'United Kingdom','states'=>null],
          ['code'=>'FRA', 'name'=>'France','states'=>null],
        ];
        Country::insert($countries);
    }
}
