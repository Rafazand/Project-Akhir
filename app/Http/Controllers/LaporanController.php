<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LaporanController extends Controller
{
    public function Buat()
    {
        return view('Laporan.BuatLaporan');
    }

    public function Track()
    {
        $data = Laporan::get();

        return view('Laporan.TrackLaporan',compact('data'));
    }

    public function create()
    {
        return view('Laporan.CreateLaporan');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'judul'                     => 'required',
            'deskripsi'                 => 'required',
            'tanggal_penyelenggaraan'   => 'required',
            'tipe_acara'                => 'required',
        ]);

        if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);
        // dd($request->all());

        $data['judul'] = $request->judul;
        $data['deskripsi'] = $request->deskripsi;
        $data['tanggal_penyelenggaraan'] = $request->tanggal_penyelenggaraan;
        $data['tipe_acara'] = $request->tipe_acara;

        Laporan::create($data);

        return redirect()->route('Laporan.TrackLaporan');
    }
}
