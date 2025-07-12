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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_name');
            $table->string('validity_date');
            $table->string('if_webpanel');
            $table->string('if_android');
            $table->string('if_ios');
            $table->string('if_windows');
            $table->string('price');
            $table->string('image');
            $table->string('if_customerapp');
            $table->string('if_deliveryapp');
            $table->string('if_exicutiveapp');
            $table->string('if_multistore');
            $table->string('if_numberof_store');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
