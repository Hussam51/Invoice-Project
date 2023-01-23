<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

/*
    function __construct()
    {
         $this->middleware('permission:section-list', ['only' => ['index']]);
         $this->middleware('permission:section-create', ['only' => ['create','store']]);
         $this->middleware('permission:section-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:section-delete', ['only' => ['destroy']]);
    }

*/
    public function index()
    {
        
        $sections = Section::all();

        return view('section.sections', compact('sections'));
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

        $validatordata = $request->validate(

            [
                'section_name' => ['required','unique:sections,section_name'],
                'description' => 'required'
            ],
            [
                'section_name.required' => 'اسم القسم مطلوب',
                'description.required' => 'الوصف ',
            ]
        );

        $input = $request->all();

        Section::create([
            'section_name' => $input['section_name'],
            'description' => $input['description'],
            'created_by' => Auth::user()->name
        ]);


session()->flash('Add','created section successfuly');
        return redirect('/sections');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        $id=$request->id;
        $validatetor=$request->validate([
            'section_name'=>'required|unique:sections,section_name,except,id',

        ]);
        $section=Section::find($request->id);

        $section->update([
            'section_name'=>$request->section_name,
            'description'=>$request->description
        ]);

session()->flash('Edit','updated section successfuly');
         return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section,Request $request)
    {
        $section=Section::find($request->id);
        $section->delete();
        session()->flash('Delet','Deleted section successfully');
        return redirect()->back();
    }
}
