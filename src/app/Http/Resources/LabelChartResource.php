<?php

namespace App\Http\Resources;

use App\Helpers\HelpersBasic;
use Illuminate\Http\Resources\Json\JsonResource;

class LabelChartResource extends JsonResource
{
    /**
    * Transform the resource into an array.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array
    */
    public function toArray($request)
    {
        {

      $colors = HelpersBasic::color_array($this->label_texts->count());

      $labels_data = $this->label_texts->groupBy('attribute')->map->count();

      return [
        'data' => [
          'data' =>
          [
            'labels' => array_keys($labels_data->toArray()),
            'datasets'=> [
              [
                'label'=> $this->name,
                'data'=> array_values($labels_data->toArray()),
                'backgroundColor' => $colors,
                'borderColor' => $colors,
                'borderWidth' => 1,
              ],
            ],
          ],
          'options' => [
            'scales' => [
              'yAxes' => [
                [
                  'ticks' => [
                    'beginAtZero' => true,
                  ],
                ],
              ],
            ],
          ],
        ],
      ];
      // return parent::toArray($request);
    }
    }

    public function with($request)
    {
        return [  ];
    }
}
