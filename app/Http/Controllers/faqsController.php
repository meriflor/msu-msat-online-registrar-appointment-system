<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;


class faqsController extends Controller
{

    public function index(){
        return view('faqs.faqs');
    }
    public function viewFaqAdmin(){
        $faqs = Faq::all();
        return view('admin-dashboard.faqs', compact('faqs'));
    }
    public function dashboardFaq(){
        $faqs = Faq::all();
        return view('faqs.faqs', compact('faqs'));
    }
    public function storeFaq(Request $request){
        $request->validate([
            'faqs_title' => 'required',
            'faqs_subtext' => 'required',
        ]);

        $faq = new Faq();
        $faq -> faqs_title = $request -> faqs_title;
        $faq -> faqs_subtext = $request -> faqs_subtext;
        $faq = $faq -> save();
        if($faq){
            return back()-> with ('success','Announcement post successfully');
    }else{
            return back()-> with('fail','Something wrong');
    }
    }
    public function viewOneFaq($id){
        $faqs = Faq::where('id', $id)->findOrFail($id);
    
        return response()->json([
              'faqs_title' => $faqs->faqs_title,
              'faqs_subtext' => $faqs->faqs_subtext,
        ]);
    }
    public function editFaq(Request $request){
        $faqs = Faq::find($request->faqID);
        $faqs->faqs_title= $request->editQuestion;
        $faqs->faqs_subtext = $request->editAnswer;
        $faqs->save();
    
        return response()->json(['success' => true, 'message' => 'You have edited the FAQs sucessfully']);
    }
    public function delete(Request $request, $id){
        $faqs = Faq::find($id);
        
        if($faqs){
            $faqs->delete();
              return response()->json(['success' => true, 'message' => 'You have deleted the FAQs successfully']);
        }return response()->json(['success' => false, 'message' => 'Error']);
    }
}
