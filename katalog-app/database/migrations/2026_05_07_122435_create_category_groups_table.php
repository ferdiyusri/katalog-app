<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('category_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->timestamps();
        });

        DB::table('category_groups')->insert([
            ['name' => 'Interior',         'slug' => 'interior', 'urutan' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Build dan Desain', 'slug' => 'build',    'urutan' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('category_groups');
    }
};
