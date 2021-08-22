<?php

/**
 * This file implements Backup Controller.
 * PHP version 7.2
 *
 * @category Class
 * @package  BackupController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */

namespace App\Http\Controllers;

use App\Events\LogActivity;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Process;

/**
 * Controls the data flow into a backup object and
 *  updates the view whenever data changes.
 *
 * @category Class
 * @package  BackupController
 * @author   Rose-Finch <info.codehas@gmail.com>
 * @license  https://codecanyon.net/licenses/standard  Standard Licenses
 * @link     https://codecanyon.net/user/rose-finch
 */
class BackupController extends Controller
{

    /**
     * Constructs a new instance.
     * Middleware Applied
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('demoCheck')->only(['restore', 'destroy']);
    }

    /**
     * Show backups
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('backup', Setting::class);
        return view('backup.backup');
    }

    /**
     * Loads backups .
     *
     * @return \Illuminate\Http\JsonResponse.
     */
    public function loadBackup()
    {
        $arrFiles = [];
        foreach (glob(storage_path() . "/backups/*.sql") as $file) {
            if (!file_exists($file)) {
                continue;
            }
                $size = number_format(filesize($file) / 1048576, 2);
                $fileInfo = [];
                $fileInfo['path'] = $file;
                $arr = explode('/', $file);
                $fileInfo['name'] = end($arr);
                $fileInfo['size'] = $size . 'MB';
                $fileInfo['time'] = date('Y-m-d H:i:s', filemtime($file));
                $arrFiles[] = $fileInfo;

        }
        rsort($arrFiles);
        return response()->json(['type' => 'success', 'backups' => $arrFiles], 200);
    }

    /**
     * Generate Backup
     *
     * @return \Illuminate\Http\JsonResponse.
     */
    public function generateBackup()
    {
        if (count(glob(storage_path() . "/backups/*.sql")) >= 10) {
            return response()->json(
                [
                    'type' => 'warning',
                    'message' => __('You cannot create more than 10 copies'),
                ],
                200
            );
        }
        $path = 'backups/backup-' . date('Y-m-d-H-i-s') . '.sql';
        $fileName = storage_path($path);
        $process = new Process(
            sprintf(
                'mysqldump --user="%s" --password="%s" %s > %s',
                config('database.connections.mysql.username'),
                config('database.connections.mysql.password'),
                config('database.connections.mysql.database'),
                $fileName
            )
        );
        if (file_exists($fileName)) {
            unlink($fileName);
        }
        if ($process->mustRun() === false) {
            return response()->json(
                [
                'type' => 'warning',
                'message' => __('Failed try again'),
                ],
                200
            );
        }
            event(
                new LogActivity(
                    __('Backup'),
                    $path . ' ' . __('New backup generated'),
                    __('Backup')
                )
            );
            return response()->json(
                [
                    'type' => 'success',
                    'message' => __('Backup created'),
                ],
                200
            );
    }

    /**
     * Restore Backup
     *
     * @param Request $request The request
     *
     * @return \Illuminate\Http\JsonResponse.
     */
    public function restore(Request $request)
    {
        $pathFull = storage_path() . "/backups/" . $request->file;
        DB::beginTransaction();
        try {
            DB::unprepared(file_get_contents($pathFull));
            event(
                new LogActivity(
                    __('Restored'),
                    $request->file . ' ' . __('Backup restored'),
                    __('Backup')
                )
            );
            DB::commit();
            return response()->json(
                [
                    'type' => 'success',
                    'message' => __('Restored successfully'),
                ],
                200
            );
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(
                [
                    'type' => 'warning', 'message' => 'Exception error!',
                ],
                200
            );
        }
    }

    /**
     * Destroys the given Request.
     *
     * @param Request $request The request
     *
     * @return \Illuminate\Http\JsonResponse.
     */
    public function destroy(Request $request)
    {
        $pathFull = storage_path() . "/backups/" . $request->file;
        if (!file_exists($pathFull)) {
            return response()->json(
                [
                'type' => 'warning',
                'message' => __('Back file not existed'),
                ],
                200
            );
        }
            unlink($pathFull);
            event(
                new LogActivity(
                    __('Destroyed'),
                    $request->file . ' ' . __('Backup destroyed'),
                    __('Backup')
                )
            );
            return response()->json(
                [
                    'type' => 'success',
                    'message' => __('Removed successfully'),
                ],
                200
            );
    }
}
