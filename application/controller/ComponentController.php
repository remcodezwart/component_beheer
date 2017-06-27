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
            'component' => ComponentModel::getAllComponent(),
            'locations' => LocationModel::getAllLocations()
        ));
    }

    public function preCreate()
    {
        $this->View->render('component/createcomloc', array(
            'create' => array(Request::post('name'), Request::post('description'), Request::post('specs'), Request::post('hyperlink'), Request::post('amount')),
            'locations' => LocationModel::getAllLocations()
        ));
    }

    public function switchAmount()
    {
        $this->View->render('component/amounts', array(
            'comloc' => LocationModel::getSomeComloc(Request::get('id'))
        ));
    }

    public function confirmSwitchAmount()
    {
        Csrf::checkToken();
        LocationModel::updateComloc(Request::post('amount'), Request::post('id'));
        Redirect::to('index');
    }

    public function create()
    {
        Csrf::checkToken();

ComponentModel::createComponent(Request::post('name'), Request::post('description'), Request::post('specs'), Request::post('hyperlink'), Request::post('location'), Request::post('amount'), Request::post('return'), Request::post('minAmount'));

        Redirect::to('index');
    }

    public function loanComponent()
    {
        Csrf::checkToken();
        ComponentModel::loanComponent(Request::post('id') , Request::post('amount'), Request::post('location'));
        Redirect::to('index');
    }

    public function edit()
    {
        $this->View->render('component/edit', array(
            'component' => ComponentModel::getComponent(Request::get('id')),
            'comloc' => LocationModel::getSomeComloc(Request::get('id'))
        ));
    }

    public function editSave()
    {
        Csrf::checkToken();
        ComponentModel::updateComponent(Request::post('description'), Request::post('specs'), Request::post('hyperlink'),Request::post('minAmount'), Request::post('name'), Request::post('id'));
        Redirect::to('index');
    }

    public function delete()
    {
        $this->View->render('component/delete', array(
            'component' => ComponentModel::getComponent(Request::get('id'))
        ));
    }

    public function deleteAction()
    {
        Csrf::checkToken();
        ComponentModel::deleteComponent(Request::post('id'));
        Redirect::to('index');
    }

    public function orderOverview()
    {
        $this->View->render('orderOverview/index', array(
            'locations' => LocationModel::getAllLocations(),
            'orders' => ComponentModel::getAllOrders(),
            'stores' => SupplierModel::getAllSuppliers(),     
            'components' => ComponentModel::getAllComponent()
        ));
    }

    public function orderedit()
    {
        $this->View->render('orderOverview/edit', array(
            'order' => componentModel::getOrder( request::get('id') ),
            'stores' => SupplierModel::getAllSuppliers(),     
            'locations' => LocationModel::getAllLocations(),
            'components' => ComponentModel::getAllComponent()
        ));
    }

    public function orderdelete()
    {
        $this->View->render('orderOverview/delete', array(
            'order' => componentModel::getOrder( request::get('id') )
        ));
    }

    public function addOrder()
    {
        Csrf::checkToken();

        ComponentModel::addOrder(Request::post('component'), Request::post('store'), Request::post('amount'), Request::post('shipping-date'), Request::post('location'));
        Redirect::to('component/orderoverview');
    }

    public function editOrder()
    {
        Csrf::checkToken();
        componentModel::editOrder(Request::post('component'), Request::post('store'), Request::post('amount'), Request::post('shipping-date'), Request::post('id'));
        Redirect::to('component/orderoverview');
    }

    public function deleteOrder()
    {
        Csrf::checkToken();
        componentModel::deleteOrder( Request::post('id') );
        Redirect::to('component/orderoverview');
    }

    public function archieve()
    {
        $this->View->render('orderOverview/archieve', array(
            'order' => componentModel::getOrder( request::get('id') )
        ));
    }

    public function addToArchieve()
    {
        Csrf::checkToken();
        componentModel::archieve( request::post('id') );
        Redirect::to('component/orderoverview');
    }

    public function correction()
    {
        Csrf::checkToken();
        $reason = array("Diefstal", "Correctie", "Kapot");

        mutationModel::addMutation(Request::post('component'), Request::post('location'), Request::post('amount'), Request::post('reason'));

        Redirect::to('supplier/mutationsIndex');
    }   
}
