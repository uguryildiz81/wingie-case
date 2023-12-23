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
        Schema::create('developers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 191)->index();
            $table->unsignedTinyInteger('level')->default(0)->comment('level of developer');
            $table->timestamp('first_available_at')->nullable();
            $table->unsignedDecimal('total_assign_hour')->default(0);
            $table->timestamps();
        });
        Schema::create('todos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('provider', 191)->index();
            $table->unsignedBigInteger('developer_id')->nullable()->index();
            $table->string('name', 191)->index();
            $table->unsignedTinyInteger('points');
            $table->unsignedTinyInteger('estimated_duration');
            $table->timestamps();
        });

        Schema::table('todos', function (Blueprint $table): void {
            $table->foreign(['developer_id'])->references(['id'])->on('developers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('todos', function (Blueprint $table): void {
            $table->dropForeign('todos_developer_id_foreign');
        });
        Schema::dropIfExists('todos');
        Schema::dropIfExists('developers');
    }
};
