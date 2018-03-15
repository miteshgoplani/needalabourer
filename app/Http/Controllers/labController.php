<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;//to use the storage library
use App\lab; 
Use DB;
class labController extends Controller
{


    public function __construct()//this is a constructor which is activated when the class is called
    {
    $this->middleware(['auth','2fa'],['except' =>['index','show']]);//here we want to show the index and 
    //show(individual posts) views without making the user to authenticate or login so we passed an array
    //with an except command 
    }

    //====auth()->user()->name


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //$posts= Post::orderBy('title','desc')->get();//will display all the posts,orderBy is the part of eloquent model 
       //$posts= Post::orderBy('title','desc')->take(1)->get();//take(1) will display only one post 
       
       //$posts=Post::all();
       //$posts=DB::select('SELECT * FROM posts');//using SQL queries
       
       //return Post::where('title','Post Two')->get();//will display Post Two
       
       
       $labs = lab::orderBy('rating','desc')->paginate(10);//this will send posts to diff pages with one post per page
       //return count($posts);
       return view('labs.index')->with('labs',$labs);//a folder called posts that will be in resources/views folder will have index.blade.php

         
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        if(auth()->user()->name=='admin')
        return view('labs.create');
        else
        return redirect('/')->with('error','Unauthorized Access!!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request,[//validating request by submit button
             
        // 'type'=>'required',   
        'name'=>'required',
        'profile_image'=> 'image|nullable|max:1999',//type is image and nullable to not make it a compulsory thing to upload images and for most of the apache servers max image size is 2 Megapix so limit is set to 1999 pixels  
        'proof_image'=> 'image|nullable|max:1999',
        // 'zone'=>'required',
        'aadhar'=>'required',
        ]);
        
        
        //handle file uploading for profile_image
       if($request->hasFile('profile_image'))//if image is uploaded
       {            //Get file name with the extension
          $fileNameWithExt =$request->file('profile_image')->getClientOriginalName();//getClientOriginalName() is used to get the origianal file with extenxion and store it in $fileNameWithExt
          
          //get just filename using php
          $filename= pathinfo($fileNameWithExt, PATHINFO_FILENAME);//pathinfo is a function in php to get the file name

           //get just extension using laravel functoion
          $extension=$request->file('profile_image')->getClientOriginalExtension();

          //filename to store
          $fileNameToStore=$filename.'_'.time().'.'.$extension;// "." is used to concatenate,time is a timestamp function to make unique file names for each image uploaded that gives time of creation of post
                  
          //Upload Image
         $path=$request->file('profile_image')->storeAs('public/profile_images',$fileNameToStore);
         //Storage::copy('/public/cover_images/'.$fileNameToStore, '/needalabourer/public/cover_images'.$fileNameToStore);
         $request->file('profile_image')->move(public_path('/profile_images'), $fileNameToStore);
        }
       else
       {
         $fileNameToStore = 'noimage.jpg';//fileNameToStore is a  variable that will look into noimage when image is not uploaded and will use this default image in posts

       }

        //handle file uploading for proof_image
        if($request->hasFile('proof_image'))//if image is uploaded
        {            //Get file name with the extension
           $fileNameWithExt2 =$request->file('proof_image')->getClientOriginalName();//getClientOriginalName() is used to get the origianal file with extenxion and store it in $fileNameWithExt
           
           //get just filename using php
           $filename2= pathinfo($fileNameWithExt2, PATHINFO_FILENAME);//pathinfo is a function in php to get the file name
 
            //get just extension using laravel functoion
           $extension2=$request->file('proof_image')->getClientOriginalExtension();
 
           //filename to store
           $fileNameToStore2=$filename2.'_'.time().'.'.$extension2;// "." is used to concatenate,time is a timestamp function to make unique file names for each image uploaded that gives time of creation of post
                   
           //Upload Image
          $path2=$request->file('proof_image')->storeAs('public/proof_images',$fileNameToStore2);
          //Storage::copy('/public/cover_images/'.$fileNameToStore, '/needalabourer/public/cover_images'.$fileNameToStore);
          $request->file('proof_image')->move(public_path('/proof_images'), $fileNameToStore2);
         }
        else
        {
          $fileNameToStore2 = 'noimage.jpg';//fileNameToStore is a  variable that will look into noimage when image is not uploaded and will use this default image in posts
 
        }
        
        // return($request->input('input-1'));
        //create labour account
        $lab=new lab;
        $lab->type = $request->input('type');//save  the title entered from the form 
        $lab->name = $request->input('name');//save the body to database using tinker commands
        //$post->user_id = auth()->user()->id;//the user_id column of the posts table will be updated from user table's  id column obtained via Oauth
        $lab->profile_image=$fileNameToStore;
        $lab->proof_image=$fileNameToStore2;
        $lab->zone=$request->input('zone');
        $lab->aadhar=$request->input('aadhar');
        $lab->description=$request->input('description');
        $lab->rating=$request->input('input-1');
        $lab->save();
        
        
        return redirect('/labs')->with('success','Labour Account Created Successfully!!');//success message in messages file has been linked using with and message displayed will be Post Created
        
    }  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lab= lab::find($id);
        return view('labs.show')->with('lab',$lab);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lab= lab::find($id);//find used to find the specific post using the id and to return it to the edit page 
        if(auth()->user()->name !== 'admin')
        {  
            return redirect('/labs')->with('error','Unauthorized Access!!');//if another user tries to edit the post by manually entering link to edit then he'll get an unauthorized access message

        }

        
        return view('labs.edit')->with('lab',$lab);//return with the post
    }


    public function book($id)
    {
        $lab= lab::find($id);//find used to find the specific post using the id and to return it to the edit page 
        if(auth()->user()->name == 'admin')
        {  
            return redirect('/labs')->with('error','Admin cannot book Labour!!');//if another user tries to edit the post by manually entering link to edit then he'll get an unauthorized access message

        }

        
        return view('labs.book')->with('lab',$lab);//return with the post
    }

    public function endbook($id)
    {
        $lab= lab::find($id);//find used to find the specific post using the id and to return it to the edit page 
        if(auth()->user()->name == 'admin')
        {  
            return redirect('/labs')->with('error','Admin cannot end a booking by User!!');//if another user tries to edit the post by manually entering link to edit then he'll get an unauthorized access message

        }

        
        return view('labs.endbook')->with('lab',$lab);//return with the post
    }



    // public function booking(Request $request, $id)
    // {   
    //     $this->validate($request,[//validating request by submit button
             
    //         // 'type'=>'required',   
    //         'address'=>'required',
    //         'contact'=>'required',
    //         'date'=>'required',
    //         ]);
            
    //     //update labs table
    //     $lab=lab::find($id);
    //     $lab->status=1;
    //     $lab->address = $request->input('address');
    //     $lab->date = $request->input('date');
    //     $lab->user_id = auth()->user()->id;//the user_id column of the posts table will be updated from user table's  id column obtained via Oauth
    //     $lab->contact=$request->input('contact');
    
    //     $lab->save();

    //     return redirect('/labs')->with('success','Booking done Successfully!!');
    // }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   if(!$request->input('contact'))
        {
        $this->validate($request,[//validating request by submit button
             
            // 'type'=>'required',   
            'name'=>'required',
            'profile_image'=> 'image|nullable|max:1999',//type is image and nullable to not make it a compulsory thing to upload images and for most of the apache servers max image size is 2 Megapix so limit is set to 1999 pixels  
            'proof_image'=> 'image|nullable|max:1999',
            // 'zone'=>'required',
            'aadhar'=>'required',
            ]);
            
            
            //handle file uploading for profile_image
           if($request->hasFile('profile_image'))//if image is uploaded
           {            //Get file name with the extension
              $fileNameWithExt =$request->file('profile_image')->getClientOriginalName();//getClientOriginalName() is used to get the origianal file with extenxion and store it in $fileNameWithExt
              
              //get just filename using php
              $filename= pathinfo($fileNameWithExt, PATHINFO_FILENAME);//pathinfo is a function in php to get the file name
    
               //get just extension using laravel functoion
              $extension=$request->file('profile_image')->getClientOriginalExtension();
    
              //filename to store
              $fileNameToStore=$filename.'_'.time().'.'.$extension;// "." is used to concatenate,time is a timestamp function to make unique file names for each image uploaded that gives time of creation of post
                      
              //Upload Image
             $path=$request->file('profile_image')->storeAs('public/profile_images',$fileNameToStore);
             //Storage::copy('/public/cover_images/'.$fileNameToStore, '/needalabourer/public/cover_images'.$fileNameToStore);
             $request->file('profile_image')->move(public_path('/profile_images'), $fileNameToStore);
            }
           else
           {
             $fileNameToStore = 'noimage.jpg';//fileNameToStore is a  variable that will look into noimage when image is not uploaded and will use this default image in posts
    
           }
    
            //handle file uploading for proof_image
            if($request->hasFile('proof_image'))//if image is uploaded
            {            //Get file name with the extension
               $fileNameWithExt2 =$request->file('proof_image')->getClientOriginalName();//getClientOriginalName() is used to get the origianal file with extenxion and store it in $fileNameWithExt
               
               //get just filename using php
               $filename2= pathinfo($fileNameWithExt2, PATHINFO_FILENAME);//pathinfo is a function in php to get the file name
     
                //get just extension using laravel functoion
               $extension2=$request->file('proof_image')->getClientOriginalExtension();
     
               //filename to store
               $fileNameToStore2=$filename2.'_'.time().'.'.$extension2;// "." is used to concatenate,time is a timestamp function to make unique file names for each image uploaded that gives time of creation of post
                       
               //Upload Image
              $path2=$request->file('proof_image')->storeAs('public/proof_images',$fileNameToStore2);
              //Storage::copy('/public/cover_images/'.$fileNameToStore, '/needalabourer/public/cover_images'.$fileNameToStore);
              $request->file('proof_image')->move(public_path('/proof_images'), $fileNameToStore2);
             }
            else
            {
              $fileNameToStore2 = 'noimage.jpg';//fileNameToStore is a  variable that will look into noimage when image is not uploaded and will use this default image in posts
     
            }
          
      
        //update labs table
        $lab=lab::find($id);
        $lab->type = $request->input('type');
        $lab->name = $request->input('name');
        //$post->user_id = auth()->user()->id;//the user_id column of the posts table will be updated from user table's  id column obtained via Oauth
        $lab->zone=$request->input('zone');
        $lab->aadhar=$request->input('aadhar');
        $lab->description=$request->input('description');
        if($request->hasFile('profile_image'))//if image is uploaded
        {  Storage::delete('public/profile_images/' . $lab->profile_image);
            //Storage::delete(public_path('/cover_images') . $post->cover_image);
            unlink(public_path('profile_images/') . $lab->profile_image);
            $lab->profile_image=$fileNameToStore;//update the new image name
        }
        if($request->hasFile('proof_image'))//if image is uploaded
        {  Storage::delete('public/proof_images/' . $lab->proof_image);
            //Storage::delete(public_path('/cover_images') . $post->cover_image);
            unlink(public_path('proof_images/') . $lab->proof_image);
            $lab->proof_image=$fileNameToStore2;//update the new image name
        }

        $lab->save();

        return redirect('/labs')->with('success','Labour Profile Updated');
    
    }
    else
    {
        $this->validate($request,[//validating request by submit button
             
            // 'type'=>'required',   
            'address'=>'required',
            'contact'=>'required',
            'date'=>'required',
            ]);
            
        //update labs table
        $lab=lab::find($id);
        $lab->status=1;
        $lab->address = $request->input('address');
        $lab->date = $request->input('date');
        $lab->user_id = auth()->user()->id;//the user_id column of the posts table will be updated from user table's  id column obtained via Oauth
        $lab->contact=$request->input('contact');
    
        $lab->save();

        return redirect('/labs')->with('success','Booking done Successfully!!');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {  
       $lab = lab::find($id);
       if(auth()->user()->name !== 'admin')
        {  
            return redirect('/labs')->with('error','Unauthorized Access');//if another user tries to edit the post by manually entering link to edit then he'll get an unauthorized access message

        }

            if($lab->profile_image !='noimage.jpg'){
             //delete image
             Storage::delete('public/profile_images/'.$lab->profile_image);
             //Storage::delete(public_path('/cover_images') . $post->cover_image); This method doesn't work
             unlink(public_path('/profile_images/') . $lab->profile_image);
            //Unlink is a general php method to delete files
            }
            if($lab->proof_image !='noimage.jpg')
            {Storage::delete('public/proof_images/'.$lab->proof_image);
             //Storage::delete(public_path('/cover_images') . $post->cover_image); This method doesn't work
             unlink(public_path('/proof_images/') . $lab->proof_image);
            //Unlink is a general php method to delete files 
            }
       $lab->delete();
       return redirect('/labs')->with('success','Labourer Account Deleted');

    }
}
