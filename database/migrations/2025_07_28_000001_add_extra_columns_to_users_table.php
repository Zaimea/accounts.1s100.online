<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()
                ->after('name');
            $table->foreignId('current_group_id')
                ->after('username')
                ->nullable();
            $table->date('birthday')
                ->after('current_group_id')
                ->nullable();
            $table->string('gender')
                ->after('birthday')
                ->nullable();
            $table->string('town')
                ->after('gender')
                ->nullable();
            $table->string('country')
                ->after('town')
                ->nullable();
            $table->text('about')
                ->after('country')
                ->nullable();
            $table->text('userdescription')
                ->after('about')
                ->nullable();
            $table->string('language')
                ->after('userdescription')
                ->nullable();
            $table->string('website')
                ->after('language')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'username',
                'current_group_id',
                'birthday',
                'gender',
                'town',
                'country',
                'about',
                'userdescription',
                'language',
                'website',
            ]);
        });
    }
};
