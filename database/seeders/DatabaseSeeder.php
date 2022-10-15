<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Resep;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        

        User::create([
            'name' => 'Chintya Tria',
            'username' => 'chintyatria1',
            'email' => 'chintyatria@gmail.com',
            'password' => bcrypt('password')
        ]);

        // User::create([
        //     'name' => 'Sofi Diana',
        //     'email' => 'sofidiana@gmail.com',
        //     'password' => bcrypt('password')
        // ]);

        User::factory(3)->create();

        Kategori::create([
            'nama' => 'Masakan Nusantara',
            'slug' => 'masakan-nusantara'
        ]);
        Kategori::create([
            'nama' => 'Minuman Herbal',
            'slug' => 'minuman-herbal'
        ]);
        Kategori::create([
            'nama' => 'Masakan Oriental',
            'slug' => 'maskaan-oriental'
        ]);
        Resep::factory(20)->create();

        
        // Resep::create([
        //     'judul_resep' => 'Masakan Kedua',
        //     'slug' => 'masakan-kedua',
        //     'deskripsi' => 'Lorem ipsum kedua',
        //     'resepnya' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet, veritatis. Reiciendis facilis voluptas aut sit amet 
        //     laboriosam laudantium doloremque, dolor dolorum quis voluptatem dicta eligendi expedita distinctio nam quas, impedit ratione saepe 
        //     dolore molestias tempore deleniti? Nesciunt magnam placeat, possimus, similique harum inventore officiis odit aut labore nisi nostrum 
        //     sed quam quibusdam assumenda impedit facilis quasi enim corporis iste at? Consequatur quod dolore odit? Quod et fugiat voluptatibus 
        //     autem distinctio repellendus! Id voluptatibus est porro nemo deleniti adipisci neque obcaecati veniam! Minima nam, modi recusandae 
        //     expedita quod sapiente tempora maiores architecto, magni doloribus sequi odio ipsa consequuntur eos at nesciunt eaque! Commodi ipsum 
        //     expedita dicta fuga est reiciendis fugiat, exercitationem alias unde ipsa consectetur autem molestias officiis excepturi magni 
        //     aspernatur!',
        //     'kategori_id' => 1,
        //     'user_id' => 1
        // ]);
        // Resep::create([
        //     'judul_resep' => 'Masakan Ketiga',
        //     'slug' => 'masakan-ketiga',
        //     'deskripsi' => 'Lorem ipsum ketiga',
        //     'resepnya' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet, veritatis. Reiciendis facilis voluptas aut sit amet 
        //     laboriosam laudantium doloremque, dolor dolorum quis voluptatem dicta eligendi expedita distinctio nam quas, impedit ratione saepe 
        //     dolore molestias tempore deleniti? Nesciunt magnam placeat, possimus, similique harum inventore officiis odit aut labore nisi nostrum 
        //     sed quam quibusdam assumenda impedit facilis quasi enim corporis iste at? Consequatur quod dolore odit? Quod et fugiat voluptatibus 
        //     autem distinctio repellendus! Id voluptatibus est porro nemo deleniti adipisci neque obcaecati veniam! Minima nam, modi recusandae 
        //     expedita quod sapiente tempora maiores architecto, magni doloribus sequi odio ipsa consequuntur eos at nesciunt eaque! Commodi ipsum 
        //     expedita dicta fuga est reiciendis fugiat, exercitationem alias unde ipsa consectetur autem molestias officiis excepturi magni 
        //     aspernatur!',
        //     'kategori_id' => 2,
        //     'user_id' => 2
        // ]);
    }
}
