<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Tag;

class ApiTagGraphController extends Controller
{
    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function data(Collection $collection, Tag $tag)
    {
        // $tag = $tag->load(['parent', 'children']);
        $tag = $tag->load(['children']);

        // $parent = $tag->parent()->first();

        $edges = collect();
        $nodes = collect();

        // if (isset($parent)) {
        //     $nodes = $nodes->concat(
        //         [
        //   [
        //     'id' => $parent->id,
        //     'label' => $parent->name,
        //     'shape' => 'box',
        //     'color' => $parent->color,
        //     'font' => [
        //       'color' => 'white',
        //       'border-color' => $parent->color,
        //       'size' => 20,

        //     ],
        //   ],
        // ]
        //     );

        //     $edges = $edges->concat(
        //         [
        //   [
        //     'from' => $parent->id,
        //     'to' => $tag->id,
        //     'arrows' => 'to',
        //   ],
        // ]
        //     );
        // }

        $children = $tag->children()->get()->map(function ($child) {
            return [
        'id' => $child->id,
        'label' => $child->name,
        'shape' => 'box',
        'color' => $child->color,
        'font' => [
          'color' => 'white',
          'border-color' => $child->color,
          'size' => 12,
        ],
      ];
        });

        $nodes = $nodes->concat($children)->concat(
            [
        [
          'id' => $tag->id,
          'label' => $tag->name,
          'shape' => 'box',
          'color' => $tag->color,
          'font' => [
            'color' => 'white',
            'border-color' => 'red',
            'size' => 20,
          ],
        ],
      ]
        );

        foreach ($children as $child) {
            $edges = $edges->concat(
                [
          [
            'from' => $tag->id,
            'to' => $child['id'],
            'arrows' => 'to',
            'dashes' => true,
          ],
        ]
            );
        }

        return response()->json([
      'data' => [
        'nodes' => $nodes,
        'edges' => $edges,
        'options' => [
          'layout' => [
            'hierarchical' => [
              'direction' => "UD",
              'sortMethod' => "directed",
            ],
          ],

        ],
      ],
    ]);
    }
}
