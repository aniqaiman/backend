<?php

namespace App\Http\Controllers\Api;

use App\Feedback;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;

class FeedbackController extends Controller
{
    public function getFeedbacks($type)
    {
        if ($type === 'buyers') {
            $feedbacks = Feedback::whereHas('order', function ($order) {
                $order->where('user_id', JWTAuth::parseToken()->authenticate()->id);
            });

            return response()->json([
                'data' => $feedbacks->get(),
            ]);
        } else if ($type === 'sellers') {
            $feedbacks = Feedback::whereHas('stock', function ($stock) {
                $stock->where('user_id', JWTAuth::parseToken()->authenticate()->id);
            });

            return response()->json([
                'data' => $feedbacks->get(),
            ]);
        }
    }

    public function getUnreadFeedbacks($type)
    {
        if ($type === 'buyers') {
            return response()->json([
                'data' => JWTAuth::parseToken()
                    ->authenticate()
                    ->orders()
                    ->feedbacks()
                    ->where('has_read', 0)
                    ->get(),
            ]);
        } else if ($type === 'sellers') {
            return response()->json([
                'data' => JWTAuth::parseToken()
                    ->authenticate()
                    ->stocks()
                    ->feedbacks()
                    ->where('has_read', 0)
                    ->get(),
            ]);
        }
    }

    public function getSingleFeedback($type, $id)
    {
        if ($type === 'buyers') {
            return response()->json([
                'data' => JWTAuth::parseToken()
                    ->authenticate()
                    ->orders()
                    ->feedbacks()
                    ->find($id),
            ]);
        } else if ($type === 'sellers') {
            return response()->json([
                'data' => JWTAuth::parseToken()
                    ->authenticate()
                    ->stocks()
                    ->feedbacks()
                    ->find($id),
            ]);
        }
    }

    public function setReadFeedback($type, $id)
    {
        if ($type === 'buyers') {
            $feedback = JWTAuth::parseToken()
                ->authenticate()
                ->orders()
                ->feedbacks()
                ->find($id);
        } else if ($type === 'sellers') {
            $feedback = JWTAuth::parseToken()
                ->authenticate()
                ->stocks()
                ->feedbacks()
                ->find($id);
        }

        $feedback->has_read = 1;
        $feedback->save();

        return response()->json([
            'data' => $feedback,
        ]);
    }

    public function updateResponseFeedback(Request $request, $type, $id)
    {
        if ($type === 'buyers') {
            $feedback = JWTAuth::parseToken()
                ->authenticate()
                ->orders()
                ->feedbacks()
                ->find($id);
        } else if ($type === 'sellers') {
            $feedback = JWTAuth::parseToken()
                ->authenticate()
                ->stocks()
                ->feedbacks()
                ->find($id);
        }

        $feedback->response = $request->response;
        $feedback->save();

        return response()->json([
            'data' => $feedback,
        ]);
    }

}
