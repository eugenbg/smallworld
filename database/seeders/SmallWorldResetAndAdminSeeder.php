<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\User;

class SmallWorldResetAndAdminSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('smallworld.races')->truncate();
        DB::table('smallworld.abilities')->truncate();
        DB::table('smallworld.editions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->call(SmallWorldFullSeeder::class);

        $email = 'admin@smallworld.cerrajerotenerifesur.com';
        $password = self::makePassword(24);

        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'name' => 'Admin',
                'email' => $email,
                'password' => Hash::make($password),
                'email_verified_at' => $now,
                'updated_at' => $now,
                'created_at' => $now,
            ]
        );

        if ($this->command) {
            $this->command->info("Admin user: {$email}");
            $this->command->warn("Admin password: {$password}");
        }
    }

    protected static function makePassword(int $len = 24): string
    {
        $alphabet = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz23456789!@#$%^&*()-_=+{}[]<>?';
        $bytes = random_bytes($len);
        $out = '';
        for ($i = 0; $i < $len; $i++) {
            $out .= $alphabet[ord($bytes[$i]) % strlen($alphabet)];
        }
        return $out;
    }
}
