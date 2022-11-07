<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seededColorName = 'Rot';
        $seededColorSlug = 'rot';
        $seededColorHex = 'ff0000';
        $color = Color::where('slug', '=', $seededColorSlug)->first();
        if($color === null) {
            Color::create([
                'name' => $seededColorName,
                'slug' => $seededColorSlug,
                'hex_code' => $seededColorHex
            ]);
        }
    }
}
