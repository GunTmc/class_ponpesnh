<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClassModel;

class ClassController extends Controller
{
    public function list()
    {
        $data['getRecord'] = ClassModel::getRecord();

        $data['header_title'] = "Class List";
        return view('admin.class.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Tambahkan Kelas Baru";
        return view('admin.class.add', $data);
    }

    public function insert(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:0,1'
        ]);

        // Pastikan user ter-autentikasi
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Tolong login terlebih dahulu');
        }

        $save = new ClassModel;
        $save->name = $request->input('name');
        $save->status = $request->input('status');
        $save->created_by = Auth::user()->getKey();
        $save->save();

        return redirect('admin/class/list')->with('success', "Kelas Berhasil Ditambahkan");
    }

    public function edit($id)
    {
        $data['getRecord'] = ClassModel::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = "Edit Class";
            return view('admin.class.edit', $data);
        } else {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:0,1'
        ]);

        $save = ClassModel::getSingle($id);

        if (!$save) {
            return redirect()->back()->with('error', 'Class not found');
        }

        $save->name = $request->input('name');
        $save->status = $request->input('status');
        $save->save();

        return redirect('admin/class/list')->with('success', "Kelas Berhasil Diperbarui");
    }

    public function delete($id)
    {
        try {
            $save = ClassModel::getSingle($id);

            if (!empty($save)) {

                $save->delete();

                return redirect()->back()->with('success', "Class berhasil dihapus permanen");
            } else {
                return redirect()->back()->with('error', "Class tidak ditemukan");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Terjadi kesalahan: " . $e->getMessage());
        }
    }
}
