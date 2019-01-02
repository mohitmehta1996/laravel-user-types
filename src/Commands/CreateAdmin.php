<?php

namespace Mohit\Usertype\Commands;

use Illuminate\Console\Command;
use App\User;
use Illuminate\Support\Facades\Hash;


class CreateAdmin extends Command
{
    protected $signature = 'create:admin';

    protected $description = 'Create admin user';

    public function handle()
    {
        $name = $this->ask('Name');
        $email = $this->ask('Email');
        $password = $this->secret('Password');

        $check = User::where('email',$email)->first();
        if($check){
            $this->error('Email already exist !!');
        }else{
            $user = new User;
            $user->name = $name;
            $user->email = $email;
            $user->password =  Hash::make($password);
            $user->type = 'admin';
            $user->save();
            $this->info('Admin user successfully created !!');
        }
    }
}
