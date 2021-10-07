<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;

class EmployeeController extends Controller
{

    public function index()
    {
        $employee = Employees::all();
        return view('employer.index', compact('employee'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'mobile'=>'required',
            'password'=>'required',
            'office'=>'required',
            'address'=>'required',
            
        ]);

        $employees = new Employees([
            'surname' => $request->get('name'),
            'email' => $request->get('email'),
            'mobile' => $request->get('mobile'),
            'password' => $request->get('password'),
            'firstname' => $request->get('firstname'),
            'address' => $request->get('address')
        ]);
     $employees->save();
        return redirect('/employees')->with('success', 'Employer Registration saved!');
    }



    public function show($id)
    {
        $employees = Employees::find($id);
        return view('employees.show')
            ->with('employee', $employees);
    }

}
