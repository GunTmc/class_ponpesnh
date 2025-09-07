<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Exports\ExportTeacher;
use Hash;
use Auth;
use Str;
use Excel;


class TeacherController extends Controller
{

    public function export_excel(Request $request)
    {
        return Excel::download(new ExportTeacher, 'Teacher_' . date('d-m-Y') . '.xls');
    }

    public function list()
    {
        $data['getRecord'] = User::getTeacher();
        $data['header_title'] = "List Guru";
        return view('admin.teacher.list', $data);
    }



    public function add()
    {
        $data['header_title'] = "Tambahkan Guru Baru";
        return view('admin.teacher.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
            'mobile_number' => 'max:15|min:8',
            'marital_status' => 'max:50',
        ]);


        $teacher = new User;
        $teacher->name = trim($request->input('name'));
        $teacher->last_name = trim($request->input('last_name'));
        $teacher->gender = trim($request->input('gender'));

        if (!empty($request->date_of_birth)) {
            $teacher->date_of_birth = trim($request->input('date_of_birth'));
        }

        if (!empty($request->admission_date)) {
            $teacher->admission_date = trim($request->input('admission_date'));
        }

        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);

            $teacher->profile_pic = $filename;
        }

        $teacher->marital_status = trim($request->input('marital_status'));
        $teacher->address = trim($request->input('address'));
        $teacher->mobile_number = trim($request->input('mobile_number'));
        $teacher->permanent_address = trim($request->input('permanent_address'));
        $teacher->qualification = trim($request->input('qualification'));
        $teacher->work_experience = trim($request->input('work_experience'));
        $teacher->note = trim($request->input('note'));
        $teacher->status = trim($request->input('status'));
        $teacher->email = trim($request->input('email'));
        $teacher->password = Hash::make($request->input('password'));
        $teacher->user_type = 2;
        $teacher->save();

        return redirect('admin/teacher/list')->with('success', "Teacher Berhasil Ditambahkan");
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = "Edit Teacher";
            return view('admin.teacher.edit', $data);
        } else {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile_number' => 'max:15|min:8',
            'marital_status' => 'max:50',
        ]);


        $teacher = User::getSingle($id);
        $teacher->name = trim($request->input('name'));
        $teacher->last_name = trim($request->input('last_name'));
        $teacher->gender = trim($request->input('gender'));

        if (!empty($request->date_of_birth)) {
            $teacher->date_of_birth = trim($request->input('date_of_birth'));
        }

        if (!empty($request->admission_date)) {
            $teacher->admission_date = trim($request->input('admission_date'));
        }

        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);

            $teacher->profile_pic = $filename;
        }

        $teacher->marital_status = trim($request->input('marital_status'));
        $teacher->address = trim($request->input('address'));
        $teacher->mobile_number = trim($request->input('mobile_number'));
        $teacher->permanent_address = trim($request->input('permanent_address'));
        $teacher->qualification = trim($request->input('qualification'));
        $teacher->work_experience = trim($request->input('work_experience'));
        $teacher->note = trim($request->input('note'));
        $teacher->status = trim($request->input('status'));
        $teacher->email = trim($request->input('email'));
        if (!empty($request->password)) {
            $teacher->password = Hash::make($request->input('password'));
        }

        $teacher->save();

        return redirect('admin/teacher/list')->with('success', "Teacher Berhasil Diperbarui");
    }


    public function delete($id)
    {
        try {
            $getRecord = User::getSingle($id);

            if (!empty($getRecord)) {

                $getRecord->delete();

                return redirect()->back()->with('success', "Teacher berhasil dihapus permanen");
            } else {
                return redirect()->back()->with('error', "Teacher tidak ditemukan");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Terjadi kesalahan: " . $e->getMessage());
        }
    }

}
