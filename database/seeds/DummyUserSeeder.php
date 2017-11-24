<?php

use App\Entities\User;
use Illuminate\Database\Seeder;

class DummyUserSeeder extends Seeder
{
    /**
     * @var User
     */
    protected $user;

    /**
     * DummyUserSeeder constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create user
        $this->createDummyUser();
    }

    public function createDummyUser()
    {
        foreach (range(0, 5) as $key) {
            $this->user->create([
                'name' => 'user' . $key,
                'email' => 'sample' . $key . '@sample.com',
                'password' => bcrypt('password'),
            ]);
        }
    }
}
