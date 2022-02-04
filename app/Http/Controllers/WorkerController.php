<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Worker;
class WorkerController extends Controller
{
    public function index()
    {
        $workers = Worker::all();
  
        return view('worker.index',compact('workers'));
    }

    public function createStepOne(Request $request)
    {
        $worker = $request->session()->get('worker');
  
        return view('worker.create-step-one',compact('worker'));
    }

    public function postCreateStepOne(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:workers',
            'amount' => 'required|numeric',
            'description' => 'required',
            
        ]);
  
        if(empty($request->session()->get('worker'))){
            $worker = new Worker();
            $worker->fill($validatedData);
            $request->session()->put('worker', $worker);
        }else{
            $worker = $request->session()->get('worker');
            $worker->fill($validatedData);
            $request->session()->put('worker', $worker);
        }
  
        return redirect()->route('workers.create.step.two');
    }


    public function createStepTwo(Request $request)
    {
        $worker = $request->session()->get('worker');
  
        return view('worker.create-step-two',compact('worker'));
    }



    public function postCreateStepTwo(Request $request)
    {
        $validatedData = $request->validate([
            'stock' => 'required',
            'status' => 'required',
        ]);
  
        $worker = $request->session()->get('worker');
        $worker->fill($validatedData);
        $request->session()->put('worker', $worker); 
  
        return redirect()->route('workers.create.step.three');
    }



    public function createStepThree(Request $request)
    {
        $worker = $request->session()->get('worker');
  
        return view('worker.create-step-three',compact('worker'));
    }


    public function postCreateStepThree(Request $request)
    {
        $worker = $request->session()->get('worker');
        $worker->save();
  
        $request->session()->forget('worker');
  
        return redirect()->route('workers.index');
    }
}
