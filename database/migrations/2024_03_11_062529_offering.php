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
            $table->text('title_en');
            $table->text('title_kh');
            $table->text('description_en');
            $table->text('description_kh');
            $table->text('way_to_give_en');
            $table->text('way_to_give_kh');
            $table->text('in_cash_title_en');
            $table->text('in_cash_description_en');
            $table->text('in_cash_title_kh');
            $table->text('in_cash_description_kh');
            $table->text('international_title_en');
            $table->text('international_title_kh');
            $table->text('international_description_kh');
            $table->text('international_description_en');
            $table->text('via_account_title_en');
            $table->text('via_account_title_kh');


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
