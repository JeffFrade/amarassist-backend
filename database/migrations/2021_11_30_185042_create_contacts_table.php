<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 70);
            $table->string('email', 100);
            $table->string('phone', 11);
            $table->char('zip', 8);
            $table->string('city', 70);
            $table->char('state', 2);
            $table->string('neighborhood', 70);
            $table->string('address', 170);
            $table->string('number', 15)->nullable();
            $table->string('complement', 15)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
