<?php

/**
 * This file implements Group Axillary Controller.
 * PHP version 7.2
 *
 * @category Class
 * @package  GroupAxillaryController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */

namespace App\Http\Controllers;

use App\Events\LogActivity;
use App\Group;
use App\Permission;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

/**
 * Controls the data flow into a group axillary object and
 * updates the view whenever data changes.
 *
 * @category Class
 * @package  GroupAxillaryController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */
class GroupAxillaryController extends Controller
{

    /**
     * Constructs a new instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Displays all dedicated permissions requests
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('manageRequest', Group::class);
        $requests = Group::where('state', 1)->get();
        return view('group.request', compact('requests'));
    }

    /**
     * Handle Permission request
     *
     * @param \Illuminate\Http\Request $request The request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function request(Request $request)
    {
        $this->authorize('newRequest', Group::class);

        if ('active' === $this->bluePrints()->demo && $request->user < 5) {
            return redirect(route('home'))->with('message', 'Disable in demo mode! Try with new user. ');
        }
        $group = Group::create(
            [
                'name' => 'DG' . time(),
                'state' => 1,
                'details' => __('Dedicated permission group request'),
                'note' => $request->note,
                'requestBy' => $request->user,
            ]
        );
        unset($request['user']);
        unset($request['note']);
        $permission = Permission::create(['group_id' => $group->id]);
        $permission->update($this->permissionKeys($request));

        event(
            new LogActivity(
                $group->name,
                ' ' . __('Request submitted successfully'),
                __('Permission')
            )
        );
        return back()->with(
            'success',
            __('Dedicated permission group request feedback')
        );
    }

    /**
     * Update Permission request
     *
     * @param \Illuminate\Http\Request $request The request
     * @param \App\Group               $group   The group
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Group $group)
    {
        $this->authorize('manageRequest', Group::class);
        $user = User::find($group->requestBy);
        if ($request->act > 0) {
            $user->update(['group_id' => $group->id]);
            $group->update(
                [
                    'state' => 0,
                    'name' => $request->name ?? __('Dedicated group') . time(),
                    'details' => $request->details ?? __('Dedicated group') . time(),
                ]
            );
            if (!$request->email) {
                $notify['email'] = $user->email;
                $notify['subject'] = __('Dedicated group permission subject');
                $notify['message'] = __('Dedicated group permission message');
                $this->_notify($notify);
            }

            event(
                new LogActivity(
                    $group->name,
                    ' ' . __('Dedicated permission group launched'),
                    __('Permission')
                )
            );
            return redirect(route('group.index'))
                ->with('success', __('Dedicated permission group launched'));
        }
        $group->permissions->delete();
        $group->delete();
        if (!$request->email) {
            $notify['subject'] = __('Dedicated group permission subject for decline');
            $notify['message'] = __('Dedicated group permission message for decline');
            $notify['email'] = $user->email;
            $this->_notify($notify);
        }

        event(
            new LogActivity(
                __('Permission request'),
                ' ' . __('Dedicated permission request declined'),
                __('Permission')
            )
        );
        return redirect(route('group.index'))
            ->with('info', __('Dedicated permission request declined'));
    }

    /**
     * Sends mail notification
     *
     * @param mixed $notify The notify
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function _notify($notify)
    {
        $notify['from'] = $this->bluePrints()->default_email;
        $notify['fromAlly'] = $this->bluePrints()->site_name;
        $notify['replyTo'] = Auth::user()->email;
        $notify['replyToAlly'] = Auth::user()->name;
        Mail::to($notify['email'])
            ->send(new \App\Mail\PermissionRequestNotification($notify));
        if (Mail::failures()) {
            return back()->with('warning', __('Sorry try again'));
        }
    }
}
