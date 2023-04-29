<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    public function getProduct() {
        
        return view('product');
    }
    
    public function index() {
        
        $data = Student::get();
        return view('student-list',compact('data'));
    }

    public function count() {
        $studentCount = DB::table('students')->count();
        return view('students', compact('studentCount'));
    }

    public function create()
    {
        return view('Add-student');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email',
            // 'password' => 'required|min:8',
            'phone' => 'required',
            'adress' => 'required',
            'photo' => 'required',
        ]);
        $saveData = $request->all();
        // $file = $request->hasFile('photo');
        
            $newFile = time().$request->file('photo')->getClientOriginalName();
            // $file_name = $newFile->store('images');
            $path = $request->file('photo')->storeAs('images', $newFile, 'public');
            $saveData["photo"] = '/storage/'.$path;
            // dd($requestData);
        Student::create($saveData);
        return redirect('/')->with('success','User has been created successfully.'); 
    
    }
    // public function show(student $student)
    // {
    //     $data = Student::get() ;
    //     return view('show',compact('data'));
    // }

    public function edit($id)
    {
        $data = Student::where('id','=',$id)->first();
        return view('edit-student',compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            // 'password' => 'required|min:8',
            'phone' => 'required',
            'adress' => 'required',
        ]);

            $id = $request->id;
            $name = $request->name;
            $email = $request->email;
            // $password = $request->password;
            $phone = $request->phone;
            $adress = $request->adress;

        Student::where('id','=',$id)->update([
            'name'=>$name,
            'email'=>$email,
            // 'password'=>$password,
            'phone'=>$phone,
            'adress'=>$adress

        ]); 
        // $student->fill($request->post())->save();

        return redirect('/')->with('success','Student Has Been updated successfully');
    }

    public function deleteStudent($id)
    {
        // $data = Student::get() ;
        Student::where('id','=',$id)->delete();     
        return redirect('/')->with('success','Student has been deleted successfully');
    }
}

