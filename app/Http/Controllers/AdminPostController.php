<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Group;
use App\Models\Page;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'posts');
        
        $data = [];
        $perPage = 10;
        
        switch ($type) {
            case 'groups':
                $data['groups'] = Group::with([
                        'user' => function($query) {
                            $query->select('id', 'first_name', 'last_name', 'username', 'profile', 'thumbnail');
                        },
                        'members' => function($query) {
                            $query->select('users.id', 'first_name', 'last_name', 'username');
                        }
                    ])
                    ->withCount('members')
                    ->latest()
                    ->paginate($perPage, ['*'], 'page', $request->get('page', 1))
                    ->withQueryString();
                break;
                
            case 'channels':
                $data['channels'] = Page::with([
                        'user' => function($query) {
                            $query->select('id', 'first_name', 'last_name', 'username', 'profile', 'thumbnail');
                        },
                        'followers' => function($query) {
                            $query->select('users.id', 'first_name', 'last_name', 'username');
                        }
                    ])
                    ->withCount('followers')
                    ->latest()
                    ->paginate($perPage, ['*'], 'page', $request->get('page', 1))
                    ->withQueryString();
                break;
                
            case 'posts':
            default:
                $data['posts'] = Post::with([
                        'user' => function($query) {
                            $query->select('id', 'first_name', 'last_name', 'username', 'profile', 'thumbnail');
                        },
                        'likes',
                        'comments'
                    ])
                    ->withCount(['likes', 'comments'])
                    ->latest()
                    ->paginate($perPage, ['*'], 'page', $request->get('page', 1))
                    ->withQueryString();
                break;
        }
        
        $data['activeTab'] = $type;
        
        return view('admin.manage.index', $data);
    }
    
    public function deletePost($id)
    {
        try {
            $post = Post::findOrFail($id);
            
            // Delete related data
            $post->likes()->delete();
            $post->comments()->delete();
            
            // Delete the post
            $post->delete();
            
            return back()->with('success', 'Postingan berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus postingan: ' . $e->getMessage());
        }
    }
    
    public function deleteGroup($id)
    {
        try {
            $group = Group::with(['posts', 'members'])->findOrFail($id);
            
            // Delete related posts and their relationships
            foreach ($group->posts as $post) {
                $post->likes()->delete();
                $post->comments()->delete();
                $post->delete();
            }
            
            // Delete group members
            $group->members()->detach();
            
            // Delete the group
            $group->delete();
            
            return back()->with('success', 'Group berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus group: ' . $e->getMessage());
        }
    }
    
    public function deleteChannel($id)
    {
        try {
            $channel = Page::with(['posts', 'followers'])->findOrFail($id);
            
            // Delete related posts and their relationships
            foreach ($channel->posts as $post) {
                $post->likes()->delete();
                $post->comments()->delete();
                $post->delete();
            }
            
            // Delete channel followers
            $channel->followers()->detach();
            
            // Delete the channel
            $channel->delete();
            
            return back()->with('success', 'Saluran berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus saluran: ' . $e->getMessage());
        }
    }
}
