<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Course;
use App\User;
use App\UserCourse;
use Auth;
class ClassComposer
{
    public $movieList = [];
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->courses =  Course::all();
        $this->user_courses=UserCourse::all();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('courses', end($this->courses));
        $view->with('user_courses', end($this->user_courses));
    }
}