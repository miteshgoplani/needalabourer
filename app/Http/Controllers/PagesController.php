<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
public function index()
{     $title='"Need A Labourer?"'; 
     //return view('pages.index',compact('title'));
     return view('pages.index')->with('title',$title);
}

public function profile()
{  //   $title='"Need A Labourer?"'; 
     //return view('pages.index',compact('title'));
     //return view('pages.index')->with('title',$title);
    return 'gg';
    }

public function about()
{     if(session()) 
       {$title='About Us';
       return view('pages.about')->with('title',$title);}
       else
       { $data = session()->all();
        return $data;
        //return redirect()->back()->with('error','Unauthorised Access');
       }
     //return view('pages.about');
}

public function services()
{    $data = array(
    'title'=>'Services we Offer:',
    'services'=>['Carpentry','Plumbing','Electrician','Construction-site Workers']
);
     
     return view('pages.services')->with($data);
}
}