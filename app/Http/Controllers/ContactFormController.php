<?php

namespace App\Http\Controllers;
use App\Models\ContactForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactFormController extends Controller
{
    public function submitForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cname' => 'required',
            'cemail' => 'required|email',
            'cphone' => 'required',
            'cmessage' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $contactForm = new ContactForm();
        $contactForm->name = $request->input('cname');
        $contactForm->email = $request->input('cemail');
        $contactForm->phone = $request->input('cphone');
        $contactForm->message = $request->input('cmessage');
        $contactForm->save();

        return response()->json(['success' => 'Message submitted successfully'], 200);
    }

    public function showData()
    {
        $contactForms = ContactForm::all();
        return view('admin.contact-data', compact('contactForms'));
    }
}
