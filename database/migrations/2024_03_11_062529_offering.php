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
        Schema::create('offerings', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_kh');
            $table->text('description_en');
            $table->text('description_kh');
            $table->string('way_to_give_en');
            $table->string('way_to_give_kh');
            $table->string('in_cash_title_en');
            $table->string('in_cash_description_en');
            $table->string('in_cash_title_kh');
            $table->string('in_cash_description_kh');
            $table->string('international_title_en');
            $table->string('international_title_kh');
            $table->string('international_description_kh');
            $table->string('international_description_en');
            $table->string('via_account_title_en');
            $table->string('via_account_title_kh');


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
        Schema::dropIfExists('offerings');
    }
};
