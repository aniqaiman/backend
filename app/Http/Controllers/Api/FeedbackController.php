<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;

class FeedbackController extends Controller
{
    public function getFeedbacks()
    {
        return response()->json([
            'data' => JWTAuth::parseToken()
                ->authenticate()
                ->feedbacks()
                ->get(),
        ]);
    }

    public function getUnreadFeedbacks()
    {
        return response()->json([
            'data' => JWTAuth::parseToken()
                ->authenticate()
                ->feedbacks()
                ->where('has_read', 0),
        ]);
    }

    public function getSingleFeedback($id)
    {
        return response()->json([
            'data' => JWTAuth::parseToken()
                ->authenticate()
                ->feedbacks()
                ->find($id),
        ]);
    }

    public function setReadFeedback($id)
    {
        $feedback = JWTAuth::parseToken()
            ->authenticate()
            ->feedbacks()
            ->find($id);

        $feedback->has_read = 1;
        $feedback->save();

        return response()->json([
            'data' => $feedback,
        ]);
    }

    public function updateResponseFeedback(Request $request, $id)
    {
        $feedback = JWTAuth::parseToken()
            ->authenticate()
            ->feedbacks()
            ->find($id);

        $feedback->response = $request->response;
        $feedback->save();

        return response()->json([
            'data' => $feedback,
        ]);
    }

}
