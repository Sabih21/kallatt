<?php                                                                                           

namespace App\Http\Controllers\Admin;                                                           

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Auth;
    
class UserController extends Controller
{
    public function status(){
        return view('request.pending');
    }
    public function index()
    {
        $usertype = Auth::user()->user_type;
        if ($usertype == '1') {

        $users = User::all();
        return view('admin.users.index', compact('users'));
        }
    }

    public function approve($id)
    {
        $usertype = Auth::user()->user_type;
        if ($usertype == '1') {

        $user = User::findOrFail($id);
        $user->status = 'approved';
        $user->save();

        return redirect()->route('users.index')->with('success', 'User approved successfully');
        }
    }

   

public function reject($id)
{
    $usertype = Auth::user()->user_type;
    if ($usertype == '1') {

    $user = User::findOrFail($id);
    $user->status = 'rejected';
    $user->save();                                                                                  

    \Log::info('User rejected:', ['user_id' => $id]);

    return redirect()->route('users.index')->with('success', 'User rejected successfully');
    }
}

}
