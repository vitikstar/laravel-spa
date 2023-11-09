<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'avatar' => 'required|image|mimes:jpeg,jpg,png,gif',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $image = $request->file('avatar');

        // Перевірка на формат
        $allowedFormats = ['jpeg', 'jpg', 'png', 'gif'];
        $imageFormat = $image->getClientOriginalExtension();

        if (!in_array($imageFormat, $allowedFormats)) {
            return response()->json(['error' => 'Invalid image format'], 422);
        }

        // Обрізати зображення до заданих розмірів
        $resizedImage = Image::make($image)->fit(300, 200)->encode($imageFormat);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

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

        $token = $user->createToken('app-token')->accessToken;

        return response(['token' => $token], 200);

    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $token = auth()->user()->createToken('app-token')->accessToken;
            return response(['token' => $token], 200);
        }

        return response(['error' => 'Invalid credentials'], 401);
    }
}

?>
