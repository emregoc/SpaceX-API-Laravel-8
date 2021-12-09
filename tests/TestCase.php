<?php

namespace Tests;

use Faker\Factory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    //protected $faker;

    public function setUp(): void
    {
        //parent::setUp();
        //Artisan::call('passport:install');
       // $this->faker = Factory::create();
    }
}
