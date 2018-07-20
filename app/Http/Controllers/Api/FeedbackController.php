<?php

namespace App\Http\Controllers\Api;

use App\Feedback;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;

class FeedbackController extends Controller
{
    public function getFeedbacks()
    {
        $userId = JWTAuth::parseToken()->authenticate()->id;

        return response()->json([
            'data' => Feedback::with([
                'orders' => function ($orders) use ($userId) {
                    $orders->where('user_id', $userId);
                },
                'stocks' => function ($stocks) use ($userId) {
                    $stocks->where('user_id', $userId);
                },
            ]),
        ]);
    }

    public function getUnreadFeedbacks()
    {
        return response()->json([
            'data' => Feedback::query()
                ->where('has_read', 0),
        ]);
    }

    public function getSingleFeedback($id)
    {
        return response()->json([
            'data' => Feedback::find($id),
        ]);
    }

    public function setReadFeedback($id)
    {
        $feedback = Feedback::find($id);
        $feedback->has_read = 1;
        $feedback->save();

        return response()->json([
            'data' => $feedback,
        ]);
    }

    public function updateResponseFeedback(Request $request, $id)
    {
        $feedback = Feedback::find($id);
        $feedback->response = $request->response;
        $feedback->save();

        return response()->json([
            'data' => $feedback,
        ]);
    }

}
