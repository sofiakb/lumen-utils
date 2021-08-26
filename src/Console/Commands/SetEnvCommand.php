<?php
/**
 * This file contains SetEnvCommand class.
 * Created by PhpStorm.
 * User: Sofiakb <contact.sofiakb@gmail.com>
 * Date: 23/07/2021
 * Time: 14:06
 */

namespace Sofiakb\Lumen\Utils\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class SetEnvCommand
 * @package App\Commands
 * @author Sofiane Akbly <sofiane.akbly@gmail.com>
 */
class SetEnvCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'set:env {--name=} {--value=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Set env variable value in .env";

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $name = $this->option('name');
        $value = $this->option('value');

        $path = base_path('.env');

        if (file_exists($path)) {
            file_put_contents(
                $path,
                str_replace("$name=" . env($name), "$name=" . $value, file_get_contents($path))
            );
        }

        $this->info("Application env [$name=$value] set successfully.");
    }
}
