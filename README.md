* Menggunakan Resources untuk hasil responses API
* Menggunakan class Carbon untuk menghitung selisih waktu
Contoh : 
```php
if (Carbon::parse($find_vaccination['date'])->diffInDays() < 30) {
    return Response::json(401, 'Wait at least +30 days from 1st vaccination');
}
```
* Carbon juga bisa digunakan untuk memvalidasi deadline

Deadline code :
```php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

public function validateDeadline(Request $request)
{
    $validator = Validator::make($request->all(), [
        'deadline' => 'required|date|after_or_equal:today'
    ]);

    if ($validator->fails()) {
        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Jika validasi berhasil
    return "Deadline masih valid";
}
```

* Token API dibuat sendiri dengan kombinasi email + password yang udah di hash pakai md5
    - Token di store di database
    - Token adalah sebagai identitas user untuk fetch data dari database

Generate Token Code in Model :
```php
class Token extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    static function generateToken($username, $password)
    {
        $tokenStored = Token::create([
            'token' => md5($username . bcrypt('password')),
            'user_id' => Auth::user()->id,
            'expired' => time() + 60 * (int)env('EXP_TOKEN')
        ]);

        if ($tokenStored) {
            return $tokenStored['token'];
        }
    }

    function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    static function getExpired()
    {
        return time() + 60 * (int)env('EXP_TOKEN');
    }
}
```

Auth Middleware Token md5 :
```php
class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization', false);
        if ($token) {
            $find_token = Token::where('token', $token)->first();
            if ($find_token) {
                if (time() < (int)$find_token['expired']) {
                    return $next($request);
                }
            }
        }

        return HelpersResponse::json(401, 'Invalid token', [], 'Your token is invalid');
    }
}
```

Ada Resource Di Dalam Resource :
```php
class SocietyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'born_date' => $this->society->born_date,
            'gender' => $this->society->gender,
            'address' => $this->society->address,
            'token' => $this->token,
            'regional' => RegionalResource::collection(collect([$this->society->regional]))->first()
            // 'regional' => $this->regio
        ];
    }
}
```

* Resource::collection() argumennya harus berupa array collection. Kalau bukan collection, liat contoh cara ngubah collection kaya diatas
* Kode di split / di pisah menjadi beberapa bagian supaya mudah di maintance

Contoh splitting routes API :

```php
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


require(__DIR__ . '/api/spot.php');
require(__DIR__ . '/api/auth.php');
require(__DIR__ . '/api/consultation.php');
require(__DIR__ . '/api/vaccination.php');

```
