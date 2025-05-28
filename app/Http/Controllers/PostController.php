<?php

namespace App\Http\Controllers;

use App\Events\ReplayAddedEvent;
use App\Helpers\PostHelper;
use App\Http\Requests\StorePostRequest;
use App\Models\Hashtag;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function index()
{
    $user = Auth::user();

    // جلب البوستات مع العلاقات مع Pagination
    $allposts = Post::whereIn('user_id', $user->following()->pluck('users.id')->push($user->id)) 
        ->whereNull('parent_id')
        ->with(['likes', 'user', 'image', 'replies', 'retweetedby', 'bookmark'])
        ->withCount(['replies', 'retweetedby', 'likes', 'bookmark'])
        ->orderByDesc('created_at')
        ->paginate(5); // هنا Pagination

    $suggestedUsers = $user->suggestedUsers();

    $hashtags = Hashtag::withCount('posts')
        ->orderByDesc('posts_count')
        ->limit(4)
        ->get();
    $allposts = PostHelper::injectIsLiked($allposts, $user);
    return Inertia::render('Tweet/Index', [
        'allposts' => $allposts,
        'user' => $user,
        'suggestedUsers' => $suggestedUsers,
        'hashtags' => $hashtags,
    ]);
}





    public function store(StorePostRequest $request  )
    {      
        $parentId=$request->input('parent_id');
        //postCeate
        $post = auth()->user()->posts()->create([
            'post' => $request->body,
            'parent_id'=>$parentId
        ]);
        //imageUpload
        if ($request->hasFile('images')) {
            $path = $request->file('images')->store('posts', 'public');
            $post->image()->create([
                'url' => $path,
                'type' => 'image',
            ]);
            }
            
            $hashtags = Post::extractHashtags($request->body);
            foreach($hashtags as $hashtag){
                $hashtagModel = Hashtag::firstOrCreate(['name' => $hashtag]);
                $post->hashtags()->attach($hashtagModel->id);
            }
        if($parentId){
            $oraginalTweet=Post::find($parentId);
            if($oraginalTweet && $oraginalTweet->user_id !== auth()->id()){
                
                event(new ReplayAddedEvent(auth()->user(),$oraginalTweet));
            }
        }
        return back();
    }
    public function retweet ($postId){
        //auth
        $user=Auth::user();
        //retweet
        if($user->retweets()->where('post_id', $postId)->exists()){
        $user->retweets()->detach($postId);
        }else{
            $user->retweets()->attach($postId);
        }
        return back();
    }

    public function show(Post $post)
    {
        //auth
        $user = Auth::user();
              $post->load('user', 'likes', 'replies', 'retweetedby', 'bookmark');

        $post=PostHelper::injectIsLiked($post, $user);
        return Inertia::render('Tweet/Show', ['post' => $post, 'user' => $user]);
    }

    public function trending(Request $request){
        $user=Auth::user();
        $trending = collect(); 
        if($request->has('filter') && $request->filter==='top_hashtags'){
            $hashtags=Hashtag::withCount('posts')
            ->orderByDesc('posts_count')
            ->limit(10)
            ->get();    
            return Inertia::render('Tweet/Trending', compact('user', 'hashtags', 'trending'));            
        }
        else{
        $trending=Post::rootPosts()
        ->with([ 
             'likes',
                'user',
                'image',
                'replies',
                'retweetedby',
                'bookmark'])
         ->withCount('replies', 'likes', 'retweetedby')       
        ->orderByRaw('(replies_count + likes_count + retweetedby_count) DESC')
        ->paginate(5);
        
        return Inertia::render('Tweet/Trending',compact('trending','user'));
        }
        
    }



}
