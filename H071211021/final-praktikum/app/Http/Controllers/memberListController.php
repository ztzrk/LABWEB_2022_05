<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\memberList;

class memberListController extends Controller
{
    public function showMemberList()
    {
        $data = memberList::withCount('articles')->paginate(10);
        return view('memberList')
            -> with(compact('data'));
    }
}
