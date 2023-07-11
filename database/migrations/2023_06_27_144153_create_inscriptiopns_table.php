<?php

use App\Models\Classe;
use App\Models\Eleve;
use App\Models\Annee;
use App\Models\Inscription;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Mockery\Matcher\Any;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->dateTime('datescription')->default(now());
            $table->foreignIdFor(Classe::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Eleve::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Annee::class)->constrained()->cascadeOnDelete();
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
