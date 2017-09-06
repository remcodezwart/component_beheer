<?php

/**
 * Class Error
 * This controller simply shows a page that will be displayed when a controller/method is not found. Simple 404.
 */
class LoanController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();

        Auth::checkAuthentication();
    }

    /**
     * This method controls what happens / what the user sees when a page does not exist (404)
     */
    public function index()
    {
        $this->View->render('loaned/index', array(
            'loans' => LoanModel::getAllLoans(request::get('page'))        
        ));
    }

    public function edit()
    {
        $this->View->render('loaned/edit', array(
            'loan' => LoanModel::getLoan(request::get('id')),
            'locations' => LocationModel::getAllLocations()      
        ));
    }

    public function delete()
    {
        $this->View->render('loaned/delete', array(
            'loan' => LoanModel::getLoan(request::get('id'))        
        ));
    }

    public function deleteConfirmed()
    {
        Csrf::checkToken();

        LoanModel::completedLoan(request::post('id'));
        redirect::to('loan/index');
    }

    public function editConfirmed()
    {
        Csrf::checkToken();

        LoanModel::edit(request::post('id'), request::post('location'), request::post('amount'), request::post('barcode'));
        redirect::to('loan/index');
    }
}
