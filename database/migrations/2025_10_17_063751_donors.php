<?php

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
        Schema::create('donors', function (Blueprint $table) {
            $table->id();
            // Personal Information
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->date('date_of_birth');
            $table->string('gender', 10); // male, female, other

            // Medical Information
            $table->string('blood_group', 3)->index(); // A+, A-, B+, B-, O+, O-, AB+, AB-
            $table->unsignedSmallInteger('weight'); // kg
            $table->unsignedSmallInteger('height'); // cm
            $table->text('medical_conditions')->nullable();

            // Location & Availability
            $table->string('address');
            $table->string('city')->index();
            $table->string('state');
            $table->string('pincode', 6)->index();
            $table->json('availability')->nullable(); // array of time slots
            $table->string('travel_distance', 20); // 5,10,20,50,unlimited

            // Consents
            $table->boolean('consent_medical')->default(false);
            $table->boolean('consent_contact')->default(false);
            $table->boolean('consent_privacy')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donors');
    }
};
