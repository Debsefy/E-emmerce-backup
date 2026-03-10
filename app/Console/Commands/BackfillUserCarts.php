<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class BackfillUserCarts extends Command
{
    protected $signature = 'users:backfill-carts';
    protected $description = 'Create carts for users who don\'t have one';

    public function handle()
    {
        User::all()->each(function ($user) {
            if (!$user->cart) {
                $user->cart()->create();
                $this->info("Cart created for user ID {$user->id}");
            }
        });

        $this->info('Backfill complete!');
    }
}
