<?php
/**
 * This file contains ServeCommand class.
 * Created by PhpStorm.
 * User: Sofiakb <contact.sofiakb@gmail.com>
 * Date: 29/07/2021
 * Time: 13:31
 */

namespace Sofiakb\Lumen\Utils\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Symfony\Component\Process\ProcessUtils;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\PhpExecutableFinder;

/**
 * Class ServeCommand
 * @package Sofiakb\Lumen\Utils\Console\Commands
 * @author Sofiakb <contact.sofiak@gmail.com>
 */
class ServeCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'serve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Serve the application on the PHP development server';

    /**
     * Execute the console command.
     *
     * @return void
     *
     * @throws \Exception
     */
    public function handle()
    {
        chdir(app()->basePath() . DIRECTORY_SEPARATOR . 'public');

        $host = $this->option('host') ?? $this->env('host');

        $port = $this->option('port') ?? $this->env('port');

        $base = app()->basePath();

        $binary = (new PhpExecutableFinder)->find(false);

        $this->info("Laravel development server started on http://{$host}:{$port}/");

        if (defined('HHVM_VERSION')) {
            if (version_compare(HHVM_VERSION, '3.8.0') >= 0) {
                passthru("{$binary} -m server -v Server.Type=proxygen -v Server.SourceRoot={$base}/ -v Server.IP={$host} -v Server.Port={$port} -v Server.DefaultDocument=server.php -v Server.ErrorDocument404=server.php");
            } else {
                throw new Exception("HHVM's built-in server requires HHVM >= 3.8.0.");
            }
        } else {
            passthru("{$binary} -S {$host}:{$port} {$base}/server.php");
        }
    }
    
    /**
     * @param $type
     * @return array|false|int|string|null
     * @throws Exception
     */
    private function env($type)
    {
        $appUrl = config('app.url') ?? env('APP_URL');

        $allowedTypes = ['host' => PHP_URL_HOST, 'port' => PHP_URL_PORT];

        if (!in_array(($type = strtolower($type)), array_keys($allowedTypes)))
            throw new \Exception("\{$type\} type not allowed");


        return parse_url($appUrl, $allowedTypes[$type]);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['host', null, InputOption::VALUE_OPTIONAL, 'The host address to serve the application on.'],

            ['port', null, InputOption::VALUE_OPTIONAL, 'The port to serve the application on.'],
        ];
    }
}
