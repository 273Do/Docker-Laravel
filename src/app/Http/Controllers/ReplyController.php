<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplyRequest;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    // リプライの保存処理
    public function reply(ReplyRequest $request)
    {
        # ログインしているユーザのid
        $user_id = Auth::id();

        $input = $request['reply'];
        $input += ['user_id' => $user_id];
        $reply = new Reply();
        $reply->fill($input)->save();

        return redirect('/posts/' . $input['post_id']);
    }
}
