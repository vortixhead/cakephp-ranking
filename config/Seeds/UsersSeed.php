<?php
use Migrations\AbstractSeed;
use Cake\Auth\DefaultPasswordHasher;


/**
 * Users seed.
 */
class UsersSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     *
     * @return void
     */
    public function run()
    {   

        $passwordHasher=new DefaultPasswordHasher();
        $data = [
            'email'=>'admin@example.com',
            'password'=>$passwordHasher->hash('vortixhead'),
            'role'=>'admin'
        ];

        $table = $this->table('users');
        $table->insert($data)->save();
    }
}
