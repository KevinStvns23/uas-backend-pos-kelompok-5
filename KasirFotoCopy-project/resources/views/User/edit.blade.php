public function edit(User $user)
{
    return view('users.edit', compact('user'));
}