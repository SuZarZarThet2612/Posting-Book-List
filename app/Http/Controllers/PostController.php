<?php

namespace App\Http\Controllers;
use Storage;
use App\Models\Post;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    //customer create page
    public function create(){


        $post=Post:: when(request('searchKey'),function($p){
            $key=request('searchKey');
            $p->orwhere('title','like','%'.$key.'%')
              ->orwhere('description','like','%'.$key.'%');

        })
                    ->orderBy('created_at','desc')
                    ->paginate(4);

        return view('create',compact('post'));



}

    //post create
    public function postCreate(Request $request){


        $this->postValidationCheck($request);
        $data=$this->getPostData($request);
        if($request->hasFile('postImage')){


            $filename=uniqid()."_susu-".$request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->storeAs('public',$filename);
            $data['image']=$filename;
        }





        Post::create($data);

        return back()->with(['insertSuccess'=>'Post Create Successfully !']);


    }

    //post delete
    public function postDelete($id){


        Post::where('id',$id)->delete();

        return redirect()->route('post#createPage');


        }
        //update Page
    public function updatePage($id){

        $post=Post::where('id',$id)->first();

        // dd($post);
        return view('update',compact('post'));
    }


    //Edit Page
    public function editPage($id){
        $post=Post::where('id',$id)->first()->toArray();
        return view('edit',compact('post'));
    }

    //update Post
    public function update(Request $request){
        $this->postValidationCheck($request);
        $updateData=$this->getPostData($request);
        $id=$request->postId;

        if($request->hasFile('postImage')){
            // $request->file('postImage')->store('myImage');

            //delete
            $oldImageName=Post::select('image')->where('id',$id)->first();
            $oldImageName=$oldImageName['image'];
            if($oldImageName!=null){
                Storage::delete('public/'.$oldImageName);
            }

            $filename=uniqid()."_susu-".$request->file('postImage')->getClientOriginalName();
            $request->file('postImage')->storeAs('public',$filename);
            $updateData['image']=$filename;
        }

        Post::where('id',$id)->update($updateData);
        return redirect()->route('post#home')->with(['updateSuccess'=>'Post Update Successfully !']);
    }



    //get post data
    private function getPostData($request){
        $data=[
            'title'=>$request->postTitle,
            'description'=>$request->postDescription,
        ];
        $data['price']=$request->postFee==null?2000:$request->postFee;
        $data['address']=$request->postAddress==null?'pyay':$request->postAddress;
        $data['rating']=$request->postRating==null?5:$request->postRating;

        return $data;
    }

    //post validation Check
    private function postValidationCheck($request){
        $validationRules=[
            'postTitle'=>'required|min:3|unique:posts,title,'.$request->postId,
            'postDescription'=>'required',
            'postImage'=>'mimes:jpg,jpeg,png'

        ];

        $validationMessage=[
            'postTitle.required'=>'Post Title ဖြည့်ရပါမည်။',
            'postTilte.min'=>'အနည်းဆုံး ၄ လုံးအထက်ရှိရပါမည်။',
            'postTitle.unique'=>'Post Tilte တူနေပါသည်။ ထပ်မံရိုက်ပါ။',
            'postDescription.required'=>'Post Description ဖြည့်ရန်လိုအပ်ပါသည်။',
            'postFee.required'=>'Post Fee ဖြည့်ရန်လိုအပ်ပါသည်။',
            'postAddress.required'=>'Post Address ဖြည့်ရန်လိုအပ်ပါသည်။',
            'postRating.required'=>'Post Rating ဖြည့်ရန်လိုအပ်ပါသည်။',
            'postImage.mimes'=>'Post Image သည် jpg,jpeg,npg ဖြည့်ရန်လိုအပ်ပါသည်။',
            'postImage.file'=>'Post Image သည် File ဖြည့်ရန်လိုအပ်ပါသည်။'

        ];

        Validator::make($request->all(),$validationRules,$validationMessage)->validate();
    }



}
