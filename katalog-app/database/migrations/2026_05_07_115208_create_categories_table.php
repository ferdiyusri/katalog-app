<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('group');   // 'interior' | 'build'
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->timestamps();
        });

        // Seed kategori awal
        DB::table('categories')->insert([
            ['name' => 'Interior',           'slug' => 'interior',           'group' => 'interior', 'urutan' => 1,  'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kitchen Set',        'slug' => 'kitchen-set',        'group' => 'interior', 'urutan' => 2,  'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Interior Rumah',     'slug' => 'interior-rumah',     'group' => 'interior', 'urutan' => 3,  'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Interior Apartemen', 'slug' => 'interior-apartemen', 'group' => 'interior', 'urutan' => 4,  'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kantor',             'slug' => 'kantor',             'group' => 'interior', 'urutan' => 5,  'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hotel',              'slug' => 'hotel',              'group' => 'interior', 'urutan' => 6,  'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Build dan Desain',   'slug' => 'sipil',              'group' => 'build',    'urutan' => 7,  'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
