<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::paginate(10);
        return view('company.list', [
            'companies' => $companies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        $input = $request->all();
        if (isset($input['logo']) and $input['logo'] instanceof UploadedFile) {
            $name = $input['logo']->getClientOriginalName() . '_' . time() . '.' . $input['logo']->getClientOriginalExtension();
            $input['logo'] = $input['logo']->storeAs(
                'logos',
                $name
            );
        }

        $comp = Company::create($input);

        if ($comp) {
            return redirect()->route('companies.index')->with('success', 'Company created successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return view('company.edit', [
            'company' => $company
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, $id)
    {
        $input = $request->all();
        $company = Company::find($id);

        if (isset($input['logo']) and $input['logo'] instanceof UploadedFile) {
            $name = $input['logo']->getClientOriginalName() . '_' . time() . '.' . $input['logo']->getClientOriginalExtension();
            $input['logo'] = $input['logo']->storeAs(
                'logos',
                $name
            );

            if (Storage::disk('public')->exists($company->logo)) {
                Storage::disk('public')->delete($company->logo);
            }
        }

        if (isset($input['remove_logo']) and $input['remove_logo'] == 'Y') {
            if (Storage::disk('public')->exists($company->logo)) {
                Storage::disk('public')->delete($company->logo);
            }

            $input['logo'] = '';
        }
        $comp = Company::find($id)->update($input);

        return redirect()->route('companies.index')->with('success', 'Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $model = Company::find($id);

        if (Storage::disk('public')->exists($model->logo)) {
            Storage::disk('public')->delete($model->logo);
        }
        Company::destroy($id);

        return redirect()->route('companies.index')->with('success', 'Company Deleted Successfully');
    }
}
