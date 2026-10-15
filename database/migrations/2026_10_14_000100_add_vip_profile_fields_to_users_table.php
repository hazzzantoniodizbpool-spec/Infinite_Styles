<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Campos del perfil VIP (pantallas Stitch "Iniciar sesion" y "Editar perfil").
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('member_code', 20)->nullable()->unique()->after('id');
            $table->string('phone', 30)->nullable()->after('email');
            $table->date('birth_date')->nullable()->after('phone');
            $table->string('membership_tier', 40)->default('Black Diamond Member')->after('birth_date');
            $table->string('style_preference', 40)->nullable()->after('membership_tier');
            $table->string('welcome_drink', 40)->nullable()->after('style_preference');
            $table->json('treatments')->nullable()->after('welcome_drink');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['member_code']);
            $table->dropColumn([
                'member_code', 'phone', 'birth_date', 'membership_tier',
                'style_preference', 'welcome_drink', 'treatments',
            ]);
        });
    }
};
