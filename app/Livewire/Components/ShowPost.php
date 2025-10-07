<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\SavedPost;
use App\Models\User;

class ShowPost extends Component
{


    public function render()
    {
        return view('livewire.components.show-post')->extends('layouts.app');
    }

    public function saveComment($post_id, Request $request)
    {
        $request->validate([
            "comment" => "required|string"
        ]);
        DB::beginTransaction();
        try {
            Comment::firstOrCreate([
                "post_id" => $post_id,
                "comment" => $request->comment,
                "user_id" => auth()->id()
            ]);
            $post = Post::findOrFail($post_id);
            $post->comments += 1;
            $post->save();
            Notification::create([
                "type" => "Comment Post",
                "user_id" => $post->user_id,
                "message" => auth()->user()->username . " commented on your post",
                "url" => "/post/" . $post->uuid
            ]);
            DB::commit();
            session()->flash('success', 'You have successfully commented on the post');
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Something went wrong');
            throw $th;
        }
        unset($this->comment);

        return redirect()->back();
    }

    public function editPost(Request $request)
    {
        $post = Post::findOrFail($request->post_id);

        DB::beginTransaction();
        try {
            $post->update([
                'title' => $request->title,
                'content' => $request->content,
            ]);
            DB::commit();
            session()->flash('success', 'Post updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Something went wrong');
            throw $e;
        }

        if ($request->hasFile('thumbnail')) {
            // the old thumbnail will be deleted from the storage
            $thumbnail = time() . '.' . $request->thumbnail->extension();
            $path = public_path('images/thumbnails');
            $request->thumbnail->move($path, $thumbnail);
            $post->thumbnail = $thumbnail;
            $post->save();
        }
        return redirect()->route('post.show', $post->uuid);
    }
    public function deletePost($post_id)
    {
        // search post by uuid
        $post = Post::where('uuid', $post_id)->first();
        $post->delete();
        session()->flash('success', 'Post deleted successfully');
        return redirect()->route('profile.show', Auth::user()->username);
    }
    
    public function deleteComment($commentId)
    {
        $comment = Comment::with('post')->findOrFail($commentId);
        
        // Check if the authenticated user is the owner of the comment, the post owner, or an admin
        if (auth()->id() !== $comment->user_id && 
            auth()->id() !== $comment->post->user_id && 
            auth()->user()->role !== 'admin') {
            session()->flash('error', 'Anda tidak memiliki izin untuk menghapus komentar ini');
            return redirect()->back();
        }
        
        DB::beginTransaction();
        try {
            // Decrement the comment count on the post
            $post = $comment->post;
            $post->decrement('comments');
            
            // Delete the comment
            $comment->delete();
            
            DB::commit();
            session()->flash('success', 'Komentar berhasil dihapus');
            
            // Return JSON response for AJAX requests
            if (request()->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Komentar berhasil dihapus']);
            }
            
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error deleting comment: ' . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan saat menghapus komentar');
            
            if (request()->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menghapus komentar'], 500);
            }
        }
        
        return redirect()->back();
    }

    public function deleteAndBan($post_id)
    {
        $post = Post::where('uuid', $post_id)->first();
        $user = User::where('id', $post->user_id)->first();
        $this->deletePost($post_id);
        if ($user->is_banned > 3) {
            $user->update([
                'is_private' => 1,
            ]);
            Notification::create([
                "type" => "Temporary Lock",
                "user_id" => $user->id,
                "message" => $user->username . " You have been Temporary Lock.",
                "url" => "logout"
            ]);
        } else {
            $user->update([
                'is_banned' => $user->is_banned + 1,
                'banned_at' => now('Asia/Yangon'),
                'banned_to' => now('Asia/Yangon')->addMinute(5)
            ]);

            Notification::create([
                "type" => "Ban User",
                "user_id" => $user->id,
                "message" => $user->username . " You have been banned from the platform.",
                "url" => "/profile/" . $user->username
            ]);
        }
        return redirect()->route('admin');
    }
}
