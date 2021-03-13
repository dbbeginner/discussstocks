<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Console\Command;

class addAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

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
            $email = "admin@admin.com";
        }

        $user = new User;
        $user->name = $username;
        $user->email = $email;
        $user->password = Hash::make($this->secret('Enter password:'));
        $user->active = true;
        $user->save();
    }
}
