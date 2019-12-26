<?php

use App\Coupon;
use App\Establishment;
use Illuminate\Database\Seeder;

class EstablishmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Establishment::class,5)->create()->each(function(Establishment $o){
            for ($i=0;$i<2;$i++)
                $o->coupon()->save(factory(Coupon::class)->make());
        });
    }
}
