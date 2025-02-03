<?php

namespace App\Http\Controllers\Inertia\Film;

use App\Actions\Films\DestroyFilmsAction;
use App\Actions\Films\GetAllFilmsAction;
use App\Actions\Films\GetFilmsAction;
use App\Actions\Films\UpdateFilmAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Film\UpdateFilmRequest;
use App\Models\Film;
use Exception;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class FilmController extends Controller
{

    /**
     * @param GetAllFilmsAction $action
     * @return Response
     */
    public function index(GetAllFilmsAction $action): Response
    {
        return Inertia::render('features/films/TrendingFilmsPage', [
            'films' => $action->execute(request()->only('search')),
        ]);
    }


    /**
     * @param Film $film
     * @param GetFilmsAction $action
     * @return Response
     */
    public function show(Film $film,GetFilmsAction $action)
    {
        return Inertia::render('features/films/DetailFilmPage', [
            'film' => $action::execute($film),
        ]);
    }

    /**
     * @param Film $film
     * @return Response
     */
    public function edit(Film $film): Response
    {
        return Inertia::render('features/films/EditFilmPage', [
            'film' => $film,
        ]);
    }

    /**
     * @throws Exception
     */
    public function destroy(Film $film, DestroyFilmsAction $action)
    {
        DB::beginTransaction();
        try {
            $action::execute($film);

            session()->flash('success', 'Film deleted successfully');
            DB::commit();
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', 'An error occurred while deleting the film');
            throw $e;
        }
    }

    /**
     * @throws Exception
     */
    public function update(Film $film, UpdateFilmAction $action, UpdateFilmRequest $request)
    {
        DB::beginTransaction();
        try {
            $action::execute($film, $request->validated());
            DB::commit();
            session()->flash('success', 'Film updated successfully');
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', 'An error occurred while updating the film');
            throw $e;
        }
    }

}
