<?php

/**
 * This file implements Permission Controller.
 * PHP version 7.2
 *
 * @category Class
 * @package  PermissionController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */

namespace App\Http\Controllers;

use App\Events\LogActivity;
use App\Group;
use App\Permission;
use Illuminate\Http\Request;

/**
 * Controls the data flow into a Permission object and
 *  updates the view whenever data changes.
 *
 * @category Class
 * @package  PermissionController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */
class PermissionController extends Controller
{
    /**
     * Constructs a new instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('demoCheck')->only('update');
    }

    /**
     * Show the form for editing the specified resource
     *
     * @param \App\Permission $permission The permission
     *
     * @return mixed
     */
    public function edit(Permission $permission)
    {
        $this->authorize('manage', Group::class);
        if ($permission->id < 2) {
            return redirect(route('home'))->with('info', __('No access'));
        }
        $per = $permission;
        return view('auth.permission', compact('per'));
    }

    /**
     * Update Permission
     *
     * @param \Illuminate\Http\Request $request    The request
     * @param \App\Permission          $permission The permission
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Permission $permission)
    {
        $this->authorize('manage', Group::class);
        $permission->update($this->permissionKeys($request));
        event(
            new LogActivity(
                $permission->group->name,
                ' ' . __('Data updated successfully'),
                __('Permission')
            )
        );
        return back()->with('success', __('Data updated successfully'));
    }
}
