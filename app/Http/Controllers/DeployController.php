<?php

namespace App\Http\Controllers;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class DeployController extends Controller
{

    public function __construct()
    {
        $this->log = new Logger('deploy');
        $this->log->pushHandler(new StreamHandler(storage_path('logs/deploy.log')));
    }

    public function index()
    {
        /* melhorar para o envoy */
        #https://gitlab.com/kpobococ/gitlab-webhook/blob/master/gitlab-webhook-push.php

        if (config('deploy.password') != '') {
            if (!request()->has('p')) {
                $this->append('Faltando a senha do hook');
                die();
            }

            if (request()->get('p') !== config('deploy.password')) {
                $this->append('Senha não confere');
                die();
            }
        }

        $input = file_get_contents("php://input");
        $json = json_decode($input);

        if (!is_object($json) || empty($json->ref)) {
            $this->append('Dados enviados inválidos');
            die();
        }

        $ref = config('deploy.branch');
        $_refs = (array)$ref;

        if ($ref !== '*' && !in_array($json->ref, $_refs)) {
            $this->append('Ignorando a ref ' . $json->ref);
            die();
        }

        $this->append('Iniciando a execução do script...');
        $hookfile = base_path('.hooks/gitlab-webhook-push.sh');
        $this->exec_command('sh ' . $hookfile);
        $this->append('Script finalizado');
    }

    private function append($info)
    {
        $this->log->addInfo($_SERVER['REMOTE_ADDR'] . ' - ' . $info);
    }

    private function exec_command($command)
    {
        $output = [];

        exec($command, $output);

        foreach ($output as $line) {
            $this->log->addInfo('SHELL: ' . $line);
        }
    }
}