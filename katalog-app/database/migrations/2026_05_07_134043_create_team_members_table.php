<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role');
            $table->string('initials', 5);
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->timestamps();
        });

        DB::table('team_members')->insert([
            ['name' => 'Heri Setiyono',          'role' => 'Commissioner',                   'initials' => 'HS', 'urutan' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Fayyadl Novel',           'role' => 'Founder / CEO',                  'initials' => 'FN', 'urutan' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Wahyu Hidayat',           'role' => 'IT dan Digital Infrastructure',  'initials' => 'WH', 'urutan' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mochamad Iqbal M.R',      'role' => 'Head of Design',                 'initials' => 'MI', 'urutan' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Aldi Febri Yansah',       'role' => 'Civil Engineer',                 'initials' => 'AF', 'urutan' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Luthfiah Rachma Dwiyani', 'role' => 'Social Media dan Content',       'initials' => 'LR', 'urutan' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Aditya Ramadhan',         'role' => 'Project Administrator',          'initials' => 'AR', 'urutan' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Muhammad Zakaria',        'role' => 'Interior Supervisor',            'initials' => 'MZ', 'urutan' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ayub Juniar Ega Hatm',    'role' => 'Civil Works Supervisor',         'initials' => 'AJ', 'urutan' => 9, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
