<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder {
    public function run(): void {
        $data = [];
        for ($i = 1; $i <= 30; $i++) {
            $penjualan_id = (($i - 1) % 10) + 1;
            $barang_id = (($i - 1) % 15) + 1;

            $data[] = [
                'detail_id' => $i,
                'penjualan_id' => $penjualan_id,
                'barang_id' => $barang_id,
                'harga' => rand(5000, 50000),
                'jumlah' => rand(1, 5),
            ];
        }
        DB::table('t_penjualan_detail')->insert($data);
    }
}

