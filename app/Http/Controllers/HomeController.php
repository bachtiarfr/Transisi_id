<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Employee;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $action = 'create';
        $employee = Employee::paginate(5);
        $company_data = Company::all();
        $company = Company::paginate(5);
        return view('company.home', compact('company', 'company_data', 'employee', 'action'));
    }
}
