<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddImageFieldsToUsersTable extends Migration {

    /**
     * Make changes to the table.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {

            $table->string('image_file_name')->nullable();
            $table->integer('image_file_size')->nullable()->after('image_file_name');
            $table->string('image_content_type')->nullable()->after('image_file_size');
            $table->timestamp('image_updated_at')->nullable()->after('image_content_type');

        });

    }

    /**
     * Revert the changes to the table.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {

            $table->dropColumn('image_file_name');
            $table->dropColumn('image_file_size');
            $table->dropColumn('image_content_type');
            $table->dropColumn('image_updated_at');

        });
    }

}