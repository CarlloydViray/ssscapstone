<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class misSectionManagement extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = DB::table('sections')
            ->join('departments', 'sections.dept_code', '=', 'departments.dept_code')
            ->select('sections.*', 'departments.dept_desc')
            ->get();

        $departments = DB::table('departments')->get();

        return view('mis.misSectionManagementPage', ['sections' => $sections, 'departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
