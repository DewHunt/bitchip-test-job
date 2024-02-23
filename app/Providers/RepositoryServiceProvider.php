<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\MenuActionTypeInterface;
use App\Interfaces\MenuInterface;
use App\Interfaces\MenuActionInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\UserRoleInterface;
use App\Interfaces\AdminSettingsInterface;
use App\Interfaces\BookInterface;
use App\Interfaces\ReaderInterface;

use App\Repositories\MenuActionTypeRepository;
use App\Repositories\MenuRepository;
use App\Repositories\MenuActionRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserRoleRepository;
use App\Repositories\AdminSettingsRepository;
use App\Repositories\BookRepository;
use App\Repositories\ReaderRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register() {
        $this->app->bind(MenuActionTypeInterface::class, MenuActionTypeRepository::class);
        $this->app->bind(MenuInterface::class, MenuRepository::class);
        $this->app->bind(MenuActionInterface::class, MenuActionRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(UserRoleInterface::class, UserRoleRepository::class);
        $this->app->bind(AdminSettingsInterface::class, AdminSettingsRepository::class);
        $this->app->bind(BookInterface::class, BookRepository::class);
        $this->app->bind(ReaderInterface::class, ReaderRepository::class);
    }


    public function boot() {
        //
    }
}
