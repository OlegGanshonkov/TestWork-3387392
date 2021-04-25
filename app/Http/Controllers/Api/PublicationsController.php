<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PublicationResource;
use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationsController extends Controller
{
    public function list()
    {
        return PublicationResource::collection(Publication::paginate(10));
    }

    public function show(Publication $publication)
    {
        return new PublicationResource($publication);
    }

    public function update(Publication $publication, Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
        ]);

        $publication->update($data);

        return new PublicationResource($publication);
    }

    public function destroy(Publication $publication)
    {
        $publication->delete();

        return response(null, 204);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        return new PublicationResource(Publication::create([
            'title' => $data['title'],
            'body' => $data['body'],
        ]));
    }

}
