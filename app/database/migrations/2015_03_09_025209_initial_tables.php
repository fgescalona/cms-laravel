<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitialTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sections', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');                // Our Company
			$table->string('slug_url');            // our-company
			$table->boolean('menu')->default(true);
			$table->tinyInteger('menu_order')->unsigned()->default(200);     
			$table->string('type');                // page, blog, products, gallery
			$table->boolean('published')->default(false); //para saber cuales han sido publicadas
			$table->timestamps();                  // created_at, updated_at
			$table->timestamp('published_at');
			$table->softDeletes();                 // deleted_at
		});

		Schema::create('pages', function(Blueprint $table) {
			$table->increments('id');
			//sections->section_id Foreign Key
			$table->integer('section_id')->unsigned()->nullable();
			$table->foreign('section_id')->references('id')->on('sections');
			$table->string('title');               // The team   
			$table->string('slug_url');            // the-team
			$table->tinyInteger('order_num')->unsigned()->default(200);    
			$table->text('body');                  //el contenido
			$table->string('tab_title'); 
			$table->mediumText('meta_description')->nullable(); 
			$table->boolean('published')->default(false);
			$table->boolean('featured')->default(false);
			$table->timestamps();                  // created_at, updated_at
			$table->timestamp('published_at');
			$table->softDeletes();                 // deleted_at
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sections');
		Schema::drop('pages');
	}

}
