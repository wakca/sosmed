<?php

use Illuminate\Database\Seeder;

class AdminDesa extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        set_time_limit(20000);

        $desa = App\Desa::all();
        
        foreach($desa as $listDesa)
        {
            $listDesa->admin_id = $listDesa->id;
            
            if($listDesa->save()){

                
                $user = App\User::where('username', $listDesa->id)->first();
                
                if($user){
                    $user->name = 'Admin Desa ' . $listDesa->nama;
                    $user->password = bcrypt($listDesa->id);
                    $user->username = $listDesa->id;
                    $user->email = $listDesa->id.'@desa.id';
                    $user->level = 2;
                    $user->desa = $listDesa->id;
                    $user->save();

                    unset($user);
                } else {
                    $user = new App\User;
                    $user->name = 'Admin Desa ' . $listDesa->nama;
                    $user->password = bcrypt($listDesa->id);
                    $user->username = $listDesa->id;
                    $user->email = $listDesa->id.'@desa.id';
                    $user->level = 2;
                    $user->desa = $listDesa->id;
                    $user->save();

                    unset($user);
                }
                unset($listDesa);
            }
        }
    }
}
