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
        $content = File::get($path);
    
    
        if (file_exists($path)) {
    
            if (strpos($content, $name) !== false) {
                $content = str_replace("$name=" . env($key), "$name=" . $value, $content);
            } else $content .= "\n$name=$value";
            
            file_put_contents(
                $path,
                $content
            );
        }

        $this->info("Application env [$name=$value] set successfully.");
    }
}
