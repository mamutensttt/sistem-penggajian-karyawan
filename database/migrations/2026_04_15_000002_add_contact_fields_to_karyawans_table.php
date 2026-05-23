<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('karyawans', 'nik')) {
            Schema::table('karyawans', function (Blueprint $table) {
                $table->string('nik')->nullable()->after('nama');
            });
        }

        if (!Schema::hasColumn('karyawans', 'no_telp')) {
            Schema::table('karyawans', function (Blueprint $table) {
                $table->string('no_telp')->nullable()->after('nik');
            });
        }

        if (!Schema::hasColumn('karyawans', 'email')) {
            Schema::table('karyawans', function (Blueprint $table) {
                $table->string('email')->nullable()->after('no_telp');
            });
        }
    }

    public function down(): void
    {
        Schema::table('karyawans', function (Blueprint $table) {
            $table->dropColumn(['nik', 'no_telp', 'email']);
        });
    }
};
