<?php

namespace App\Http\Controllers;

use App\Events\ReplayAddedEvent;
use App\Http\Requests\StorePostRequest;
use App\Models\Hashtag;
use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use App\Notifications\ReplayAdded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\File as RulesFile;
use PhpParser\Node\Expr\FuncCall;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = Auth::user();
        // MY TWEETS
        $tweets = $user->rootPosts()->get();
          // MY RETWEETS
        $retweets=$user->retweets()->rootPosts()->get();
        // FOLOWERS TWEETS AND RETWEETS
        $followings = $user->followinPost()->rootPosts()->get();

        $suggestedUsers=$user->suggestedUsers();

        $hashtags=Hashtag::withCount('posts')
        ->orderByDesc('posts_count')
        ->limit(4)
        ->get(); 

        $allposts = $tweets->merge($retweets)->merge($followings)->sortByDesc('created_at');                         
        return view('tweet.index', compact('allposts', 'user','suggestedUsers','hashtags'));
    }




    public function store(StorePostRequest $request  )
    {
        $parentId=$request->input('parent_id');
        //postCeate
        $post = auth()->user()->posts()->create([
            'post' => $request->post,
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
            
            $hashtags=Post::extractHashtags($request->post);
            foreach($hashtags as $hashtag){
            $hashtagModel=Hashtag::firstOrCreate(['name'=>$hashtag]);
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
        $user->retweets()->attach($postId);

        return redirect('/tweet');
    }

    public function show(Post $post)
    {
        //auth
        $user = Auth::user();

        $post->load('user', 'image', 'retweetedBy');
        return view('tweet.show', compact('post','user'));
    }

    public function trending(Request $request){
        $user=Auth::user();
        $trending = collect(); 
        if($request->has('filter') && $request->filter==='top_hashtags'){
            $hashtags=Hashtag::withCount('posts')
            ->orderByDesc('posts_count')
            ->limit(10)
            ->get();    
            return view('tweet.trending', compact('user', 'hashtags', 'trending'));            
        }
        else{
        $trending=Post::rootPosts()
        ->withCount(['replies','likes','retweetedby'])
        ->orderByRaw('(replies_count + likes_count + retweetedby_count) DESC')
        ->limit(10)
        ->get();
        return view('tweet.trending',compact('trending','user'));
        }
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
