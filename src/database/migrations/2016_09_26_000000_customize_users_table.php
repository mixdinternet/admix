<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CustomizeUsersTable extends Migration {

    /**
     * Make changes to the table.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->string('status', 10)->default('active')->comment('active | inactive')->after('id');
            $table->integer('role_id')->unsigned()->default('0')->after('password');
            $table->string('image_file_name')->nullable()->after('role_id');
            $table->integer('image_file_size')->nullable()->after('image_file_name')->after('image_file_name');
            $table->string('image_content_type')->nullable()->after('image_file_size')->after('image_file_size');
            $table->timestamp('image_updated_at')->nullable()->after('image_content_type')->after('image_content_type');
            $table->softDeletes();
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
            $table->dropColumn('status');
            $table->dropColumn('role_id');
            $table->dropColumn('image_file_name');
            $table->dropColumn('image_file_size');
            $table->dropColumn('image_content_type');
            $table->dropColumn('image_updated_at');
            $table->dropColumn('deleted_at');
        });
    }

}