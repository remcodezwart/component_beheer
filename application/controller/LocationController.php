<?php


class LocationController extends Controller
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
        $this->View->render('location/index',array(
            'locations' => LocationModel::getAllLocations(request::get('page'))
        ));
    }

    public function add()
    {
        Csrf::checkToken();

        LocationModel::addLocation(request::post('adress'));
        redirect::to('location/index');
    }

    public function delete()
    {

        $this->View->render('location/delete',array(
            'location' => locationModel::getLocation(request::get('id'))
        ));
    }

    public function deleteConfirmed()
    {
        Csrf::checkToken();

        LocationModel::deleteLocation(request::post('id'));
        redirect::to('location/index');
    }

    public function edit()
    {
        $this->View->render('location/edit',array(
            'location' => locationModel::getLocation(request::get('id'))
        ));
    }

    public function editConfirmed()
    {
        Csrf::checkToken();

        LocationModel::editLocation(request::post('id'), request::post('adress'));
        redirect::to('location/index');
    }
    public function comloc()
    {
        LocationModel::getAllComloc();
    }
}
