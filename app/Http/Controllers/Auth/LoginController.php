namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('home');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->route('dashboard'); // Replace 'dashboard' with the actual route you want to redirect to after login
        }

        // Authentication failed
        return redirect()->back()->withErrors(['login' => 'Invalid credentials'])->withInput();
    }
}