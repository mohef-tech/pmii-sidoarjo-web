<?php

namespace App\Http\Controllers;

use App\Models\Komisariat;
use App\Models\SiteSetting;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;

class SkController extends Controller
{
    public function index()
    {
        // Daftar komisariat dari DB (aktif saja), fallback ke hardcode jika DB kosong
        $komisariat = Komisariat::where('status', 'aktif')
            ->orderBy('nama')
            ->pluck('nama')
            ->toArray();

        if (empty($komisariat)) {
            $komisariat = [
                'Komisariat UMSIDA',
                'Komisariat UNUSIDA',
                'Komisariat AL-KHOLIL',
                'Komisariat STAI AL-AZHAR',
                'Komisariat UMAHA',
                'Komisariat JENGGALA',
                'Komisariat PMII SIDOARJO (Persiapan)',
            ];
        }

        // Berkas konfigurasi dari site_settings
        $rawConfig = SiteSetting::get('sk_requirements_config');
        $skRequirementsConfig = $rawConfig ? json_decode($rawConfig, true) : [];

        // Susun berkas yang akan ditampilkan: hanya yang aktif
        $berkas = collect($skRequirementsConfig)
            ->filter(fn ($item) => $item['is_active'] ?? true)
            ->toArray();

        return view('sk.index', compact('komisariat', 'berkas'));
    }

    public function store(Request $request)
    {
        // Berkas konfigurasi
        $rawConfig = SiteSetting::get('sk_requirements_config');
        $skRequirementsConfig = $rawConfig ? json_decode($rawConfig, true) : [];

        $activeBerkas = collect($skRequirementsConfig)
            ->filter(fn ($item) => $item['is_active'] ?? true);

        // Validasi field berkas dinamis
        $berkasRules = $activeBerkas
            ->mapWithKeys(function ($item) {
                $rule = ($item['is_required'] ?? false) ? 'required|file|max:10240' : 'nullable|file|max:10240';
                return [$item['key'] => $rule];
            })
            ->toArray();

        $request->validate(array_merge([
            'nama_pemohon' => 'required|string|max:255',
            'whatsapp'     => 'required|string|max:20',
            'komisariat'   => 'required|string|max:255',
        ], $berkasRules));

        $data = [
            'nama_pemohon' => $request->nama_pemohon,
            'whatsapp'     => $request->whatsapp,
            'komisariat'   => $request->komisariat,
            'status'       => 'pending',
        ];

        $berkasTambahan = [];

        // Simpan berkas yang diupload
        foreach ($activeBerkas as $item) {
            $key = $item['key'];
            $isSystem = $item['is_system'] ?? false;

            if ($request->hasFile($key)) {
                $path = $request->file($key)->store('surat-masuk', 'public');
                
                if ($isSystem) {
                    $data[$key] = $path;
                } else {
                    $berkasTambahan[$key] = $path;
                }
            }
        }

        if (!empty($berkasTambahan)) {
            $data['berkas_tambahan'] = $berkasTambahan;
        }

        SuratMasuk::create($data);

        return redirect()->route('sk.index')
            ->with('success', 'Permohonan SK komisariat Anda berhasil dikirim! Kami akan menghubungi Anda segera melalui WhatsApp.');
    }
}
