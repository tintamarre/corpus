<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Segment;
use Illuminate\Http\Response;

class ApiSegmentController extends Controller
{
    public function __construct()
    {
    }

    public function destroy(Collection $collection, Segment $segment)
    {
        $segment->delete();
        // return response()->json(['message' => 'A message.'], Response::HTTP_OK);
        return response(null, Response::HTTP_OK);
    }
}
