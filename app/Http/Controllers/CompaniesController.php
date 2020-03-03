<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use App\Company;
use Storage;
use Session;
use File;

class CompaniesController extends Controller
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
        $company = Company::paginate(5);
        $action = 'create';
        return view('company.home', compact('company', 'action'));
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
        // dd($request->all());
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'website' => 'required',
            'logo' => 'required|mimes:png|max:2000',
        ]);

        $company = new Company;
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website = $request->input('website');
        $company->save();

        //upload file to Folder storage
        $request->file('logo')->move(public_path('storage/app/company'), $company->id . '.png');
        $company->logo = $company->id . '.png';
        $company->save();

        return redirect()->to("/")->with('success', 'success add new data');


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
        $company = Company::find($id);
        $data = [
            'id' => $company->id,
            'name' => $company->name,
            'email' => $company->email,
            'website' => $company->website,
            'logo' => $company->logo
        ];
        return view('home', compact('action', 'data'));
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
            'website' => 'required',
            'logo' => 'required|mimes:png|max:2000',
        ]);

        $company = Company::find($id);
        $company->name = $request->input('name');
        $company->email = $request->input('email');
        $company->website = $request->input('website');

        //menghapus logo terdahulu dari folder
        $logo = public_path('storage/app/company'). $company->id;
        File::delete($logo);

        //memasukan logo terbaru kedalam folder
        $request->file('logo')->move(public_path('storage/app/company'), $company->id . '.png');
        $company->logo = $company->id . '.png';
        $company->save();
        
        return redirect()->to("/")->with('success', 'success edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::where('id', $id)->first();
        
        $logo = public_path('../storage/app/company'). $company->id;
        File::delete($logo);

        $company->delete();

        return back()->with('success', 'success delete data');
    }
}
