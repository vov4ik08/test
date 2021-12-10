<?php


namespace App\Console\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Swoole\WebSocket\Server;
use Swoole\Http\Request;
use Swoole\WebSocket\Frame;


class TestCommand extends Command
{
    public $ws;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swoole {action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Active Push Message';

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
        $arg = $this->argument('action');
        switch ($arg) {
            case 'start':
                $this->info('swoole server started');
                $this->start();
                break;
            case 'stop':
                $this->info('swoole server stoped');
                break;
            case 'restart':
                $this->info('swoole server restarted');
                break;
        }
    }

    /**
     * Start Swoole
     */
    private function start()
    {

        $ws = new Server("0.0.0.0", 8081);

        $ws->on("start", function (Server $server) {
            echo "Swoole WebSocket Server is started at http://127.0.0.1:8081\n";
        });

        $ws->on('open', function(Server $server, $request) {
            echo "connection open: {$request->fd}\n";
            $server->tick(1000, function() use ($server, $request) {
                $server->push($request->fd, json_encode(["hello", time()]));
            });
        });

        $ws->on('message', function(Server $server, Frame $frame) {
            echo "received message: {$frame->data}\n";
            $server->push($frame->fd, json_encode(["hello", time()]));
        });

        $ws->on('close', function(Server $server, int $fd) {
            echo "connection close: {$fd}\n";
        });



        $ws->start();
    }
}
