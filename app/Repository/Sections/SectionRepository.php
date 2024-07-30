<?php
namespace App\Repository\Sections;

use App\Interfaces\Sections\SectionRepositoryInterface;
use App\Models\Doctor;
use App\Models\Section;

class SectionRepository implements SectionRepositoryInterface
{
 
    public function index()
    {
      $sections = Section::all();
      return view('dashboard.sections.index',compact('sections'));
    }

    public function store($request)
    {
        Section::create([
            'name' => $request->input('name'),
        ]);

        session()->flash('add');
        return redirect()->route('sections.index');
    }

    public function update($request)
    {
        $section = Section::findOrFail($request->id);
        $section->update([
            'name' => $request->input('name'),
        ]);
        session()->flash('edit');
        return redirect()->route('sections.index');
    }


    public function destroy($request)
    {
        Section::findOrFail($request->id)->delete();
        session()->flash('delete');
        return redirect()->route('sections.index');

        // $sectionDelete = Section::findOrFail($request->id);
        // $sectionDelete->delete([
        //     'id' => $request->input('id'),
        // ]);
        // session()->flash('delete');
        // return redirect()->route('sections.index');
         

    }

    public function show($id)
    {
        // طريقه صح لكن بدون استخدام العلاقه وان تو مني
        // $option2 = Doctor::where('section_id',$id)->get(); 
        // return $option2 ; 

        $doctors = Section::findOrFail($id)->doctors;
        $section = Section::findOrFail($id);
        return view('dashboard.sections.show_doctors',compact('doctors','section'));
    }

}
