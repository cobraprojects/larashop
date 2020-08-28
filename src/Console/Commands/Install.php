<?php

namespace CobraProjects\LaraShop\Console\Commands;

use CobraProjects\Multiauth\Model\Permission;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larashop:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will publishing migration and factories, running all migration and setup every thing need to run this package';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->publishAssets();

        $this->runMigration();
    }

    protected function publishAssets()
    {
        $this->warn('A. Install cobraprojects/multiauth');
        Artisan::call('multiauth:install');
        $this->info(Artisan::output());

        $this->warn('B. Publishing Configurations');
        Artisan::call('vendor:publish --tag=larashop-config');
        Artisan::call('vendor:publish', [
            '--provider' => 'Gloudemans\Shoppingcart\ShoppingcartServiceProvider',
            '--tag' => 'config'
        ]);
        $this->info(Artisan::output());

        $this->warn('C. Publishing Migrations');
        Artisan::call('vendor:publish --tag=larashop-migrations');
        Artisan::call('vendor:publish', [
            '--provider' => 'Gloudemans\Shoppingcart\ShoppingcartServiceProvider',
            '--tag' => 'migrations'
        ]);
        $this->info(Artisan::output());

        $this->warn('D. Publishing Medialibrary Migrations');
        if (!Schema::hasTable('media')) {
            Artisan::call('vendor:publish', [
                '--provider' => 'Spatie\\MediaLibrary\\MediaLibraryServiceProvider',
                '--tag' => 'migrations'
            ]);
            $this->info(Artisan::output());
        } else {
            $this->info('table media already exists.');
        }

        $this->warn('E. Publishing Views');
        Artisan::call('vendor:publish --tag=larashop-views');
        $this->info(Artisan::output());
    }

    protected function runMigration()
    {
        $this->warn('F. Running Migrations');
        Artisan::call('migrate');
        $this->info(Artisan::output());

        $this->warn('G. seeding permissions');
        if (!$this->permissionExists('LarashopCategory')) {
            Artisan::call('multiauth:permissions LarashopCategory');
            $this->info(Artisan::output());
        }

        if (!$this->permissionExists('LarashopProduct')) {
            Artisan::call('multiauth:permissions LarashopProduct');
            $this->info(Artisan::output());
        }
    }

    public function permissionExists($permission)
    {
        return Permission::where('parent', $permission)->exists();
    }
}
