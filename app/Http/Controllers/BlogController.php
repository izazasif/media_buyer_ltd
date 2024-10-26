<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\ArticleCategory;
use App\Models\NewsArticle;
use App\Models\UploadFile;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
class BlogController extends Controller
{   
    public function index()
    {
            $is_active = "blog_index";
            $data = DB::table('news_articles')
                    ->leftJoin('article_categories', 'news_articles.id', '=', 'article_categories.article_id')
                    ->leftJoin('categories', 'article_categories.category_id', '=', 'categories.id')
                    ->leftJoin('users', 'users.id', '=', 'news_articles.user_id')
                    ->select(
                        'news_articles.id as article_id',
                        'news_articles.title as article_title',
                        'news_articles.published_at as article_published_at',
                        'news_articles.status as article_status',
                        'news_articles.main_image as article_main_image',
                        'categories.id as category_id',
                        'categories.name as category_name',
                        'users.id as user_id',
                        'users.name as user_name'
                    )
        ->paginate(6);
    
        return view('blog.index',compact('is_active','data'));
        
    }
    public function create()
    {
        $is_active = "create_blog";
        $cat = Category::get();
        return view('blog.create',compact('is_active','cat'));

    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'files.*' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:20480', // Validate images
            'reel' => 'required|file|mimes:mp4|max:20480', // Validate reel
        ]);
        
        // Upload the reel
        $reelFile = $request->file('reel');
        $reelName = date('YmdHis') . "_" . mt_rand(1, 999999) . "." . $reelFile->getClientOriginalExtension(); // Use $reelFile here
        $image_path = $reelFile->move('website/blog', $reelName);
        $reelName =  'blog/' . $reelName;
        
        // Store the reel in the database
        UploadFile::create([
            'category_id' => $request->category_id,
            'file_name' => $reelName,
            'file_type' => 'reel',
            'file_path' => $reelName,
        ]);
        
        // Upload images if present
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                if ($file) { // Ensure $file is not null
                    $image_name = date('YmdHis') . "_" . mt_rand(1, 999999) . "." . $file->getClientOriginalExtension(); // Use $file here
                    $image_path = $file->move('website/blog', $image_name);
                    $image_name =  'blog/' . $image_name;
        
                    // Store image details in the database
                    UploadFile::create([
                        'category_id' => $request->category_id,
                        'file_name' => $image_name,
                        'file_type' => 'image',
                        'file_path' => $image_name,
                    ]);
                }
            }
        }
        
        return redirect()->back()->with('message', 'Files and Reel uploaded successfully!');
        
    }
    public function froalaUpload(Request $request)
    {
        // Check if the request has a file
        if ($request->hasFile('file')) {
            // Get the uploaded file
            $file = $request->file('file');
            
            // Generate a unique name for the file
            $fileName = date('YmdHis') . "_" . mt_rand(1, 999999) . "." . $file->getClientOriginalExtension();
            
            // Move the file to the public folder
            $filePath = $file->move('website/froala', $fileName);
            
            // Construct the file URL
            $fileUrl = asset('website/froala/' . $fileName);

            // Return a response with the file URL
            return response()->json(['link' => $fileUrl]);
        }

        // Return an error response if the file is not uploaded
        return response()->json(['error' => 'File upload failed.'], 400);
    }
   
    public function edit($id)
    {   
        $is_active = "blog_index";
        $data = DB::table('news_articles')
                ->join('article_categories', 'news_articles.id', '=', 'article_categories.article_id')
                ->join('categories', 'article_categories.category_id', '=', 'categories.id')
                ->where('news_articles.id',$id)
                ->select('news_articles.*','categories.name as category_name')
                ->first();
        return view('blog.edit',compact('is_active','data'));
    }
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'meta_title' => 'required|string|max:255',
            'meta_keywords' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image validation
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find the blog post by its ID
        $blog = NewsArticle::find($id);

        if (!$blog) {
            return redirect()->back()->with('error', 'Blog post not found.');
        }

        // Update the blog information
        $blog->title = $request->input('title');
        $blog->meta_title = $request->input('meta_title');
        $blog->meta_keywords = $request->input('meta_keywords');
        $blog->meta_description = $request->input('meta_description');
        $blog->content = $request->input('content');

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('website'), $imageName);

            // Delete the old image if a new one is uploaded
            if ($blog->main_image) {
                $oldImage = public_path('website/' . $blog->main_image);
                if (file_exists($oldImage)) {
                    unlink($oldImage); // Remove the old image
                }
            }

            // Save the new image path
            $blog->main_image = $imageName;
        }

        // Save the updated blog post
        $blog->save();

        // Redirect back with a success message
        return redirect()->route('article.index')->with('message', 'Article post updated successfully.');
    }
    public function froalaUpload2(Request $request)
    {
        // Check if the request has a file
        if ($request->hasFile('file')) {
            // Get the uploaded file
            $file = $request->file('file');
            
            // Generate a unique name for the file
            $fileName = date('YmdHis') . "_" . mt_rand(1, 999999) . "." . $file->getClientOriginalExtension();
            
            // Move the file to the public folder
            $filePath = $file->move('website/froala', $fileName);
            
            // Construct the file URL
            $fileUrl = asset('website/froala/' . $fileName);

            // Return a response with the file URL
            return response()->json(['link' => $fileUrl]);
        }

        // Return an error response if the file is not uploaded
        return response()->json(['error' => 'File upload failed.'], 400);
    }
    public function destroy($id)
    {
        // Find the item by ID and delete it
        $item = NewsArticle::findOrFail($id);
        $item->delete();
        
        $message = 'Successful! Item deleted successfully.';
        // Redirect back with a success message
        return redirect()->back()->with('message',$message);
    }
    public function updateStatus($id, $status)
    {
        // Find the news item by its ID
        $newsItem = NewsArticle::find($id);

        // Ensure the news item exists
        if (!$newsItem) {
            return redirect()->back()->with('error', 'News item not found.');
        }

        // Check if the status is valid
        $validStatuses = ['draft', 'published', 'archived'];
        if (!in_array($status, $validStatuses)) {
            return redirect()->back()->with('error', 'Invalid status value.');
        }

        // Update the status
        $newsItem->status = $status;
        if ($status == 'published') {
            $newsItem->published_at = Carbon::now(); // Set current time
        }
        $newsItem->save();
        
        $message = 'Successful! Status updated successfully.';
        // Redirect back with a success message
        return redirect()->back()->with('message', $message);
    }
}
