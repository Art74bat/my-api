<?php

namespace App\Http\Controllers;

use App\Http\Resources\Team\TeamResource;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index()
    {
        $team = Team::query()->get();
        return TeamResource::collection($team);
    }
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name'=>'required|string|max:225',
            'second_name'=>'required|string|max:225',
            'experience'=>'required|string|max:100',
        ]);
        // только одна картинка для каждой записи....
        $image = $request->file('image');
        $path = $image->storePublicly('images/team');

        $team = Team::create([
            'name'=>$request->name,
            'second_name'=>$request->second_name,
            'experience'=>$request->experience,
            'img_path'=>config('app.url'). Storage::url($path),
        ]);
        return response()->json([
            'message'=>'Данные добавлены !',
            "id"=>$team->id
        ]);;
    }
    public function update(Request $request, Team $team)
    {

        $fields = $request->validate([
            'name'=>'required|string|max:225',
            'second_name'=>'required|string|max:225',
            'experience'=>'required|string|max:100',
        ]);
        // dd($request);
        $team->update($fields);
        return response()->json([
            'message'=>'Данные обновлены !'
        ]);
    }
    public function destroy(Team $team)
    {
        $image = $team->img_path;
        // delete image from localDisk
            $file = basename($image);
            // dd($file);
            Storage::disk('local')->delete('images/team/'.$file);

        // delete item
        $team->delete();
        return ['message'=>'Данные успешно удалены !'];
    }
}
