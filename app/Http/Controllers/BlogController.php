<?php

namespace App\Http\Controllers;

use App\BlogModel;
use App\commentModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index() {
        $myBlogs = BlogModel::all();
        return view('template.indexTemplate')
            ->with(['myBlogs' => $myBlogs]);
            
    }
    public function about() {
        return view('template.aboutTemplate');
    }

    // create blog
    public function post(Request $request) {
        $validator = Validator::make($request->all(),[
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|min:3|max:50',
            'description' => 'required|min:10|max:100',
            'content' => 'required|min:20|max:5000'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'failed', 'errors' => $validator->errors()]);
        } else {
            $validatedData = $request->all();
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = 'blog_'. time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $validatedData['image'] = $imageName;
            }
            $myBlogs = BlogModel::create($validatedData);
            return response()->json(['status' => 'success', 'myBlogs' => $myBlogs]);
        }
    }
    // delete blog
    public function deleteBlog(Request $request) {
        try{
            $id = $request->input('id');
            $toDelete = BlogModel::findOrFail($id);
            $imagePath = public_path('images/' . $toDelete['image']);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
                $toDelete->delete();
                $myBlogs = BlogModel::all();
                return response()->json(['status' => 'success', 'myBlogs' => $myBlogs]);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['status' => 'failed']);
        }
    }
    // read blog
    public function read($id) {
        try{
            $myBlogs = BlogModel::findOrFail($id);
            $comments = commentModel::where('blogId', $id)->get();
            return view('template.blogTemplate')->with(['blogs'=>$myBlogs, 'comments'=>$comments]);
        } catch (ModelNotFoundException $e) {
            return redirect('404');
        }
    }
    // comment
    public function comment(Request $request) {
        try{
            $validator = Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'text' => 'required|min:6|max:500'
            ]);
            if($validator->fails()) {
                return response()->json(['status' => 'failed', 'errors'=>$validator->errors()]);
            } else {
                $validatedData = $request->all();
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $imageName = 'comment_'. time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images'), $imageName);
                    $validatedData['image'] = $imageName;
                    $comments = commentModel::create($validatedData);
                return response()->json(['status' => 'success', 'comments' => $comments]);
                }
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['status' => 'failed']);
        }
    }
    // delete comment
    public function deleteComment(Request $request) {
        try{
            $id = $request->input('id');
            $toDelete = commentModel::findOrFail($id);
            $imagePath = public_path('images/' . $toDelete['image']);
            $blogId = $toDelete['blogId'];
            if (File::exists($imagePath)) {
                File::delete($imagePath);
                $toDelete->delete();
                $comments = commentModel::where('blogId', $blogId)->get();
                return response()->json(['status' => 'success', 'comments' => $comments]);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['status' => 'failed']);
        }
    }
}
