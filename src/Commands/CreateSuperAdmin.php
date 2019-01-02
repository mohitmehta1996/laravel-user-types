<?php

namespace Mohit\Usertype\Commands;

use Illuminate\Console\Command;
use App\User;
use Illuminate\Support\Facades\Hash;

class CreateSuperAdmin extends Command
{
    protected $signature = 'create:super';

    protected $description = 'Create super admin user';

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
            $user->type = 'admin|user';
            $user->save();
            $this->info('Super admin user successfully created !!');
        }
    }
}
