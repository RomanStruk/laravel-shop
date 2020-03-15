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
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(GroupAttributesTableSeeder::class); //групи атребутів
        $this->call(AttributeTableSeeder::class); // атребути
        $this->call(AttributeProductTableSeeder::class); // связь атребутів і продуктів
        $this->call(ShippingSeeder::class);
        $this->call(OrderProductTableSeeder::class);
        $this->call(OrderDetailSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(MediaSeeder::class);
    }
}
