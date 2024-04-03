<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PhpParser\Node\Stmt\TryCatch;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout',
            'locked',
            'unlock'
        ]);
    }

    public function login()
    {
        // dd(bcrypt('123456789'));
        return view('auth.login', [
            'title' => 'Đăng nhập'
        ]);

    }

    public function authenticate(Request $request)
    {
        try{
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
            $email    = $request->email;
            $password = $request->password;

            $remember_me = $request->has('remember_me') ? true : false;

            if ($Auth = auth()->attempt(['email' => $email, 'password' => $password], $remember_me)) {
                $user = auth()->user();
            } else {
                Toastr::error('fail, Sai email hoặc mật khẩu!!');
                return back();
            }
            $dt         = Carbon::now();
            $todayDate  = $dt->toDayDateTimeString();
            // if (Auth::attempt(['email' => $email, 'password' => $password,])) {
                if ($Auth) {
                // DB::table('activity_logs')->insert($activityLog);
                Toastr::success('Đăng nhập thành công!!', 'Success');
                if (Auth::user()->role_name == 'Admin') {
                    return redirect()->route('home');
                }
                if (Auth::user()->role_name == 'Student') {
                    return redirect()->route('homeStudent');
                }
                if (Auth::user()->role_name == 'Teacher') {
                    return   redirect()->route('homeTeacher');
                }
            }
        }
        catch(ModelNotFoundException $exception){
            return back()->withError($exception->getMessage())->withInput();
        }
        // $request->validate([
        //     'email' => 'required|string|email',
        //     'password' => 'required|string',
        // ]);
        // $email    = $request->email;
        // $password = $request->password;

        // $remember_me = $request->has('remember_me') ? true : false;

        // if ($Auth = auth()->attempt(['email' => $email, 'password' => $password], $remember_me)) {
        //     $user = auth()->user();
        // } else {
        //     Toastr::error('fail, Sai email hoặc mật khẩu!!');
        //     return back();
        // }
        // $dt         = Carbon::now();
        // $todayDate  = $dt->toDayDateTimeString();
        // // if (Auth::attempt(['email' => $email, 'password' => $password,])) {
        //     if ($Auth) {
        //     // DB::table('activity_logs')->insert($activityLog);
        //     Toastr::success('Đăng nhập thành công!!', 'Success');
        //     if (Auth::user()->role_name == 'Admin') {
        //         return redirect()->route('home');
        //     }
        //     if (Auth::user()->role_name == 'Student') {
        //         return redirect()->route('homeStudent');
        //     }
        //     if (Auth::user()->role_name == 'Teacher') {
        //         return   redirect()->route('homeTeacher');
        //     }
        // } else {
        //     Toastr::error('Sai email hoặc mật khẩu!!', 'Thất bại');
        //     return redirect('login');
        // }
    }

    public function logout()
    {
        $user = Auth::User();
        Session::put('user', $user);
        $user = Session::get('user');

        $name       = $user->name;
        $email      = $user->email;
        $dt         = Carbon::now();
        $todayDate  = $dt->toDayDateTimeString();
        Auth::logout();
        Toastr::success('Đăng xuất thành công!!', 'Success');
        return redirect('login');
    }

}
