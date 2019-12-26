<?php

use App\Order;
use App\Product;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class,10)->create()->each(function(Order $o){
            for ($i=0; $i <= 2 ; $i++) {
                $product = factory(Product::class)->create();
                $o->products()->save($product,['amount' => random_int(1,100), 'price' => rand(10.00,1000.00)]);
            }
        });
    }
}
