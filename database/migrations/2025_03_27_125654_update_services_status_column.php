<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->enum('status', ['Hoạt Động', 'Tạm Ngừng'])->default('Hoạt Động')->change();
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->enum('status', ['Active', 'Inactive'])->default('Active')->change();
        });
    }
};
