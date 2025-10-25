<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donors', function (Blueprint $table) {
            // Default index name for unique on single column is `${table}_${column}_unique`
            if (Schema::hasColumn('donors', 'email')) {
                $table->dropUnique('donors_email_unique');
            }
        });
    }

    public function down(): void
    {
        Schema::table('donors', function (Blueprint $table) {
            $table->unique('email');
        });
    }
};
