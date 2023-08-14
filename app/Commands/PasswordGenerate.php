<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class PasswordGenerate extends BaseCommand
{
    protected $group       = 'password';
    protected $name        = 'password:generate';
    protected $description = 'Encripty password .';

    public function run(array $params)
    {
        if (count($params) != 1) {

            CLI::write(
                CLI::color("Enter password without spaces!",'red')
            );
            return;
        }
        CLI::write(
            CLI::color($params[0]." gererate => ".password_hash($params[0], PASSWORD_BCRYPT),'green')
        );
    }
}
