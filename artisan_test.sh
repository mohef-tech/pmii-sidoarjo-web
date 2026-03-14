php artisan tinker << 'TINKER_EOF'
$data = [
    'nama_pemohon' => 'Test User',
    'whatsapp' => '081234567890',
    'komisariat' => 'Komisariat UMSIDA',
    'status' => 'pending',
    'file_permohonan' => 'test/file1.pdf',
    'berkas_tambahan' => [
        'custom_file_1' => 'test/custom.pdf'
    ]
];
$surat = App\Models\SuratMasuk::create($data);
echo "Berhasil create ID: " . $surat->id . "\n";
echo "File Permohonan: " . $surat->file_permohonan . "\n";
echo "Berkas Tambahan: " . json_encode($surat->berkas_tambahan) . "\n";
$surat->delete();
TINKER_EOF
