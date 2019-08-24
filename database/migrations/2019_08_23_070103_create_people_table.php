<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->initName(), function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->enum('sex', ['MAN', 'WOMEN'])->default('MAN');
            $table->char('mobile', 20)->nullable();
            $table->string('email')->nullable();
            $table->char('password', 32);
            $table->string('real_name')->nullable();
            $table->integer('created_at')->nullable();
            $table->integer('updated_at')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->initName());
    }

    protected function initName()
    {
        return str_plural('person');
    }
}
