<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StokSeeder extends Seeder {
    public function run(): void {
        $data = [];
        for ($i = 1; $i <= 15; $i++) {
            $supplier_id = (($i - 1) % 3) + 1;
            $user_id = 1; // Default user admin
            
            $data[] = [
                'stok_id' => $i,
                'supplier_id' => $supplier_id,
                'barang_id' => $i,
                'user_id' => $user_id,
                'stok_tanggal' => Carbon::now(),
                'stok_jumlah' => rand(10, 100),
            ];
        }
        DB::table('t_stok')->insert($data);
    }
}

