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
        $this->call(FilterGroupsSeeder::class); //групи атрибутів
        $this->call(FiltersSeeder::class); // атрибути
        $this->call(OrderSeeder::class); // Замовлення
        $this->call(MediaSeeder::class); // медіа файли і звязки з товарами
        $this->call(CommentsTableSeeder::class); // Коментарі до товарів
        $this->call(ProductFilterSeeder::class); // связь атрибутів і продуктів
    }
}
