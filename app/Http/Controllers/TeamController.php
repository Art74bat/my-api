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
        $team = Team::all();
        return TeamResource::collection($team);
    }

    public function store(Request $request)
    {
        // Валидация файла (например, только изображения)
        $request->validate([
            'name' => 'required|string|max:255',
            'second_name' => 'required|string|max:255',
            'experience' => 'required|string|max:100',
            'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $file = $request->file('image');
            $path = $file->storePublicly('images/team','public');
            // // Генерация URL для доступа к файлу
            // $url = Storage::url($path);
            $team = Team::create([
                'name' => $request->name,
                'second_name' => $request->second_name,
                'experience' => $request->experience,
                'img_path' => config('app.url') . Storage::url($path),
            ]);
            return response()->json([
                'message' => 'Данные добавлены!',
                'id' => $team->id
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ошибка при добавлении данных: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, Team $team)
    {
        $fields = $request->validate([
            'name' => 'required|string|max:255',
            'second_name' => 'required|string|max:255',
            'experience' => 'required|string|max:100',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            if ($request->hasFile('image')) {
                $oldImage = basename($team->img_path);
                Storage::disk('local')->delete('public/images/team/' . $oldImage);

                $image = $request->file('image');
                $path = $image->storePublicly('public/images/team');
                $fields['img_path'] = config('app.url') . Storage::url($path);
            }

            $team->update($fields);

            return response()->json([
                'message' => 'Данные обновлены!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ошибка при обновлении данных: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(Team $team)
    {
        try {
            $image = $team->img_path;
            $file = basename($image);
            Storage::disk('local')->delete('public/images/team/' . $file);

            $team->delete();

            return response()->json([
                'message' => 'Данные успешно удалены!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ошибка при удалении данных: ' . $e->getMessage(),
            ], 500);
        }
    }
}
