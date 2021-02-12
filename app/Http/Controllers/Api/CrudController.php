<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Crud;
use App\Http\Requests\CrudCreateRequest;
use App\Http\Requests\CrudUpdateRequest;

class CrudController extends Controller
{
    public function index()
    {
        $cruds = auth()->user()->cruds;

        return response()->json([
            'success' => true,
            'data' => $cruds,
        ]);
    }

    public function store(CrudCreateRequest $request)
    {
        $crud = Crud::create($request->validated());

        if ($crud) {
            return response()->json([
                'success' => true,
                'data' => $crud->toArray()
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Crud not added'
            ], 500);
        }
    }

    public function show($id)
    {
        $crud = $this->findModel($id);

        if (!$crud) {
            return response()->json([
                'success' => false,
                'message' => 'Crud not found',
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $crud->toArray(),
        ], 400);
    }

    public function update(CrudUpdateRequest $request, $id)
    {
        $crud = $this->findModel($id);

        if (!$crud) {
            return response()->json([
                'success' => false,
                'message' => 'Crud not found',
            ], 400);
        }

        $updated = $crud->fill($request->validated())->save();

        if ($updated) {
            return response()->json([
                'success' => true,
                'data' => $crud,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Crud can not be updated'
            ], 500);
        }
    }

    public function destroy($id)
    {
        $crud = $this->findModel($id);

        if (!$crud) {
            return response()->json([
                'success' => false,
                'message' => 'Crud not found',
            ], 400);
        }

        if ($crud->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Crud can not be deleted'
            ], 500);
        }
    }

    private function findModel($id)
    {
        return auth()->user()->cruds()->find($id);
    }
}
