<?php
use App\Models\Inscription;
use App\Models\Hackeuse;
use App\Models\ClassSemestre;
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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->float('note');
            $table->foreignIdFor(Inscription::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Hackeuse::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ClassSemestre::class)->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
