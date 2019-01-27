<?php

use App\Models\Taxonomy;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    public function run()
    {
        $taxonomies = [
            [
                'name' => 'brands',
                'slug' => 'brands',
                'label' => 'برند',
                'tags' => [
                    ['label' => 'apple',     'slug' => 'apple'],
                    ['label' => 'nokia',     'slug' => 'nokia'],
                    ['label' => 'samsung',   'slug' => 'samsung'],
                    ['label' => 'sony',      'slug' => 'sony'],
                ],
            ],
            [
                'name' => 'colors',
                'slug' => 'colors',
                'label' => 'رنگ',
                'tags' => [
                    ['label' => 'red',     'slug' => 'red'],
                    ['label' => 'blue',     'slug' => 'blue'],
                    ['label' => 'pink',   'slug' => 'pink'],
                    ['label' => 'yellow',      'slug' => 'yellow'],
                ],
            ],
            [
                'name' => 'Form Factor',
                'slug' => 'forms',
                'label' => 'انواع',
                'tags' => [
                    ['label' => 'mobile', 'slug' => 'mobiles'],
                    ['label' => 'laptop', 'slug' => 'laptops'],
                ],
            ],
        ];
        foreach ($taxonomies as $taxonomy) {
            Taxonomy::create([
                'group_name' => $taxonomy['name'],
                'slug' => $taxonomy['slug'],
                'label' => $taxonomy['label'],
            ])->tags()->createMany($taxonomy['tags']);
        }
    }
}
