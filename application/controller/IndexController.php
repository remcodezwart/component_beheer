<?php

class IndexController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Handles what happens when user moves to URL/index/index - or - as this is the default controller, also
     * when user moves to /index or enter your application at base level
     */
    public function index()
    {
        $this->View->render('index/index', array(
            'components' => ComponentModel::getAllComponent(),
            'locations' => LocationModel::getAllLocations(),
            'comloc' => LocationModel::getAllComloc()
        ));
    }

    public function search()
    {
        $this->View->render('index/search', array(

        ));
    }

    public function searchAction()
    {
        Csrf::checkToken();
        searchModel::search(Request::post('search'));
        Redirect::to('index/search');
    }

    public function loanMe()
    {
        $this->View->render('index/loanscreen', array(
            'component' => ComponentModel::getComponent(Request::get('id'))
        ));
    }
}
