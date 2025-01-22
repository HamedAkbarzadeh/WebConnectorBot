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
        Schema::table('public_mail', function (Blueprint $table) {
            $table->integer('type')->default(0)->after('body')->comment('0=>All Users , 1=>All Admins , 2=>All Customers , 3=>Some Users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('public_mail', function (Blueprint $table) {
            //
        });
    }
};