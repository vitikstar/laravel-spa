<?php

namespace App\Services;

use App\Events\UserCreated;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class UserRegistration
{
    public function register($request, $image = null)
    {
        $validator = Validator::make($request, [
            'name' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'avatar' => 'image|mimes:jpeg,jpg,png,gif',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if($image){
                    // Перевірка на формат
                    $allowedFormats = ['jpeg', 'jpg', 'png', 'gif'];
                    $imageFormat = $image->getClientOriginalExtension();

                    if (!in_array($imageFormat, $allowedFormats)) {
                        return response()->json(['error' => 'Invalid image format'], 422);
                    }

                    // Обрізати зображення до заданих розмірів
                    $resizedImage = Image::make($image)->fit(300, 200)->encode($imageFormat);
                }

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        if($image){
                // Створення шляху для збереження в сховищі
                $path = 'storage/avatars/' . $user->id . '/' . time() . '.' . $imageFormat;

                // Збереження зображення в сховище
                Storage::put($path, $resizedImage);

                // Створення публічного шляху для зображення
                $publicPath = public_path($path);

                // Створення деректорії для публічного шляху, якщо вона не існує
                if (!File::exists(public_path('storage/avatars/' . $user->id))) {
                    File::makeDirectory(public_path('storage/avatars/' . $user->id), 0755, true);
                }

                // Копіювання зображення в публічну папку
                File::copy(storage_path('app/' . $path), $publicPath);

                // Оновлення URL аватара користувача в базі даних
                $user->update(['avatar_url' => $path]);
        }


        $token = $user->createToken('app-token')->accessToken;

        //event(new UserCreated($user));

        return $user;

    }

}

?>
