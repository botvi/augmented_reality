<?php

namespace App\Http\Controllers\admin;

use App\Models\AugmentedReality;
use App\Models\Materi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class MateriController extends Controller
{
    public function index()
    {
        $data = Materi::with('augmentedReality')->get();
        return view('pageadmin.materi.index', compact('data'));
    }

    public function create()
    {
        $ar = AugmentedReality::all();
        return view('pageadmin.materi.create', compact('ar'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_materi' => 'required',
            'materi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'ar_id' => 'required',
        ]);
        $data = $request->all();
        
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/materi'), $filename);
            $data['gambar'] = 'uploads/materi/' . $filename;
        }
        
        Materi::create($data);
        return redirect()->route('materi.index')->with('success', 'Materi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $materi = Materi::find($id);
        $ar = AugmentedReality::all();
        return view('pageadmin.materi.edit', compact('materi', 'ar'));
    }

    public function update(Request $request, $id)
    {
        $data = Materi::find($id);
        
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($data->gambar && file_exists(public_path($data->gambar))) {
                unlink(public_path($data->gambar));
            }
            
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/materi'), $filename);
            $data->gambar = 'uploads/materi/' . $filename;
        }
        
        $data->judul_materi = $request->judul_materi;
        $data->materi = $request->materi;
        $data->ar_id = $request->ar_id;
        $data->save();
        
        return redirect()->route('materi.index')->with('success', 'Materi berhasil diubah');
    }

    public function destroy($id)
    {
        $data = Materi::find($id);
        if ($data->gambar && file_exists(public_path($data->gambar))) {
            unlink(public_path($data->gambar));
        }
        $data->delete();
        return redirect()->route('materi.index')->with('success', 'Materi berhasil dihapus');
    }

    public function show($id)
    {
        $data = Materi::find($id);
        return view('pageadmin.materi.show', compact('data'));
    }
}  
