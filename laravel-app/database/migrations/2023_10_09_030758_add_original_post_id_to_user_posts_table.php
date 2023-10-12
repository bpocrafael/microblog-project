<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('user_posts', function (Blueprint $table) {
            $table->unsignedBigInteger('original_post_id')->nullable()->after('deleted_at');
            $table->foreign('original_post_id')->references('id')->on('user_posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_posts', function (Blueprint $table) {
            $table->dropColumn('original_post_id');
            $table->dropForeign('original_post_id');
        });
    }
};
