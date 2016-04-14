<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mmails', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('name');
            $table->string('to');
            $table->string('toName');
            $table->string('subject');
            $table->text('cc')->nullable();
            $table->text('bcc')->nullable();
            $table->string('slug', 150)->unique();
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
        Schema::drop('mmails');
    }
}
