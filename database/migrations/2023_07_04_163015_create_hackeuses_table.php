<?php
use App\Models\Classe;
use App\Models\Annee;
use App\Models\Discipline;
use App\Models\Evaluation;
use App\Models\Hackeuse;
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
        Schema::create('hackeuses', function (Blueprint $table) {
            $table->id();
            $table->integer('notemax');
            $table->timestamps();
            $table->foreignIdFor(Classe::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Annee::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Discipline::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Evaluation::class)->constrained()->cascadeOnDelete();



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hackeuses');
    }
};
