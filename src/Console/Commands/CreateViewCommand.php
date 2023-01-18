<?php

namespace JobMetric\GlobalVariable\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateViewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'global-variable:view {view}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new view extend by base layout Global Variable';

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
     * @return int
     */
    public function handle(): int
    {
        $view = $this->argument('view');
        $path = $this->viewPath($view);

        if (File::exists($path)) {
            $this->alertExist();

            return 1;
        }
        $this->createDir($path);

        File::put($path, file_get_contents(realpath(__DIR__.'/stubs/blank.blade.php.stub')));

        $this->alertCreate($path);

        return 0;
    }

    /**
     * Get the view full path.
     *
     * @param string $view
     *
     * @return string
     */
    public function viewPath(string $view): string
    {
        $file = str_replace('.', '/', $view).'.blade.php';

        return "resources/views/{$file}";
    }

    /**
     * Create view directory if not exists.
     *
     * @param $path
     *
     * @return void
     */
    public function createDir($path): void
    {
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0777, true);
        }
    }

    public function alertCreate(string $path): void
    {
        $this->newLine();
        $this->line("  <bg=blue> INFO </> View [{$path}] created successfully.");
        $this->newLine();
    }

    public function alertExist(): void
    {
        $this->newLine();
        $this->line("  <bg=red> ERROR </> View already exists.");
        $this->newLine();
    }
}
