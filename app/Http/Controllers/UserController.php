<?php

/**
 * This file implements User Controller.
 * PHP version 7.2
 *
 * @category Class
 * @package  UserController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */

namespace App\Http\Controllers;

use App\Events\LogActivity;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Controls the data flow into a User object and
 *  updates the view whenever data changes.
 *
 * @category Class
 * @package  UserController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */
class UserController extends Controller
{
    /**
     * Constructs a new instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('demoCheck')->except('index');
    }

    /**
     * User Management
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('manage', User::class);
        $users = User::latest()->paginate(11);
        return view('auth.list', compact('users'));
    }

    /**
     *  Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse.
     */
    public function create()
    {
        $this->authorize('create', User::class);
        return redirect(route('register'));
    }

    /**
     * Show the form for editing the specified resource
     *
     * @param \App\User $user The user
     *
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $this->authorize('edit', User::class);
        return view('auth.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request The request
     * @param \App\User                $user    The user
     *
     * @return \Illuminate\Http\RedirectResponse.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('edit', User::class);
        $validated = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'address' => ['required', 'string', 'max:225'],
                'phone' => ['required'],
                'company' => ['required', 'string'],
            ]
        );
        if ($request->password) {
            $request->validate(
                [
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]
            );
            $user->update(
                [
                    'password' => Hash::make($request['password']),
                ]
            );
            event(
                new LogActivity(
                    $user->name,
                    ' ' . __('User password updated'),
                    __('user')
                )
            );
        }
        if (!$request->hasFile('image')) {
            $user->update($validated);
            event(
                new LogActivity(
                    $user->name,
                    ' ' . __('User information updated'),
                    __('user')
                )
            );
            return redirect(route('home'))
                ->with('success', __('User information updated'));
        }
        $request->validate(
            [
                'image' => 'required|image|file',
            ]
        );
        $image = $request->image->store('uploads/user', 'public');
        $this->checkLogoExistence($user->image);
        $user->update(['image' => $image]);
        event(
            new LogActivity(
                $user->name,
                ' ' . __('User logo updated as well'),
                __('user')
            )
        );

        $user->update($validated);
        event(
            new LogActivity(
                $user->name,
                ' ' . __('User information updated'),
                __('user')
            )
        );
        return redirect(route('home'))
            ->with('success', __('User information updated'));
    }

    /**
     * Destroys the given user.
     *
     * @param \App\User $user The user
     *
     * @return \Illuminate\Http\RedirectResponse.
     */
    public function destroy(User $user)
    {
        $this->authorize('manage', User::class);
        if (1 === $user->id) {
            return back()->with('warning', __('Master account is protected'));
        }
        $this->checkLogoExistence($user->image);
        event(
            new LogActivity(
                $user->name,
                ' ' . __('User removed'),
                __('user')
            )
        );
        $user->delete();
        return back()->with('success', __('Deleted successfully'));
    }

    /**
     * Handle user auth pin
     *
     * @param \Illuminate\Http\Request $request The request
     * @param \App\User                $user    The user
     *
     * @return \Illuminate\Http\RedirectResponse.
     */
    public function pin(Request $request, User $user)
    {
        $this->authorize('manage', User::class);
        $validated = $request->validate(
            [
                'pin' => 'required|min:5|max:5',
                'group' => '',
            ]
        );
        if ($request->group) {
            $group = $validated['group'];
            unset($validated['group']);
            $validated['group_id'] = $group;
        }

        $user->update($validated);
        event(
            new LogActivity(
                $user->name,
                ' ' . __('User auth pin updated'),
                __('user')
            )
        );
        return redirect(route('user.index'))
            ->with('success', __('User authorization pin updated'));
    }
}
