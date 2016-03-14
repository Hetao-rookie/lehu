<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesPermissionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('roles_permissions', function (Blueprint $table) {
      $table->integer('role_id');
      $table->string('permission');
      $table->primary(['role_id', 'permission']);

    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {

       Schema::drop('roles_permissions');
  }

}
