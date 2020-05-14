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
        $this->call(RoleSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(ProductsTableSeeder::class); // Товари
        $this->call(SupplierTableSeeder::class); // Постачальники
        $this->call(SyllableTableSeeder::class); // Поставки
        $this->call(GroupAttributesTableSeeder::class); //групи атрибутів
        $this->call(AttributeTableSeeder::class); // атрибути
        $this->call(OrderSeeder::class); // Замовлення
//        $this->call(ShippingSeeder::class); +
//        $this->call(PaymentSeeder::class); +
//        $this->call(OrderProductTableSeeder::class); +
//        $this->call(OrderDetailSeeder::class); +
        $this->call(MediaSeeder::class); // медіа файли і звязки з товарами
        $this->call(CommentsTableSeeder::class); // Коментарі до товарів
        $this->call(AttributeProductTableSeeder::class); // связь атрибутів і продуктів
    }
}
