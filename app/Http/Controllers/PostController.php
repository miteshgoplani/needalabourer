<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;//to use the storage library
use App\Post;//to use Post model and therefore we can use all the tinker commands to store posts 
Use DB;
class PostController extends Controller
{   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()//this is a constructor which is activated when the class is called
        {
        $this->middleware('auth',['except' =>['index','show']]);//here we want to show the index and 
        //show(individual posts) views without making the user to authenticate or login so we passed an array
        //with an except command 
        }
        
    
    
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
       

       $posts = Post::orderBy('created_at','desc')->paginate(10);//this will send posts to diff pages with one post per page
       return view('posts.index')->with('posts',$posts);//a folder called posts that will be in resources/views folder will have index.blade.php

         
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
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
             
        'title'=>'required',   
        'body'=>'required',
        'cover_image'=> 'image|nullable|max:1999'//type is image and nullable to not make it a compulsory thing to upload images and for most of the apache servers max image size is 2 Megapix so limit is set to 1999 pixels  
        ]);
        

        //handle file uploading
       if($request->hasFile('cover_image'))//if image is uploaded
       {
          //Get file name with the extension
          $fileNameWithExt =$request->file('cover_image')->getClientOriginalName();//getClientOriginalName() is used to get the origianal file with extenxion and store it in $fileNameWithExt
          
          //get just filename using php
          $filename= pathinfo($fileNameWithExt, PATHINFO_FILENAME);//pathinfo is a function in php to get the file name

           //get just extension using laravel functoion
          $extension=$request->file('cover_image')->getClientOriginalExtension();

          //filename to store
          $fileNameToStore=$filename.'_'.time().'.'.$extension;// "." is used to concatenate,time is a timestamp function to make unique file names for each image uploaded that gives time of creation of post
                  
          //Upload Image
         $path=$request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
       }
       else
       {
         $fileNameToStore = 'noimage.jpg';//fileNameToStore is a  variable that will look into noimage when image is not uploaded and will use this default image in posts

       }

        //create posts
        $post=new Post;
        $post->title = $request->input('title');//save  the title entered from the form 
        $post->body = $request->input('body');//save the body to database using tinker commands
        $post->user_id = auth()->user()->id;//the user_id column of the posts table will be updated from user table's  id column obtained via Oauth
        $post->cover_image=$fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success','Post created');//success message in messages file has been linked using with and message displayed will be Post Created
    
    }  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post= Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post= Post::find($id);//find used to find the specific post using the id and to return it to the edit page 
        if(auth()->user()->id !== $post->user_id)
        {  
            return redirect('/posts')->with('error','Unauthorized Page');//if another user tries to edit the post by manually entering link to edit then he'll get an unauthorized access message

        }

        
        return view('posts.edit')->with('post',$post);//return with the post
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[//validating request by submit button
             
        'title'=>'required',   
        'body'=>'required'
        ]);

        if($request->hasFile('cover_image'))//if image is uploaded
       {
          //Get file name with the extension
          $fileNameWithExt =$request->file('cover_image')->getClientOriginalName();//getClientOriginalName() is used to get the origianal file with extenxion and store it in $fileNameWithExt
          
          //get just filename using php
          $filename= pathinfo($fileNameWithExt, PATHINFO_FILENAME);//pathinfo is a function in php to get the file name

           //get just extension using laravel functoion
          $extension=$request->file('cover_image')->getClientOriginalExtension();

          //filename to store
          $fileNameToStore=$filename.'_'.time().'.'.$extension;// "." is used to concatenate,time is a timestamp function to make unique file names for each image uploaded that gives time of creation of post
                  
          //Upload Image
         $path=$request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
       }
      

        //update posts table
        $post=Post::find($id);
        $post->title = $request->input('title');//save  the title entered from the form 
        $post->body = $request->input('body');//save the body to database using tinker commands
        if($request->hasFile('cover_image'))//if image is uploaded
        {  Storage::delete('public/cover_images/' . $post->cover_image);
          $post->cover_image=$fileNameToStore;//update the new image name
        }
        $post->save();

        return redirect('/posts')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $post = Post::find($id);
       if(auth()->user()->id !== $post->user_id)
        {  
            return redirect('/posts')->with('error','Unauthorized Page');//if another user tries to edit the post by manually entering link to edit then he'll get an unauthorized access message

        }

            if($post->cover_image !='noimage.jpg'){
             //delete image
             Storage::delete('public/cover_images/'.$post->cover_image);
             }
       $post->delete();
       return redirect('/posts')->with('success','Post Deleted');

    }
}
