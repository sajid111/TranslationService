<?php
    namespace Database\Seeders;

    use Illuminate\Database\Seeder;
    use App\Models\User;
    use Illuminate\Support\Facades\Hash;

    class UserSeeder extends Seeder
    {
        public function run()
        {
            $user = User::updateOrCreate(
                ['email' => 'testuser@example.com'],
                [
                    'name' => 'Test User',
                    'password' => Hash::make('password'),
                ]
            );

            $token = $user->createToken('AuthToken')->plainTextToken;
            echo $token;
        }
    }

?>
