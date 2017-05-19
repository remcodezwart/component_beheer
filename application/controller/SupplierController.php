<?php

class SupplierController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();

        // VERY IMPORTANT: All controllers/areas that should only be usable by logged-in users
        // need this line! Otherwise not-logged in users could do actions. If all of your pages should only
        // be usable by logged-in users: Put this line into libs/Controller->__construct
        Auth::checkAuthentication();
    }

    public function index() 
    {
        $this->View->render('supplier/index', array(
            'suppliers' => SupplierModel::getAllSuppliers()
        ));
    }

    public function add()
    {
        Csrf::checkToken();

        SupplierModel::addSuppliers(request::post('name'));
        redirect::to('supplier/index');
    }

    public function edit()
    {
        $this->View->render('supplier/edit', array(
            'suplier' => SupplierModel::getSupplier(request::get('id'))
        ));
        
    }

    public function delete()
    {
        $this->View->render('supplier/delete', array(
            'suplier' => SupplierModel::getSupplier(request::get('id'))
        ));
    }

    public function editConfirmed()
    {
        Csrf::checkToken();

        SupplierModel::editSupplier(request::post('name'), request::post('id'));
        redirect::to('supplier/index');
    }

    public function deleteConfirmed()
    {
        Csrf::checkToken();

        SupplierModel::deleteSupplier(request::post('id'));
        redirect::to('supplier/index');
    }
}