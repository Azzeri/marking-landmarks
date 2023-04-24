<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function getCommentsForLandmark(Request $request)
    {
        $comments = Comment::where('id_landmark', $request->landmarkId)->get();
        return $comments;
    }

    public function addComment(Request $request)
    {
        $idUser = 1;
        $idLandmark = $request->landmarkId;
        $content = $request->content;
        // $idLandmark = 207279185;

        Comment::create([
            'id_user' => $idUser,
            'id_landmark' => $idLandmark,
            'content' => $content
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }
}
