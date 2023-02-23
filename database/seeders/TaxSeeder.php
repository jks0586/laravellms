<?php

namespace Database\Seeders;

use App\Models\Tax;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $taxes=[
        ['GST (10%)', '10']
        ];

        foreach ($taxes as $tax) {
            Tax::create(['name' => $tax[0],'percent'=>$tax[1]]);
        }
    }
}
