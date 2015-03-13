<?php 
$I = new FunctionalTester($scenario);
$I->am('a CMS admin');
$I->wantTo('See section details');

//When
$id = $I->haveRecord('sections', [
	'name' => 'Our Company',
	'slug_url' => 'our-company',
	'menu_order' => 2, 
	'menu' => 1, 
	'published' => 0
]);

$I->amOnPage('admin/sections/' . $id);

//Then
$I->expectTo('see the section datails');
$I->see('Our company', 'h1');
$I->see('our-company', '.slug-url');
$I->see('2', '.menu-order');
$I->see('Show in menu', '.menu');
$I->see('Draft', '.published');