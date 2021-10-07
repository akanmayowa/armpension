<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Email;

class EmployerController extends Controller
{

    public function index()
    {
        $employer = Employer::all();
        return view('employer.index', compact('employer'));
    }

    public function create()
    {
        return view('employer.create');
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

        $employer = new Employer([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'mobile' => $request->get('mobile'),
            'password' => $request->get('password'),
            'office' => $request->get('office'),
            'address' => $request->get('address')
        ]);

        $details = [
            'title' => 'Mail from Armpension',
            'body' => 'Registration complete'
        ];
        \Mail::to($request->get('email'))->send(new \App\Mail\email($details));
        $employer->save();
        return redirect('/employer')->with('success', 'Employer Registration saved!');
    }



    public function show($id)
    {
        $employer = Employer::find($id);
        return view('employer.show')
            ->with('employer', $employer);
    
    }



    public function edit(Employer $employer)
    {
        //
    }


    public function update(Request $request, Employer $employer)
    {
        //
    }


    public function destroy(Employer $employer)
    {
        //
    }
}
