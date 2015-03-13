<?php 
$I = new FunctionalTester($scenario);
$I->am('a Laravel developer');
$I->wantTo('know if Laravel was installed succesfully');
$I->amOnPage('/');
$I->see('You have arrived');