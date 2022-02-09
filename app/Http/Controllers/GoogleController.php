<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
  
class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
        
        /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
            $user = Socialite::driver('google')->user();
       
            $finduser = User::where('google_id', $user->id)->first();
       
            if($finduser){
                Auth::login($finduser);
      
                return redirect()->intended('dashboard');
            }else{
                $newUser = new User;
                $newUser->name = $user->name;
                $newUser->email = $user->email;
                $newUser->google_id = $user->id;
                $request->session()->put('user', $newUser);
            
                return View::make('auth.google-password');
            }
      
        } catch (Exception $e) {
            dd("Catch Exception " . $e->getMessage());
        }
    }

    public function inputPassword(Request $request){
        $user = session('user');
        $user->password = Hash::make($request->password);
        $user->save();
        Auth::login($user);

        return redirect()->intended('dashboard');
    }
}