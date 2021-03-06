<?php
namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\labours;
use App\users;

class LabourController extends Controller
{
    public function profile(Request $request){
        
        //if(session('l_id')){
            $l_id =  $request->session()->get('l_id'); //Later found by auth
            $labour = labours::find($l_id);
            $category = category::find($labour->category_id);
            // return $department;
            $profilePic = Profile_images::find($l_id);
            // return $profilePic;
            
            return view('labours.pages.profile')->with('staff', $labour)->with('department',$category)->with('pic', $profilePic);
        //}
        //else{
            //return redirect()->back()->with('error','Unauthorised Access');
        //}
    }

    public function register(Request $request){

        $title='Register Labour';
       return view('pages.register')->with('title',$title);
    }

    public function searchLabour(){
        if(session('l_id')){
            //$term = Input::get('q');
            $l_id = labour::get('l_id');
            if(strlen($l_id) == 0){
                return redirect()->back()->with('error','Please enter first name or last name to search');
            }

            $results = array();
            
            $queries = Student::where('uid', '=', $term)
            ->orwhere('email_id', '=', $term)
            ->orWhere('first_name', 'like', $term.'%')
            ->orWhere('middle_name', 'like', $term.'%')
            ->orWhere('last_name', 'like', $term.'%')
            ->get();

            return view('faculty.pages.searchstudent') ->with ("students",$queries);
        }
        else{
            return redirect()->back()->with('error','Unauthorised Access');
        }
    }

    


}

