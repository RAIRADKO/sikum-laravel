<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Opd;

class OpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Opd::truncate();

        $opds = [
            ['nama_opd' => 'Bagian Administrasi Pembangunan Setda', 'status' => 'aktif'],
            ['nama_opd' => 'Bagian Hukum Setda', 'status' => 'aktif'],
            ['nama_opd' => 'Bagian Kesejahteraan Rakyat Setda', 'status' => 'aktif'],
            ['nama_opd' => 'Bagian Organisasi Setda', 'status' => 'aktif'],
            ['nama_opd' => 'Bagian Pemerintahan Setda', 'status' => 'aktif'],
            ['nama_opd' => 'Bagian Pengadaan Barang & Jasa Setda', 'status' => 'aktif'],
            ['nama_opd' => 'Bagian Perekonomian & Sumber Daya Alam Setda', 'status' => 'aktif'],
            ['nama_opd' => 'Bagian Protokol & Komunikasi Pimpinan Setda', 'status' => 'aktif'],
            ['nama_opd' => 'Bagian Umum Setda', 'status' => 'aktif'],
            ['nama_opd' => 'Badan Kesatuan Bangsa dan Politik', 'status' => 'aktif'],
            ['nama_opd' => 'Badan Perencanaan Pembangunan, Riset dan Inovasi Daerah', 'status' => 'aktif'],
            ['nama_opd' => 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia', 'status' => 'aktif'],
            ['nama_opd' => 'Badan Penanggulangan Bencana Daerah', 'status' => 'aktif'],
            ['nama_opd' => 'Badan Pengelolaan Keuangan, Pendapatan dan Aset Daerah', 'status' => 'aktif'],
            ['nama_opd' => 'Badan Usaha Milik Daerah', 'status' => 'aktif'],
            ['nama_opd' => 'Dinas Pendidikan dan Kebudayaan', 'status' => 'aktif'],
            ['nama_opd' => 'Dinas Kependudukan dan Pencatatan Sipil', 'status' => 'aktif'],
            ['nama_opd' => 'Dinas Perhubungan', 'status' => 'aktif'],
            ['nama_opd' => 'Dinas Kesehatan Daerah', 'status' => 'aktif'],
            ['nama_opd' => 'Dinas Komunikasi, Informatika, Statistik dan Persandian (Urusan Kominfo & Persandian)', 'status' => 'aktif'],
            ['nama_opd' => 'Dinas Komunikasi, Informatika, Statistik dan Persandian (Urusan Statistik)', 'status' => 'aktif'],
            ['nama_opd' => 'Dinas Perindustrian, Transmigrasi dan Tenaga Kerja (Urusan Perindustrian & ESDM)', 'status' => 'aktif'],
            ['nama_opd' => 'Dinas Perindustrian, Transmigrasi dan Tenaga Kerja (Urusan Tenaga Kerja & Transmigrasi)', 'status' => 'aktif'],
            ['nama_opd' => 'Dinas Perumahan Rakyat, Kawasan Permukiman dan Pertanahan (Urusan Pertanahan)', 'status' => 'aktif'],
            ['nama_opd' => 'Dinas Perumahan Rakyat, Kawasan Permukiman dan Pertanahan (Urusan Perumahan & Kawasan Permukiman)', 'status' => 'aktif'],
            ['nama_opd' => 'Dinas Kepemudaan, Olahraga dan Pariwisata', 'status' => 'aktif'],
            ['nama_opd' => 'Dinas Pemberdayaan Perempuan dan Perlindungan Anak serta Pemberdayaan Masyarakat dan Desa', 'status' => 'aktif'],
            ['nama_opd' => 'Dinas Perpustakaan dan Kearsipan', 'status' => 'aktif'],
            ['nama_opd' => 'Dinas Sosial, Pengendalian Penduduk dan Keluarga Berencana', 'status' => 'aktif'],
            ['nama_opd' => 'Dinas Ketahanan Pangan dan Pertanian', 'status' => 'aktif'],
            ['nama_opd' => 'Dinas Koperasi, Usaha Kecil, Menengah dan Perdagangan', 'status' => 'aktif'],
            ['nama_opd' => 'Dinas Lingkungan Hidup dan Perikanan', 'status' => 'aktif'],
            ['nama_opd' => 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu (Bidang PTSP)', 'status' => 'aktif'],
            ['nama_opd' => 'Inspektorat Daerah', 'status' => 'aktif'],
            ['nama_opd' => 'Kecamatan Bagelen', 'status' => 'aktif'],
            ['nama_opd' => 'Kecamatan Banyuurip', 'status' => 'aktif'],
            ['nama_opd' => 'Kecamatan Bayan', 'status' => 'aktif'],
            ['nama_opd' => 'Kecamatan Bener', 'status' => 'aktif'],
            ['nama_opd' => 'Kecamatan Bruno', 'status' => 'aktif'],
            ['nama_opd' => 'Kecamatan Butuh', 'status' => 'aktif'],
            ['nama_opd' => 'Kecamatan Gebang', 'status' => 'aktif'],
            ['nama_opd' => 'Kecamatan Grabag', 'status' => 'aktif'],
            ['nama_opd' => 'Kecamatan Kaligesing', 'status' => 'aktif'],
            ['nama_opd' => 'Kecamatan Kemiri', 'status' => 'aktif'],
            ['nama_opd' => 'Kecamatan Kutoarjo', 'status' => 'aktif'],
            ['nama_opd' => 'Kecamatan Loano', 'status' => 'aktif'],
            ['nama_opd' => 'Kecamatan Ngombol', 'status' => 'aktif'],
            ['nama_opd' => 'Kecamatan Pituruh', 'status' => 'aktif'],
            ['nama_opd' => 'Kecamatan Purwodadi', 'status' => 'aktif'],
            ['nama_opd' => 'Kecamatan Purworejo', 'status' => 'aktif'],
            ['nama_opd' => 'Komisi Pemilihan Umum', 'status' => 'aktif'],
            ['nama_opd' => 'Pengadilan Negeri', 'status' => 'aktif'],
            ['nama_opd' => 'RSUD R.A.A Tjokronegoro', 'status' => 'aktif'],
            ['nama_opd' => 'RSUD Tjitrowardojo', 'status' => 'aktif'],
            ['nama_opd' => 'Satuan Polisi Pamong Praja dan Pemadam Kebakaran', 'status' => 'aktif'],
            ['nama_opd' => 'Sekretariat DPRD', 'status' => 'aktif'],
        ];

        Opd::insert($opds);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}