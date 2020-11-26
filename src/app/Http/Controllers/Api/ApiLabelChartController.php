<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LabelChartResource;
use App\Models\Collection;
use App\Models\Label;

class ApiLabelChartController extends Controller
{
    public function __construct()
    {
    }

    public function data(Collection $collection, Label $label)
    {
        return new LabelChartResource($label);
    }
}
