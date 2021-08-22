<?php

namespace App\Http\Controllers;

use App\Http\Requests\LanguageRequest;
use App\Http\Requests\LanguageUpdateRequest;
use App\Language;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class LanguageController extends Controller
{

    /**
     * Constructs a new instance.
     * Middleware Applied
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('demoCheck')->only(['updateStrings', 'update', 'destroy']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locales = Language::paginate(10);
        return view('language.list', compact('locales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('language.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LanguageRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(LanguageRequest $request)
    {
        $language = Language::create($request->validated());
        Artisan::call(
            'translatable:export',
            ['lang' => $language->locale]
        );
        return redirect(route('language.index'))
            ->with('success', __('Data saved successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Language $language
     * @return \Illuminate\Http\Response
     */
    public function show(Language $language)
    {
        return view('language.locales', compact('language'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Language $language
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        if ($language->id === 1) {
            return redirect(route('language.index'))
                ->with('warning', __('Can\'t edit default language'));
        }
        return view('language.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LanguageRequest $request
     * @param  \App\Language   $language
     * @return \Illuminate\Http\Response
     */
    public function update(LanguageRequest $request, Language $language)
    {
        $language->update($request->validated());
        return redirect(route('language.index'))
            ->with('success', __('Data updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Language $language
     * @return \Illuminate\Http\Response
     */
    public function destroy(Language $language)
    {
        if ($language->id === 1 || config('app.locale') === $language->locale) {
            return redirect(route('language.index'))
                ->with('warning', __('Can\'t delete default language'));
        }
        if (File::delete(base_path() . '/resources/lang/' . $language->locale . '.json')) {
            $language->delete();
            return redirect(route('language.index'))
                ->with('success', __('Data removed successfully'));
        }
        return redirect(route('language.index'))
            ->with('warning', __('Something went wrong try again !'));
    }
    /**
     * Localization sync
     *
     * @return \Illuminate\Http\Response
     */
    public function sync()
    {
        try {
            $languages = Language::get();
            foreach ($languages as $language) {
                @Artisan::call('translatable:export', ['lang' => $language->locale]);
            }
            return back()->with('success', __('Translation files updated'));
        } catch (Exception $e) {
            return back()->with('message', $e->getMessage());
        }
    }

    /**
     * Translations strings
     *
     * @param Language $language
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStrings(Language $language)
    {
        if (!file_exists(base_path() . '/resources/lang/' . $language->locale . '.json')) {
            return response()->json(
                ['warning' => __('No translations found for the selected language')],
                500
            );
        }
        $translations = [];
        $files = json_decode(
            File::get(base_path() . '/resources/lang/' . $language->locale . '.json'),
            true,
            512,
            JSON_THROW_ON_ERROR
        );
        foreach ($files as $key => $value) {
            $translations[] = ['key' => $key, 'value' => $value];
        }
        return response()->json($translations);
    }
    /**
     * Update specific resource
     *
     * @param LanguageUpdateRequest $request  request
     * @param Language              $language language
     *
     * @return JsonResponse
     */
    public function updateStrings(LanguageUpdateRequest $request, Language $language)
    {

        $translations = json_decode(
            File::get(base_path() . '/resources/lang/' . $language->locale . '.json'),
            true,
            512,
            JSON_THROW_ON_ERROR
        );
        foreach ($request->get('strings') as $string) {
            $translations[$string['key']] = $string['value'];
        }
        if (File::put(
            base_path() . '/resources/lang/' . $language->locale . '.json',
            json_encode($translations, JSON_THROW_ON_ERROR)
        )
        ) {
            return response()->json(
                [
                    'message' => __('Data updated correctly'),
                ]
            );
        }
        return response()->json(
            ['message' => __('An error occurred while saving data')],
            500
        );
    }
}
