<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blood_stocks', function (Blueprint $table) {
            $table->id();
            $table->enum('blood_type', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])->unique();
            $table->integer('units_available')->default(0);
            $table->integer('units_reserved')->default(0);
            $table->timestamp('last_updated_at')->nullable();
            $table->timestamps();
        });

        // Seed initial blood stock data
        $bloodTypes = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        $now = now();

        foreach ($bloodTypes as $type) {
            DB::table('blood_stocks')->insert([
                'blood_type' => $type,
                'units_available' => rand(5, 50), // Random initial stock for demo
                'units_reserved' => 0,
                'last_updated_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_stocks');
    }
};
