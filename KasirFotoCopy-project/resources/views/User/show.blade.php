public function show(User $user)
{
    return view('users.show', compact('user'));
}