<?php

use Illuminate\Database\Migrations\Migration;

class AddPathToDbMigrations extends Migration
{
    /**
     * Add a 'path' column to the migrations table
     *
     * @return void
     */
    public function up()
    {
        Schema::table(config('database.migrations'), function ($table) {
            $table->string('path')->after('migration');
        });
    }

    /**
     * Remove the path column
     *
     * @return void
     */
    public function down()
    {
        Schema::table(config('database.migrations'), function ($table) {
            $table->dropColumn('path');
        });
    }
}