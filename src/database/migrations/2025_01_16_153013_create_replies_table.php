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
        Schema::create('replies', function (Blueprint $table) {
            $table->id();
            $table->string('message', 200);
            // constrainedの第一引数は参照するテーブル名．
            // 何も指定しない場合は外部キー(foreignId)から自動で推測される．
            $table->foreignId('user_id')->constrained("users")->onDelete('cascade');
            $table->foreignId('post_id')->constrained("posts")->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};
