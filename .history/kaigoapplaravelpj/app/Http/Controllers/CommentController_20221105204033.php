<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function show(Comment $comment)
    {
        $item = Comment::where('patient_id',$comment->patient_id);
        if ($item) {
            return response()->json([
                'data' => $item
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }
    
    public function store(Request $request)
    {
        $item = Comment::create($request->all());
        return response()->json([
            'data' => $item
        ], 201);
    }

    public function update(Request $request, Comment $comment)
    {
        $update = [
'message' => $request->message,
'url' => $request->url
];
$item = Rest::where('id', $rest->id)->update($update);
if ($item) {
return response()->json([
'message' => 'Updated successfully',
], 200);
} else {
return response()->json([
'message' => 'Not found',
], 404);
}
    }

    public function destroy(Comment $comment)
    {
        //
    }
}
