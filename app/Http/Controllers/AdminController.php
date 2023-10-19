<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Provinsi;
use App\Models\Kecamatan;
use App\Models\Kelurahan;

class AdminController extends Controller
{
    public function dataPegawai()
    {
        $kelurahan = Kelurahan::all();
        $pegawai = Pegawai::orderBy('id', 'desc')->get();
        return view('dataPegawai', ['pegawai' => $pegawai, 'kelurahan' => $kelurahan]);
    }

    public function tambahPegawai(Request $request)
    {
        $kel = Kelurahan::where('nama', $request->kel)->first();
        $kec = Kecamatan::find($kel->id_kecamatan);
        $prov = Provinsi::find($kec->id_provinsi);

        Pegawai::create([
            'nama' => $request->nama,
            'tl' => $request->tl,
            'tgl_l' => $request->tgl_l,
            'jk' => $request->jk,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'kelurahan' => $kel->nama,
            'kecamatan' => $kec->nama,
            'provinsi' => $prov->nama
    	]);

    	return redirect()->back()->with('success', 'Data pegawai berhasil ditambah')->withInput();
    }

    public function editPegawai($id, Request $request)
    {
        $kel = Kelurahan::where('nama', $request->kel)->first();
        $kec = Kecamatan::find($kel->id_kecamatan);
        $prov = Provinsi::find($kec->id_provinsi);

        $pegawai = Pegawai::find($id);
        $pegawai->nama = $request->nama;
        $pegawai->tl = $request->tl;
        $pegawai->tgl_l = $request->tgl_l;
        $pegawai->jk = $request->jk;
        $pegawai->agama = $request->agama;
        $pegawai->alamat = $request->alamat;
        $pegawai->kelurahan = $kel->nama;
        $pegawai->kecamatan = $kec->nama;
        $pegawai->provinsi = $prov->nama;
        $pegawai->save();

        return redirect()->back()->with('success', 'Data pegawai berhasil diubah')->withInput();
    }

    public function hapusPegawai($id)
    {
        $pegawai = Pegawai::find($id);
        $pegawai->delete();
        return redirect()->back()->with('success', 'Data pegawai berhasil dihapus')->withInput();
    }

    public function dataProvinsi()
    {
        $provinsi = Provinsi::all();
        return view('dataProvinsi', ['provinsi' => $provinsi]);
    }

    public function tambahProvinsi(Request $request)
    {
        Provinsi::create([
            'nama' => $request->nama
    	]);

    	return redirect()->back()->with('success', 'Data provinsi berhasil ditambah')->withInput();
    }

    public function editProvinsi($id, Request $request)
    {
        $provinsi = Provinsi::find($id);
        $provinsi->nama = $request->nama;
        $provinsi->save();

        return redirect()->back()->with('success', 'Data provinsi berhasil diubah')->withInput();
    }

    public function hapusProvinsi($id)
    {
        $provinsi = Provinsi::find($id);
        $provinsi->delete();
        return redirect()->back()->with('success', 'Data provinsi berhasil dihapus')->withInput();
    }

    public function dataKecamatan()
    {
        $provinsi = Provinsi::all();
        $kecamatan = Kecamatan::all();
        return view('dataKecamatan', ['kecamatan' => $kecamatan, 'provinsi' => $provinsi]);
    }

    public function tambahKecamatan(Request $request)
    {
        $prov = Provinsi::where('nama', $request->provinsi)->first();
        
        Kecamatan::create([
            'nama' => $request->nama,
            'id_provinsi' => $prov->id
    	]);

    	return redirect()->back()->with('success', 'Data kecamatan berhasil ditambah')->withInput();
    }

    public function editKecamatan($id, Request $request)
    {
        $prov = Provinsi::where('nama', $request->provinsi)->first();

        $kecamatan = Kecamatan::find($id);
        $kecamatan->nama = $request->nama;
        $kecamatan->id_provinsi = $prov->id;
        $kecamatan->save();

        return redirect()->back()->with('success', 'Data kecamatan berhasil diubah')->withInput();
    }

    public function hapusKecamatan($id)
    {
        $kecamatan = Kecamatan::find($id);
        $kecamatan->delete();
        return redirect()->back()->with('success', 'Data kecamatan berhasil dihapus')->withInput();
    }

    public function dataKelurahan()
    {
        $kecamatan = Kecamatan::all();
        $kelurahan = Kelurahan::all();
        return view('dataKelurahan', ['kelurahan' => $kelurahan, 'kecamatan' => $kecamatan]);
    }

    public function tambahKelurahan(Request $request)
    {
        $kec = Kecamatan::where('nama', $request->kecamatan)->first();
        
        Kelurahan::create([
            'nama' => $request->nama,
            'id_kecamatan' => $kec->id
    	]);

    	return redirect()->back()->with('success', 'Data kelurahan berhasil ditambah')->withInput();
    }

    public function editKelurahan($id, Request $request)
    {
        $kec = Kecamatan::where('nama', $request->kecamatan)->first();

        $kelurahan = Kelurahan::find($id);
        $kelurahan->nama = $request->nama;
        $kelurahan->id_kecamatan = $kec->id;
        $kelurahan->save();

        return redirect()->back()->with('success', 'Data kelurahan berhasil diubah')->withInput();
    }

    public function hapusKelurahan($id)
    {
        $kelurahan = Kelurahan::find($id);
        $kelurahan->delete();
        return redirect()->back()->with('success', 'Data kelurahan berhasil dihapus')->withInput();
    }
}
