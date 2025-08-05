<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserPreferencesController;

final class ControllersTest extends TestCase
{
    public function testAdminControllerExists(): void
    {
        $this->assertTrue(class_exists(AdminController::class));
    }

    public function testUserPreferencesControllerExists(): void
    {
        $this->assertTrue(class_exists(UserPreferencesController::class));
    }
}
