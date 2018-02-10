<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyGeneralInformation;
use App\Models\TaxOptions;

class SettingController extends Controller
{
    public function index()
    {
        return view('pages.setting.index');
    }






    /******************************************/
    public function home()
    {
        return view('pages.setting.home');
    }
    /******************************************/






    /******************************************/
    public function general()
    {
    	//Eventually need to make a way so that it can recognize which profile is
    	//  currently selected
    	$company_id = $this->company_id;
    	$company_info = CompanyGeneralInformation::find($company_id);
    	$state = $company_info['state'];
    	return view('pages.setting.general')->with(compact('company_info', 'state'));
    }

    /**
    * Function to update general settings for company
    * @param Request\request $request 
    * @param Int $id
    * 
    * @return View
    */
    public function updateGeneral(Request $request, $id)
    {
    	try {

	    	$info = CompanyGeneralInformation::find($id);

	    	$info->company_name = $request->input('company_name');
	    	$info->owner_name = $request->input('owner_name');
	    	$info->city = $request->input('city');
	    	$info->state = $request->input('state');
	    	$info->start_date = $request->input('start_date');

	    	$info->save();

    		$message = 'Successfully updated general settings.';
    	}
    	catch (\Exception $e) {
    		$message = $e->getMessage();
    	}

    	return redirect()->back()->with('feedback', $message);
    }

    /******************************************/

    



    /******************************************/
    public function reports()
    {
        return view('pages.setting.reports');
    }
    /******************************************/





    /******************************************/
    public function taxes()
    {
        $taxes = TaxOptions::all();
        return view('pages.setting.taxes')->with(compact('taxes'));
    }
    public function addTax(Request $request)
    {
        try{
            $tax = new TaxOptions;

            $tax->name = $request->input('name');
            $tax->percentage = $request->input('percentage');
            $tax->save();
            $message = 'Successfully added tax';
        }
        catch (\Exception $e) {
            $message = $e->getMessage();
        }
        return redirect()->back()->with('feedback', $message);


    }
    /******************************************/
    



    
    /******************************************/
    public function localization()
    {
    	return view('pages.setting.localization');
    }


}
