public function index()
{
    $users = User::all();
    return view('users.index', compact('users'));
}