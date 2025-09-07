<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassModel;
use App\Exports\ExportStudent;
use Hash;
use Auth;
use Str;
use Excel;


class StudentController extends Controller
{
    public function export_excel(Request $request)
    {
        return Excel::download(new ExportStudent, 'Student_' . date('d-m-Y') . '.xls');
    }

    public function list()
    {
        $data['getRecord'] = User::getStudent();
        $data['header_title'] = "Student List";
        return view('admin.student.list', $data);
    }

    public function add()
    {
        $data['getClass'] = ClassModel::getClass();
        // Tambahkan data parent
        $data['getParent'] = User::select('users.*')
            ->where('user_type', '=', 4) // 4 = Parent
            ->where('is_delete', '=', 0)
            ->orderBy('name', 'asc')
            ->get();

        $data['header_title'] = "Tambahkan Siswa Baru";
        return view('admin.student.add', $data);
    }


    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
            'mobile_number' => 'max:15|min:8',
            'admission_number' => 'max:50',
            'roll_number' => 'max:50',
        ]);

        $user = new User;
        $user->name = trim($request->name);
        $user->last_name = trim($request->last_name);
        $user->admission_number = trim($request->admission_number);
        $user->roll_number = trim($request->roll_number);
        $user->class_id = trim($request->class_id);
        $user->parent_id = !empty($request->parent_id) ? trim($request->parent_id) : null;
        $user->gender = trim($request->gender);

        if (!empty($request->date_of_birth)) {
            $user->date_of_birth = trim($request->date_of_birth);
        }

        $user->mobile_number = trim($request->mobile_number);

        if (!empty($request->admission_date)) {
            $user->admission_date = trim($request->admission_date);
        }

        $user->blood_group = trim($request->blood_group);
        $user->height = trim($request->height);
        $user->weight = trim($request->weight);
        $user->status = trim($request->status);

        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('public/upload/profile/', $filename);
            $user->profile_pic = $filename;
        }

        $user->email = trim($request->email);
        $user->password = Hash::make($request->password);
        $user->user_type = 3;
        $user->save();

        return redirect('admin/student/list')->with('success', "Student berhasil dibuat");
    }


    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);

        if (!empty($data['getRecord'])) {
            $data['getClass'] = ClassModel::getClass();
            // Tambahkan data parent
            $data['getParent'] = User::select('users.*')
                ->where('user_type', '=', 4)
                ->where('is_delete', '=', 0)
                ->orderBy('name', 'asc')
                ->get();

            $data['header_title'] = "Edit Student";
            return view('admin.student.edit', $data);
        } else {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile_number' => 'max:15|min:8',
            'admission_number' => 'max:50',
            'roll_number' => 'max:50',
        ]);

        $user = User::getSingle($id);
        $user->name = trim($request->name);
        $user->last_name = trim($request->last_name);
        $user->admission_number = trim($request->admission_number);
        $user->roll_number = trim($request->roll_number);
        $user->class_id = trim($request->class_id);
        $user->parent_id = !empty($request->parent_id) ? trim($request->parent_id) : null; // Tambahkan ini
        $user->gender = trim($request->gender);

        if (!empty($request->date_of_birth)) {
            $user->date_of_birth = trim($request->date_of_birth);
        }

        $user->mobile_number = trim($request->mobile_number);

        if (!empty($request->admission_date)) {
            $user->admission_date = trim($request->admission_date);
        }

        $user->blood_group = trim($request->blood_group);
        $user->height = trim($request->height);
        $user->weight = trim($request->weight);
        $user->status = trim($request->status);

        if (!empty($request->file('profile_pic'))) {
            if (!empty($user->getProfile())) {
                unlink('public/upload/profile/' . $user->profile_pic);
            }

            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('public/upload/profile/', $filename);
            $user->profile_pic = $filename;
        }

        $user->email = trim($request->email);

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect('admin/student/list')->with('success', "Student berhasil diupdate");
    }

    public function delete($id)
    {
        try {
            $getRecord = User::getSingle($id);

            if (!empty($getRecord)) {
                $getRecord->delete();


                IdManager::autoReset('users');

                return redirect()->back()->with('success', "Student berhasil dihapus dan ID direset");
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', "Error: " . $e->getMessage());
        }
    }


    // teacher side work

    public function MyStudent()
    {
        // Cek apakah user sudah login
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Tolong login terlebih dahulu');
        }

        $data['getRecord'] = User::getTeacherStudent(auth()->id());
        $data['header_title'] = "My Student List";
        return view('teacher.my_student', $data);
    }
}
