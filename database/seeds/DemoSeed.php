<?php

use App\Post;
use App\User;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\OutputInterface;

class DemoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [];
        $posts = [];

        $this->command->info('Creating 5 users');
        $this->command->getOutput()->progressStart(5);
        for ($i = 0; $i < 5; $i++) {
            $users[] = factory(User::class)->create();
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();

        sleep(1);

        $this->command->info('Creating 15 posts');
        $this->command->getOutput()->progressStart(25);
        foreach ($users as $user) {
            for ($i = 0; $i < 5; $i++) {
                $posts[] = factory(Post::class)->create([
                    'user_id' => $user->id
                ]);
                $this->command->getOutput()->progressAdvance();
            }
        }
        $this->command->getOutput()->progressFinish();

        sleep(1);

        $this->command->info('Create your account with 5 posts');
        $this->command->getOutput()->progressStart(6);

        $user = factory(User::class)->create([
            'username' => 'demo_user',
            'email' => 'demo_user@example.com',
        ]);

        $this->command->getOutput()->progressAdvance();

        for($i = 0; $i < 5; $i++)
        {
            factory(Post::class)->create([
                'user_id' => $user->id
            ]);
            $this->command->getOutput()->progressAdvance();
        }

        $this->command->getOutput()->progressFinish();
        $this->command->table([
            'username',
            'email',
            'password',
        ], [
            [

                'demo_user',
                'demo_user@example.com',
                'password',
            ]
        ]);
    }
}
