<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CreateFirstUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:firstUser';

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
        User::insert([
            'name'=>'Administrator',
            'email'=>'admin@localhost.net',
            'password'=>password_hash('admin123', PASSWORD_DEFAULT),
            'created_at'=>Carbon::now(),
            'level'=>1,
        ]);

        echo "Admin dibuat";
    }
}
