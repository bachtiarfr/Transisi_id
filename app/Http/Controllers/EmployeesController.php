<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Company;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $actiion = 'create';
        $employee = Employee::paginate(5);
        $company = Company::all();
        $action = 'create';
        return view('employee.home', compact('employee', 'company', 'action'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'company' => 'required',
        ]);

        $employee = new Employee;
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->company = $request->input('company');
        $employee->save();

        return redirect()->to("/employee")->with('success', 'success add new data');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $action = 'edit';
        $employee = Employee::find($id);
        $company = Company::all();
        $data = [
            'id' => $employee->id,
            'name' => $employee->name,
            'email' => $employee->email,
            'company' => $employee->company
        ];
        $company_name = Company::find($data['company']);
        // dd($company_name->name);
        return view('employee.home', compact('action', 'company', 'company_name', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'company' => 'required'
        ]);

        $Employee = Employee::find($id);
        $Employee->name = $request->input('name');
        $Employee->email = $request->input('email');
        $Employee->company = $request->input('company');
        $Employee->save();

        return redirect()->to("/employee")->with('success', 'success edit data');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::where('id', $id)->first();
        $employee->delete();

        return back()->with('success', 'success delete data');
    }
}
