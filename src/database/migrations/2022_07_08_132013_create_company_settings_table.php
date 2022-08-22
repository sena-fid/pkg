<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_settings', function (Blueprint $table) {
            $table->id();
            $table->text('image')->nullable();
            $table->string('company');
            $table->string('taxoffice')->nullable();
            $table->string('taxid')->nullable();
            $table->string('mersis')->nullable();
            $table->string('address')->nullable();
            $table->integer('city')->nullable();
            $table->string('district')->nullable();
            $table->string('email')->nullable();
            $table->string('kepemail')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_settings');
    }
};
