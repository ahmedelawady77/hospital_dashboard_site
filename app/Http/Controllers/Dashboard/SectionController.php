<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\Sections\SectionRepositoryInterface;
 
class SectionController extends Controller
{
    private $Sections; 

    public function __construct(SectionRepositoryInterface $Sections)
    {
        $this->Sections = $Sections;                //  $this->Sections  y3ny lma 22olha howa hyfhm an asdy (SectionRepositoryInterface) w $Sections mot8er feh method el SectionRepositoryInterface 
    }
   
    public function index()
    {
       return $this->Sections->index();
    }
 
    public function store(Request $request)
    {
        return $this->Sections->store($request);

    }

    public function update(Request $request)
    {
        return $this->Sections->update($request);

    }

    
    public function destroy(Request $request)
    {
        return $this->Sections->destroy($request);
    }

     public function show($id)
    {
        return $this->Sections->show($id);
    }

    public function showSections()
    {
        $sections = Section::all();
        return view('welcome',compact('sections'));
    }
    
}
