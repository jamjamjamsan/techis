<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use App\Models\Bookmark;


class BookmarkController extends Controller
{
    public function index()
    {
        $items = Auth::user()->bookmark_items()->orderBy('created_at', 'desc')->paginate(10);

        return view('bookmark.index', ["items" => $items]);
    }

    public function store($id)
    {
        $user = Auth::user();

        if (!$user->is_bookmark($id)) {
            $user->bookmark_items()->attach($id);
        }
        return back();
    }
    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->is_bookmark($id)) {
            $user->bookmark_items()->detach($id);
        }
        return back();
    }
}
