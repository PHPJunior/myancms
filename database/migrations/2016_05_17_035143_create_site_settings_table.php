<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_name')->nullable();
            $table->string('site_metakey')->nullable();
            $table->text('site_metadesc')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_email')->nullable();
            $table->integer('theme')->unsigned();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->text('facebook')->nullable();
            $table->text('google_plus')->nullable();
            $table->text('twitter')->nullable();
            $table->longtext('site_logo')->nullable();
            $table->longtext('fav_icon')->nullable();
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
        Schema::drop('site_settings');
    }
}
