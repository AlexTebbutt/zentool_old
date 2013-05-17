<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
    	// Uncomment the below to wipe the table clean before populating
    	// DB::table('users')->delete();

        $users = array(
					array('id' => '1',
					'organisationID' => '20627362',
        	'username' => 'admin',
        	'fullname' => 'Alex Tebbutt',
        	'type' => 'admin',
        	'email' => 'alex.tebbutt@images.co.uk',
        	'password' => Hash::make('test'),
        	'active' => '1'),
        	array('id' => '2',
					'organisationID' => '20733176',
        	'username' => 'user',
        	'fullname' => 'A User',
        	'type' => 'user',
        	'email' => 'alex.tebbutt@images.co.uk',
        	'password' => Hash::make('user'),
        	'active' => '1')    
        );

        // Uncomment the below to run the seeder
        DB::table('users')->insert($users);
    }

}