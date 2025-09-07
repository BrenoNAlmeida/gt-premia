<?php

namespace App\Http\Controllers;

use App\Models\feedback;
use App\Http\Requests\StorefeedbackRequest;
use App\Http\Requests\UpdatefeedbackRequest;

class FeedbackController extends Controller 
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedbacks = feedback::where('user_id', auth()->user()->id)->get();
        
        return view('feedback.list')->with('feedbacks', $feedbacks);
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
    public function store(StorefeedbackRequest $request)
    {
        $data = $request->all();
        //cria um feedback
        $feedback = new feedback();
        $feedback->user_id = $data['user_id'];
        $feedback->feedback = $data['feedback'];
        $feedback->valor_indicacao_id = $data['valor_id'];
        $feedback->save();

        return redirect()->route('usuarios.show', $feedback->user_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(feedback $feedback)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatefeedbackRequest $request, feedback $feedback)
    {
        $data = $request->all();
        //atualiza o feedback
        $feedback->feedback = $data['feedback'];
        $feedback->valor_indicacao_id = $data['valor_id'];
        $feedback->save();

        return redirect()->route('usuarios.show', $feedback->user_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(feedback $feedback)
    {
        //
    }
}
