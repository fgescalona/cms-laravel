<?php 
$I = new FunctionalTester($scenario);
$I->am('a CMS admin');
$I->wantTo('Update a section');

//When
$id = $I->haveSection();


//And
$I->amOnPage('admin/sections/' . $id);

//Then
$I->see('Edit section', '.btn-edit');

//When
$I->click('Edit section', '.btn-edit');
//Then
$I->seeCurrentUrlEquals('/admin/sections/'. $id . '/edit');
$I->see('Edit section "Our company"', 'h1');
$I->seeInField('name', 'Our company');
$I->seeInField('slug_url', 'our-company');
$I->seeInField('menu_order', 2);
$I->seeOptionIsSelected('menu', 1);
$I->seeOptionIsSelected('published', 0);
$I->seeOptionIsSelected('type', 'Page');

$I->amGoingTo('Submit an invalid form');

//When
$I->fillField('name', '');
//And
$I->click('Update section');
//Then
$I->expectTo('See the form again with the errors');
$I->seeCurrentUrlEquals('/admin/sections/'. $id . '/edit');
$I->seeInField('name', '');
$I->seeInField('slug_url', 'our-company');
$I->see('The name field is required', '.error');

$I->amGoingTo('Submit a valid form');
//When
$I->fillField('name', 'Who we are');
$I->selectOption('published', 1);
//And
$I->click('Update section');
//Then
$I->expectTo('See the section details with the new changes');
$I->seeCurrentUrlEquals('/admin/sections/'. $id);
$I->see('Who we are', 'h1');
$I->seeRecord('sections', [
	//changed
	'id' => $id,
	'name' => 'Who we are',
	'published' => 1,
	//same
	'slug_url' => 'our-company',
	'type' => 'page',
	'menu_order' => 2, 
	'menu' => 1, 	
]);
