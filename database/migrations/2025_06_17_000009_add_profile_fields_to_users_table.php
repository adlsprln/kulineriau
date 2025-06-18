<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('address')->nullable()->after('email');
            $table->string('gender')->nullable()->after('address');
            $table->string('phone')->nullable()->after('gender');
            $table->string('city')->nullable()->after('phone');
            $table->string('postal_code')->nullable()->after('city');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['address', 'gender', 'phone', 'city', 'postal_code']);
        });
    }
};
