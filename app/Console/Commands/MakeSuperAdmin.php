<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Console\Command;

class MakeSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:superadmin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    public function handle()
    {
        $username = $this->ask('Enter username');
        $email = $this->ask('Enter email (leave blank for default');
        if(strlen(trim($email)) == 0) {
            $email = "superadmin@example.com";
        }

        User::create([
            'name' => $username,
            'email' => $email,
            'role' => 'superadmin',
            'password' => Hash::make($this->secret('Enter password:')),
            'email_verified_at' => '2021-01-01 01:01:01',
        ]);
    }
}
