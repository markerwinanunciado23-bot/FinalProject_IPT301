
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();

            $table->foreignId('laboratory_id')
                ->constrained()
                ->restrictOnDelete();

            $table->string('name');
            $table->string('asset_code')->unique();
            $table->string('category');
            $table->unsignedInteger('quantity')->default(1);
            $table->string('condition')->default('Good');
            $table->string('status')->default('Available');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
