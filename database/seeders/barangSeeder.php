<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder {
    public function run(): void {
        $data = [];
        for ($i = 1; $i <= 15; $i++) {
            $kategori_id = ($i % 5) + 1;  // 5 kategori berulang
            $supplier_id = (($i - 1) % 3) + 1; // 3 supplier berulang

            $data[] = [
                'barang_id' => $i,
                'kategori_id' => $kategori_id,
                'barang_kode' => 'BRG' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'barang_nama' => 'Barang ' . $i,
                'harga_beli' => rand(5000, 50000),
                'harga_jual' => rand(5500, 60000),
            ];
        }
        DB::table('m_barang')->insert($data);
    }
}

