<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Widget;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class WidgetController extends Controller
{

    protected $defaultTemplate = 'small';
    protected $defaultBackgroundColor = 'red';

    public function index(Request $request) {
        $widgets = Widget::where('user_id', $request->auth->id)->get();

        return response()->json([
            'data' => [
                'widgets' => $widgets,
            ],
            'relationships' => [
                'user' => $request->auth
            ]
        ], 200);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);

        $widget = Widget::create([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'background_color' => $request->get('background_color') ?? $this->defaultBackgroundColor,
            'template' => $request->get('template') ?? $this->defaultTemplate,
            'user_id' => $request->auth->id
        ]);
        

        return response()->json([
            'data' => [
                'widget' => $widget,
                'message' => 'Widget saved!'
            ],
            'relationships' => [
                'user' => $request->auth
            ]
        ], 201);
    }


    public function update(Request $request, $id) {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);

        $widget = Widget::find($id);

        if($widget) {
            $widget->update([
                'title' => $request->get('title'),
                'content' => $request->get('content'),
                'background_color' => $request->get('background_color'),
                'template' => $request->get('template'),
            ]);

            $data = [
                'data' => [
                    'data' => [
                        'widget' => $widget,
                        'message' => 'Widget saved!',
                    ],
                    'relationships' => [
                        'user' => $request->auth
                    ]
                ], 
                
                'status' => 200
            ];
        } else {

            $data = [
                'data' => [
                    'error' => true,
                    'message' => 'Widget not found!',
                ], 
                'status' => 404
            ];

        }
        
        
        return response()->json($data['data'], $data['status']);

    }
    
}