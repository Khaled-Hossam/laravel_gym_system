<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin {--email=} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is used to create new admin';

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
        $email =  $this->option('email');
        $password =  $this->option('password');
        if (!$email) {
            $email = $this->ask('Admin Email ?');
        }
        if (!$password) {
            $password = $this->secret('Admin Password ?');
        }

        $validator = Validator::make([
            'email' => $email,
            'password' => $password,
        ], [
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
        ]);

        if ($validator->fails()) {
            $this->line('Admin not created. See error messages below:');
        
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1;
        }

        User::create([
            'name' => 'Admin',
            'email' => $email,
            'password' => Hash::make($password),
        ])->assignRole('admin');
        
        $this->info('Admin Account created.');
        
        return 0;
    }
}
