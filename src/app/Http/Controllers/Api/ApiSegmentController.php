<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Segment;
use Illuminate\Http\Response;

class ApiSegmentController extends Controller
{
    public function destroy(Collection $collection, Segment $segment)
    {
        $segment->delete();

        return response()->json(['message' => 'Segment destroyed.'], Response::HTTP_OK);
    }
}
