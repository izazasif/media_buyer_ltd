<?php

namespace App\Http\Controllers;
use App\Models\NewsArticle;
use App\Models\User;
use App\Models\Category;
use App\Models\ArticleCategory;
use App\Models\UploadFile;
use Illuminate\Http\Request;
use DB;
class NewsItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function showLatestPosts()
   {

    $latestPosts = Category::get();
    return response()->json([
        'latestPosts' => $latestPosts
    ],200);

   }
   public function nextLargePost()
   {
    $nextFourNews = Category::take(8)->get();
        return response()->json([
            'nextFourNews' => $nextFourNews
        ],200);
   }
   public function nextFourside ()
   {
      
    $nextFouride = NewsArticle::with('user')->where('status','=','Published')->latest()->skip(4)->take(5)->get();
        return response()->json([
            'nextFoursides' => $nextFouride
        ],200);
   }
   public function nextOnelarge()
   {
    
    $categoryId = 2; // The ID of the category you want to fetch articles for

    $articles = DB::table('news_articles')
                ->join('article_categories', 'news_articles.id', '=', 'article_categories.article_id')
                ->join('categories', 'article_categories.category_id', '=', 'categories.id')
                ->join('users','users.id','=','news_articles.user_id')
                ->where('article_categories.category_id', $categoryId)
                ->where('status','=','Published')
                ->select('news_articles.*', 'categories.name as category_name','users.name as user_name')
                ->first();
    return response()->json([
            'articles' => $articles
        ],200);
   }
   public function cateThreecontent()
   {
      
        $cateThreecontent = NewsArticle::latest()->where('status','=','Published')->skip(8)->take(3)->get();
            return response()->json([
                'cateThreecontents' => $cateThreecontent
            ],200);
   }
   public function lastFour(Request $request)
   {
    
    $categoryId = 40; // The ID of the category you want to fetch articles for
    $perPage = $request->input('per_page', 4); // Number of items per page, default is 4
    $page = $request->input('page', 1); // Current page, default is 1

    $articleslast = DB::table('news_articles')
        ->join('article_categories', 'news_articles.id', '=', 'article_categories.article_id')
        ->join('categories', 'article_categories.category_id', '=', 'categories.id')
        ->join('users', 'users.id', '=', 'news_articles.user_id')
        ->where('article_categories.category_id', $categoryId)
        ->where('status','=','Published')
        ->select('news_articles.*', 'categories.name as category_name', 'users.name as user_name')
        ->paginate($perPage, ['*'], 'page', $page);

        return response()->json($articleslast, 200);

   }
    /**
     * Show the form for creating a new resource.
     */
    public function details($id)
    {
        $data = DB::table('upload_files')
                ->join('categories', 'upload_files.category_id', '=', 'categories.id')
                ->where('categories.id', '=', $id) // Dynamically use $id
                ->select('categories.id','categories.meta_keywords as category_image', 'categories.name as category_name', 'upload_files.file_type', 'upload_files.file_path')
                ->get();

            $formattedData = [
                'category_name' => '', // Add category name placeholder
                'category_image' => '',
                'reels' => [],
                'images' => []
            ];

            foreach ($data as $item) {
                // Set category name once
                if (!$formattedData['category_name']) {
                    $formattedData['category_name'] = $item->category_name;
                }
                if (!$formattedData['category_image']) {
                    $formattedData['category_image'] = $item->category_image;
                }

                if ($item->file_type === 'reel') {
                    $formattedData['reels'][] = [
                        'url' => $item->file_path // Use 'url' for the file path
                    ];
                } elseif ($item->file_type === 'image') {
                    $formattedData['images'][] = [
                        'url' => $item->file_path // Use 'url' for the file path
                    ];
                }
            }

            return response()->json(['data' => $formattedData], 200);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
