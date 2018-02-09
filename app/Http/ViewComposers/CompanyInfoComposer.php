<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\CompanyGeneralInformation;
// use App\Repositories\UserRepository;

class CompanyInfoComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    // public function __construct(UserRepository $users)
    // {
    //     // Dependencies automatically resolved by service container...
    //     $this->users = $users;
    // }
    public function __construct()
    {

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $company_info = CompanyGeneralInformation::first()->toArray();
        $company_name = $company_info['company_name'];
        $company_id = $company_info['company_id'];
        $view->with(compact('company_name', 'company_id'));
    }
}