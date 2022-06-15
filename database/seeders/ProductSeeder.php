<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Seeder;
use Faker\Factory as DataPalsu;
use Illuminate\Support\Facades\Hash;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataPalsu = DataPalsu::create('id_ID');
        
        $categories = ['Pakaian', 'Gadget', 'Digital'];
        
        $titles =[
            'Pakaian'   =>[
                'material' => ['kaos', 'celana', 'kemeja', 'jas'],
                'jenis' => ['Laki-Laki', 'Perempuan', 'Anak', 'Dewasa'],
                'warna' => ['Merah', 'Kuning', 'Hijau', 'Biru'],
            ],
            'Gadget'   =>[
                'material' => ['HP', 'Notebook', 'Laptop', 'Tablet'],
                'jenis' => ['Asus', 'Acer', 'Thosiba', 'Lenovo'],
                'warna' => ['Black', 'Blue', 'White', 'Silver'],
            ],
            'Digital'   =>[
                'material' => ['Pulsa', 'Kuota', 'Voucer', 'Kartu'],
                'jenis' => ['XL', 'Telkomsel', 'Axis', 'Indosat','3'],
                'warna' => ['100', '80', '50', '25', '10'],
            ]
        
        ];
        for ($i=0; $i <40 ; $i++) { 
            $category		= $dataPalsu->randomElement($categories);
            $titleStr		= $dataPalsu->randomElement( $titles[$category]['material']);
            $titleStr		.= ' ' . $dataPalsu->randomElement( $titles[$category]['jenis']);
            $titleStr		.= ' ' . $dataPalsu->randomElement( $titles[$category]['warna']);

            $data[] = [
                'category'      => $category,
                'title'         => $titleStr,
                'price'         => $dataPalsu->numberBetween(1,100)*1000,
                'description'  => $dataPalsu->text(),
                'stock'         => $dataPalsu->numberBetween(1,100),
                'free_shipping' => $dataPalsu->numberBetween(0,1),
                'rate'          => $dataPalsu->randomFloat(2,1,5),
            ];
        }
        (new Products())->insert($data);
    }
}