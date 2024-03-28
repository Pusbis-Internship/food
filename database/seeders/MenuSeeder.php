<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::create([
            'menu_pic' => asset('storage/menu_images/bakso-mas-roy.jpg'),
            'menu_name' => 'bakso',
            'seller' => 'Seller',
            'category_id' => '1',
            'users_id' => '2',
            'menu_price' => 10,
            'menu_desc' => 'This is the first sample Menu.',
        ]);
        Menu::create([
            'menu_pic' => asset('storage/menu_images/cincau.jpg'),
            'menu_name' => 'es cao',
            'seller' => 'Seller',
            'category_id' => '2',
            'users_id' => '2',
            'menu_price' => 20,
            'menu_desc' => 'This is the second sample Menu.',
        ]);
        Menu::create([
            'menu_pic' => asset('storage/menu_images/teh.jpg'),
            'menu_name' => 'es teh',
            'seller' => 'Seller2',
            'category_id' => '3',
            'users_id' => '3',
            'menu_price' => 15,
            'menu_desc' => 'This is the third sample Menu.',
        ]);
        Menu::create([
            'menu_pic' => asset('storage/menu_images/teh.jpg'),
            'menu_name' => 'paket 1',
            'seller' => 'Seller',
            'category_id' => '4',
            'users_id' => '2',
            'menu_price' => 50,
            'menu_desc' => 'This is the fourth sample Menu.',
            'makanan_1' => 'nasi putih',
            'makanan_2' => 'ayam goreng',
            'makanan_3' => 'es garbis',
        ]);
    }
}