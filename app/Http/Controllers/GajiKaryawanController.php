<?php

namespace App\Http\Controllers;

use App\Models\GajiKaryawan;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class GajiKaryawanController extends Controller
{
    public function index()
    {
        $gajiKaryawans = GajiKaryawan::with('karyawan')->orderByDesc('created_at')->get();

        return view('gaji.index', compact('gajiKaryawans'));
    }

    public function create(Request $request)
    {
        $karyawans = Karyawan::orderBy('nama')->get();
        $selectedKaryawanId = $request->query('karyawan_id');

        $a = rand(1, 9);
        $b = rand(1, 9);
        $captchaQuestion = "Berapa hasil dari {$a} + {$b}?";
        $request->session()->put('gaji_captcha_answer', $a + $b);

        return view('gaji.create', compact('karyawans', 'selectedKaryawanId', 'captchaQuestion'));
    }

    public function store(Request $request)
    {
        $captchaAnswer = $request->session()->get('gaji_captcha_answer');

        $data = $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'gaji_pokok' => 'required|integer|min:0',
            'lembur' => 'required|integer|min:0',
            'pinjaman' => 'required|integer|min:0',
            'captcha_answer' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) use ($captchaAnswer) {
                    if ($captchaAnswer === null || intval($value) !== $captchaAnswer) {
                        $fail('Jawaban captcha tidak sesuai. Silakan coba lagi.');
                    }
                },
            ],
        ]);

        $data['total_penghasilan'] = $data['gaji_pokok'] + $data['lembur'];
        $data['total_potongan'] = $data['pinjaman'];
        $data['gaji_bersih'] = max(0, $data['total_penghasilan'] - $data['total_potongan']);

        GajiKaryawan::create($data);

        return redirect()->route('gaji.index')->with('success', 'Slip gaji berhasil disimpan.');
    }
    public function exportPdf(Karyawan $karyawan)
    {
        $gajiKaryawans = GajiKaryawan::where('karyawan_id', $karyawan->id)
            ->orderByDesc('created_at')
            ->get();

        $pdf = Pdf::loadView('gaji.export', compact('karyawan', 'gajiKaryawans'));

        return $pdf->download('gaji-' . str_replace(' ', '-', strtolower($karyawan->nama)) . '.pdf');
    }
}
