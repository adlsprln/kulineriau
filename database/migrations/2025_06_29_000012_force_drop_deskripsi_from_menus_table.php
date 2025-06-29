<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasColumn('menus', 'deskripsi')) {
            Schema::table('menus', function (Blueprint $table) {
                $table->dropColumn('deskripsi');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasColumn('menus', 'deskripsi')) {
            Schema::table('menus', function (Blueprint $table) {
                $table->text('deskripsi')->nullable();
            });
        }
    }
};
