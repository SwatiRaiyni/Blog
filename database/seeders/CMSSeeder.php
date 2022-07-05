<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CMSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cms')->insert([
            'pagename_en' => 'About us',
            'Banner_header_en' => 'About us',
            'Banner_image_en' => '625e9e83c15ebgroup-18_4.png',
            'LeftBlock_image_en' => '625e9e83c15ebgroup-18_4.png',
            'Rightblock_en' => 'asd',
            'Extrablock_en' => 'Extrablock'
        ]);
        DB::table('cms')->insert([
            'pagename_en' => 'contact us',
            'Banner_header_en' => 'contact us',
            'Banner_image_en' => '625e9e83c15ebgroup-18_4.png',
            'LeftBlock_image_en' => '625e9e83c15ebgroup-18_4.png',
            'Rightblock_en' => 'asd',
            'Extrablock_en' => 'Extrablock'
        ]);
        DB::table('cms')->insert([
            'pagename_hi' => 'contact us',
            'Banner_header_hi' => 'contact us',
            'Banner_image_hi' => '625e9e83c15ebgroup-18_4.png',
            'LeftBlock_image_hi' => '625e9e83c15ebgroup-18_4.png',
            'Rightblock_hi' => 'asd',
            'Extrablock_hi' => 'Extrablock'
        ]);
        DB::table('cms')->insert([
            'pagename_en' => 'How its work',
            'Banner_header_en' => 'How its work',
            'Banner_image_en' => '625e9e83c15ebgroup-18_4.png',
            'LeftBlock_image_en' => '625e9e83c15ebgroup-18_4.png',
            'Rightblock_en' => 'asd',
            'Extrablock_en' => 'Extrablock'
        ]);
        DB::table('cms')->insert([
            'pagename_en' => 'Privacy Policy',
            'Banner_header_en' => 'Privacy Policy',
            'Banner_image_en' => '625e9e83c15ebgroup-18_4.png',
            'LeftBlock_image_en' => '625e9e83c15ebgroup-18_4.png',
            'Rightblock_en' => 'asd',
            'Extrablock_en' => 'Extrablock'
        ]);
        DB::table('cms')->insert([
            'pagename_en' => 'terms and condition',
            'Banner_header_en' => 'terms and condition',
            'Banner_image_en' => '625e9e83c15ebgroup-18_4.png',
            'LeftBlock_image_en' => '625e9e83c15ebgroup-18_4.png',
            'Rightblock_en' => 'asd',
            'Extrablock_en' => 'Extrablock'
        ]);

        DB::table('cms')->insert([
            'pagename_hi' => 'About us',
            'Banner_header_hi' => 'About us',
            'Banner_image_hi' => '625e9e83c15ebgroup-18_4.png',
            'LeftBlock_image_hi' => '625e9e83c15ebgroup-18_4.png',
            'Rightblock_hi' => 'asd',
            'Extrablock_hi' => 'Extrablock'
        ]);
        DB::table('cms')->insert([
            'pagename_hi' => 'How its work',
            'Banner_header_hi' => 'How its work',
            'Banner_image_hi' => '625e9e83c15ebgroup-18_4.png',
            'LeftBlock_image_hi' => '625e9e83c15ebgroup-18_4.png',
            'Rightblock_hi' => 'asd',
            'Extrablock_hi' => 'Extrablock'
        ]);
        DB::table('cms')->insert([
            'pagename_hi' => 'Privacy Policy',
            'Banner_header_hi' => 'Privacy Policy',
            'Banner_image_hi' => '625e9e83c15ebgroup-18_4.png',
            'LeftBlock_image_hi' => '625e9e83c15ebgroup-18_4.png',
            'Rightblock_hi' => 'asd',
            'Extrablock_hi' => 'Extrablock'
        ]);
        DB::table('cms')->insert([
            'pagename_hi' => 'terms and condition',
            'Banner_header_hi' => 'terms and condition',
            'Banner_image_hi' => '625e9e83c15ebgroup-18_4.png',
            'LeftBlock_image_hi' => '625e9e83c15ebgroup-18_4.png',
            'Rightblock_hi' => 'asd',
            'Extrablock_hi' => 'Extrablock'
        ]);
    }
}
