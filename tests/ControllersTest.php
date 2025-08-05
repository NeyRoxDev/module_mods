<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserPreferencesController;
use Symfony\Component\HttpFoundation\Request;

final class ControllersTest extends TestCase
{
    public function testAdminControllerEndpoints(): void
    {
        $controller = new AdminController();

        $index = $controller->index();
        $this->assertSame(200, $index->getStatusCode());
        $mods = json_decode($index->getContent(), true);
        $this->assertNotEmpty($mods);

        $install = $controller->install(new Request([], ['url' => 'http://example.com/mod.jar']));
        $dataInstall = json_decode($install->getContent(), true);
        $this->assertSame('installed', $dataInstall['status']);

        $uninstall = $controller->uninstall(new Request([], ['name' => 'WorldEdit']));
        $dataUninstall = json_decode($uninstall->getContent(), true);
        $this->assertSame('removed', $dataUninstall['status']);
    }

    public function testUserPreferencesEndpoints(): void
    {
        $controller = new UserPreferencesController();

        $show = $controller->show(new Request());
        $dataShow = json_decode($show->getContent(), true);
        $this->assertArrayHasKey('autoRestart', $dataShow);

        $update = $controller->update(new Request([], ['autoRestart' => false]));
        $dataUpdate = json_decode($update->getContent(), true);
        $this->assertSame('saved', $dataUpdate['status']);
        $this->assertFalse($dataUpdate['preferences']['autoRestart']);
    }
}
