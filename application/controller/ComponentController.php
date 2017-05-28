<?php

class ComponentController extends Controller
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
        $this->View->render('component/index', array(
            'component' => ComponentModel::getAllComponent()
        ));
    }

    public function createMutation()
    {
      ComponentModel::createMutation();
       Redirect::to('component');
    }

    public function create()
    {

        ComponentModel::createComponent(Request::post('name'), Request::post('description'), Request::post('specs'), Request::post('hyperlink'), Request::post('amount'));
        Redirect::to('index');
    }

    public function edit($productId)
    {
        $this->View->render('component/edit');
    }

    public function editSave()
    {
        ComponentModel::updateComponent(Request::post('description'), Request::post('specs'), Request::post('hyperlink'), Request::post('amount'), Request::post('id'));
        Redirect::to('index');
    }

    public function delete()
    {
        ComponentModel::deleteComponent(Request::post('id'));
        Redirect::to('index');
    }

    public function orderOverview()
    {
        $this->View->render('orderOverview/index', array(
            'stores' => SupplierModel::getAllSuppliers(),     
            'components' => ComponentModel::getAllComponent()
        ));
    }

    public function addOrder()
    {


        Csrf::checkToken();

        ComponentModel::addOrder(Request::post('component'), Request::post('store'), Request::post('amount'), Request::post('shipping-date'));
        //Redirect::to('component/orderoverview');
    }
}
