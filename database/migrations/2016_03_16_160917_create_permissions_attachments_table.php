<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::create('permissions_attachments', function (Blueprint $table) {
        $table->integer('id');
        $table->string('permission_ident');
        $table->string('attachment_table');
        $table->string('attachment_field');
        $table->string('attachment_id');
        $table->primary('id');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('permissions_attachments');
    }
}
