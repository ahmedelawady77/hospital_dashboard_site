<?php

namespace App\Repository\RayEmployee;

use App\Interfaces\RayEmployee\RayEmployeeRepositoryInterface;
use App\Models\RayEmployee;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class RayEmployeeRepository implements RayEmployeeRepositoryInterface
{

    public function index()
    {
        $ray_employees = RayEmployee::all();
        return view('dashboard.ray_employee.index',compact('ray_employees'));
    }

    public function store($request)
    {
        try {

            $ray_employee = new RayEmployee();
            $ray_employee->name = $request->name;
            $ray_employee->email = $request->email;
            $ray_employee->password = Hash::make($request->password);
            $ray_employee->save();
            session()->flash('add');
            return back();

        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request, $id) 
    {
        /*
         الموضوع كله ان ممكن ميتعدلش علي الباس ف بقوله الفورم ال جيالك دي حطها في متغير و اصلا هو اراي
         وبعد كدا بتشييك لو الاراي دي الباس فاضي فيها ولا لا
         لو مش فاضي يعني اليوزر عدل الباس ف بقوله هيشوو
         انما لو الباس فاضي يعني هو متعدلش 
         ف بقوله شيله خالص من الريكوست اصلا ال هو انا حطيته في اراي
        */
        $input = $request->all();

        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }
        else{
            $input = Arr::except($input, ['password']);
        }

        $ray_employee = RayEmployee::findOrFail($id);
        $ray_employee->update($input);

        session()->flash('edit');
        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            RayEmployee::destroy($id);
            session()->flash('delete');
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
