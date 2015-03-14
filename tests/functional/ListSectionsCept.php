<?php 
$I = new FunctionalTester($scenario);
$I->am('a CMS admin');
$I->wantTo('list sections');

//When
$sections = $I->haveSections();
//And
$I->amOnPage('admin/sections');

//Then
$first = $sections->first();

$I->see('Sections', 'h1');
$I->see('There are 10 sections');
$I->see($first->name, 'tbody tr:first-child td.name');
$I->see($sections->last()->name, 'tbody tr:last-child td.name');

//When
$I->click('Show', 'tbody tr:first-child');
$I->expectTo('see the section datails');
$I->seeCurrentUrlEquals('/admin/sections/' . $first->id);
$I->see($first->name, 'h1');
