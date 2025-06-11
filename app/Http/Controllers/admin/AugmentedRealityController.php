<?php

namespace App\Http\Controllers\admin;

use App\Models\AugmentedReality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class AugmentedRealityController extends Controller
{
    public function index()
    {
        $data = AugmentedReality::all();
        return view('pageadmin.augmented-reality.index', compact('data'));
    }

    public function create()
    {
        return view('pageadmin.augmented-reality.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_objek' => 'required',
            'objek_3d' => 'required|file',
            'pattern_pattern' => 'required|file',
            'pattern_image' => 'required|file',
        ]);

        if ($request->hasFile('objek_3d') && $request->hasFile('pattern_pattern') && $request->hasFile('pattern_image')) {
            $file3D = $request->file('objek_3d');
            $filename3D = time() . '_' . $file3D->getClientOriginalName();
            $file3D->move(public_path('objek_3d'), $filename3D);

            $filePattern = $request->file('pattern_pattern');
            $filenamePattern = time() . '_' . $filePattern->getClientOriginalName();
            $filePattern->move(public_path('pattern'), $filenamePattern);

            $fileImage = $request->file('pattern_image');
            $filenameImage = time() . '_' . $fileImage->getClientOriginalName();
            $fileImage->move(public_path('pattern'), $filenameImage);
            
            $data = AugmentedReality::create([
                'nama_objek' => $request->nama_objek,
                'objek_3d' => $filename3D,
                'pattern_pattern' => $filenamePattern,
                'pattern_image' => $filenameImage,
            ]);

            Alert::success('Success', 'Data berhasil ditambahkan');
            return redirect()->route('augmented-reality.index');
        }

        Alert::error('Error', 'Gagal menambahkan data');
        return redirect()->back();
    }

    public function edit($id)
    {
        $ar = AugmentedReality::find($id);
        return view('pageadmin.augmented-reality.edit', compact('ar'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_objek' => 'required',
            'objek_3d' => 'nullable|file',
            'pattern_pattern' => 'nullable|file',
            'pattern_image' => 'nullable|file',
        ]);

        $data = AugmentedReality::find($id);
        
        if ($request->hasFile('objek_3d')) {
            // Hapus file objek 3D lama jika ada
            if ($data->objek_3d && file_exists(public_path('objek_3d/' . $data->objek_3d))) {
                unlink(public_path('objek_3d/' . $data->objek_3d));
            }
            
            $file3D = $request->file('objek_3d');
            $filename3D = time() . '_' . $file3D->getClientOriginalName();
            $file3D->move(public_path('objek_3d'), $filename3D);
        }

        if ($request->hasFile('pattern_pattern')) {
            // Hapus file pattern lama jika ada
            if ($data->pattern && file_exists(public_path('pattern/' . $data->pattern))) {
                unlink(public_path('pattern/' . $data->pattern));
            }
            
            $filePattern = $request->file('pattern_pattern');
            $filenamePattern = time() . '_' . $filePattern->getClientOriginalName();
            $filePattern->move(public_path('pattern'), $filenamePattern);
        }

        if ($request->hasFile('pattern_image')) {
            // Hapus file pattern image lama jika ada
            if ($data->pattern_image && file_exists(public_path('pattern/' . $data->pattern_image))) {
                unlink(public_path('pattern/' . $data->pattern_image));
            }
            
            $fileImage = $request->file('pattern_image');
            $filenameImage = time() . '_' . $fileImage->getClientOriginalName();
            $fileImage->move(public_path('pattern'), $filenameImage);
        }

        $updateData = [
            'nama_objek' => $request->nama_objek,
        ];

        if ($request->hasFile('objek_3d')) {
            $updateData['objek_3d'] = $filename3D;
        }

        if ($request->hasFile('pattern_pattern')) {
            $updateData['pattern'] = $filenamePattern;
        }

        if ($request->hasFile('pattern_image')) {
            $updateData['pattern_image'] = $filenameImage;
        }

        $data->update($updateData);

        Alert::success('Success', 'Data berhasil diubah');
        return redirect()->route('augmented-reality.index');
    }

    public function destroy($id)
    {
        $data = AugmentedReality::find($id);
        
        // Hapus file objek 3D
        if ($data->objek_3d && file_exists(public_path('objek_3d/' . $data->objek_3d))) {
            unlink(public_path('objek_3d/' . $data->objek_3d));
        }
        
        // Hapus file pattern
        if ($data->pattern && file_exists(public_path('pattern/' . $data->pattern))) {
            unlink(public_path('pattern/' . $data->pattern));
        }

        // Hapus file pattern image
        if ($data->pattern_image && file_exists(public_path('pattern/' . $data->pattern_image))) {
            unlink(public_path('pattern/' . $data->pattern_image));
        }
        
        $data->delete();
        Alert::success('Success', 'Data berhasil dihapus');
        return redirect()->route('augmented-reality.index');
    }
}
