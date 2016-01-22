<?php
namespace App\Http\Controllers;

use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;
use Auth;
use App\User;
use App\Team;

class TeamController extends Controller
{
    /**
     * Return login view
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
    	$user = Auth::user();
        return view('admin.teams.index', ['user' => $user]);
    }

    /**
     * Return create team view
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        return view('admin.teams.create');
    }

    /**
     * Return redirect - creates new team
     *
     * @return \Illuminate\View\View
     */
    public function store(Request $request) {
        $name = $request->input('name');
        $team = new Team();

        $user = Auth::user();
        $team->name = $name;
        $team->slug = $this->getUniqueSlug($team, $name);
        $team->save();
        $user->teams()->save($team);

        return redirect('/dashboard');
    }

    /**
     * Return edit team view
     *
     * @return \Illuminate\View\View
     */
    public function edit($team) {
        $team = Team::where('slug', '=', $team)->first();
        return view('admin.teams.edit', ['team' => $team]);
    }

    /**
     * Return redirect - updates team
     *
     * @return \Illuminate\View\View
     */
    public function update($team, Request $request) {
        $name = $request->input('name');

        $team = Team::where('slug', '=', $team)->first();
        $user = Auth::user();

        $team->name = $name;
        $team->slug = $this->getUniqueSlug($team, $name);
        $team->save();

         return redirect('/dashboard');
    }

    /**
     * Return redirect - updates team
     *
     * @return \Illuminate\View\View
     */
    public function delete($team) {
        Team::where('slug', '=', $team)->delete();
        return redirect('/dashboard');
    }

    /**
     * Generate a unique slug.
     * If it already exists, a number suffix will be appended.
     * It probably works only with MySQL.
     *
     * @param Illuminate\Database\Eloquent\Model $model
     * @param string $value
     * @return string
     */
    private function getUniqueSlug(\Illuminate\Database\Eloquent\Model $model, $value)
    {
        $slug = \Illuminate\Support\Str::slug($value);
        $slugCount = count($model->whereRaw("slug REGEXP '^{$slug}(-[0-9]+)?$' and id != '{$model->id}'")->withTrashed()->get());
        return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
    }
}
