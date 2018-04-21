<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $abilities = ['Submit SP List',
            'SP List Approval',
            'CC Waive or Proceed',
            'CC Enter Report',
            'CCConcur',
            'CC Outcome',
            'View CC Report',
            'Assessment Internal/External',
            'Assessment Details',
            'Assessment Score',
            'IDP Waive or Initiate',
            'IDP Feedback and Activities',
            'IDP Approval',
            'IDP Acknowledgement',
            'View IDP',
            'Print IDP',
            'Update Assessment Score',
            'Revert Acknowledged IDP',
            'Search Talent',
            'View Talent List',
            'Print Talent List',
            'View Talent Profile',
            'Print Talent Profile',
            'View and Edit Marketability',
            'View and Edit Retirement/Health',
            'View and Enter Remarks',
            'View LRL',
            'View Criticality',
            'View Medical History',
            'View Domestic Inquiry',
            'View Timeline',
            'Suspend Talent',
            'Drop Talent',
            'Reactivate Talent'
        ];

        /* Create Role */

        // create role
        $role = DB::table('roles')->insert([
            'name' => 'HCM',
            'title' => 'Human Capital Management',
            'created_at' => Carbon\Carbon::now()
        ]);

        $role = DB::table('roles')->insert([
            'name' => 'HOD',
            'title' => 'Head Of Division',
            'created_at' => Carbon\Carbon::now()
        ]);

        $role = DB::table('roles')->insert([
            'name' => 'HHCM',
            'title' => 'Head Of Human Capital Management',
            'created_at' => Carbon\Carbon::now()
        ]);

        $role = DB::table('roles')->insert([
            'name' => 'MENTOR',
            'title' => 'Mentor',
            'created_at' => Carbon\Carbon::now()
        ]);

        $role = DB::table('roles')->insert([
            'name' => 'MENTEE',
            'title' => 'Mentee',
            'created_at' => Carbon\Carbon::now()
        ]);

        $role = DB::table('roles')->insert([
            'name' => 'HKL',
            'title' => 'Head of Knowledge and Learning',
            'created_at' => Carbon\Carbon::now()
        ]);

        /* End of Create Role */


        // create all 24 head of divisions
        for($i = 1; $i<=24;$i++)
        {
            $user = factory(App\User::class)->create([
                'name' => 'HOD'.$i,
                'email' => 'hod'.$i.'@accendo.com.my',
                'division_id' => $i,
                'password' => bcrypt('secret')
            ]);

            $user->assign('HOD');
        }

        $user = factory(App\User::class)->create([
            'name' => 'HCM',
            'email' => 'hcm@accendo.com.my',
            'division_id' => 25,
            'password' => bcrypt('secret')
        ]);

        $user->assign('HCM');

        $user = factory(App\User::class)->create([
            'name' => 'HHCM',
            'email' => 'hhcm@accendo.com.my',
            'division_id' => 25,
            'password' => bcrypt('secret')
        ]);

        $user->assign('HHCM');

        $user = factory(App\User::class)->create([
            'name' => 'Mentor',
            'email' => 'mentor@accendo.com.my',
            'division_id' => 25,
            'password' => bcrypt('secret')
        ]);

        $user->assign('MENTOR');

        $user = factory(App\User::class)->create([
            'name' => 'Mentee',
            'email' => 'mentee@accendo.com.my',
            'division_id' => 25,
            'password' => bcrypt('secret')
        ]);

        $user->assign('MENTEE');

        $user = factory(App\User::class)->create([
            'name' => 'HKL',
            'email' => 'hkl@accendo.com.my',
            'division_id' => 25,
            'password' => bcrypt('secret')
        ]);

        $user->assign('HKL');


        $user = factory(App\User::class)->create([
            'name' => 'Oscar',
            'email' => 'oscar@accendo.com.my',
            'division_id' => 25,
            'password' => bcrypt('secret')
        ]);

        $user->assign('HHCM');

        $user = factory(App\User::class)->create([
            'name' => 'Kalai',
            'email' => 'kalai@accendo.com.my',
            'division_id' => 25,
            'password' => bcrypt('secret')
        ]);

        $user->assign('HHCM');

        $user = factory(App\User::class)->create([
            'name' => 'Eng Shi Ping',
            'email' => 'esp@accendo.com.my',
            'division_id' => 25,
            'password' => bcrypt('secret')
        ]);

        $user->assign('HHCM');

        $user = factory(App\User::class)->create([
            'name' => 'Lincoln Kok',
            'email' => 'lincoln@accendo.com.my',
            'division_id' => 25,
            'password' => bcrypt('secret')
        ]);

        $user->assign('HHCM');

        $user = factory(App\User::class)->create([
            'name' => 'Danny Foo',
            'email' => 'danny@accendo.com.my',
            'division_id' => 25,
            'password' => bcrypt('secret')
        ]);

        $user->assign('HHCM');

        $user = factory(App\User::class)->create([
            'name' => 'Nurmala',
            'email' => 'nurmala@accendo.com.my',
            'division_id' => 25,
            'password' => bcrypt('secret')
        ]);

        $user->assign('HHCM');

        $user = factory(App\User::class)->create([
            'name' => 'Daniel',
            'email' => 'danial@accendo.com.my',
            'division_id' => 25,
            'password' => bcrypt('secret')
        ]);

        $user->assign('HHCM');

        $user = factory(App\User::class)->create([
            'name' => 'Siew',
            'email' => 'wpsiew@accendo.com.my',
            'division_id' => 25,
            'password' => bcrypt('secret')
        ]);

        $user->assign('HHCM');

        $user = factory(App\User::class)->create([
            'name' => 'Yussman',
            'email' => 'wanyussman@accendo.com.my',
            'division_id' => 25,
            'password' => bcrypt('secret')
        ]);

        $user->assign('HHCM');

        $user = factory(App\User::class)->create([
            'name' => 'Abby',
            'email' => 'abby@accendo.com.my',
            'division_id' => 25,
            'password' => bcrypt('secret')
        ]);

        $user->assign('HHCM');

        $randomUsers = factory(App\User::class)->create();

    }
}
