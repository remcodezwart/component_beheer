<?php

/**
 * The note controller: Just an example of simple create, read, update and delete (CRUD) actions.
 */
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

    /**
     * This method controls what happens when you move to /note/index in your app.
     * Gets all notes (of the user).
     */
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

    /**
     * This method controls what happens when you move to /dashboard/create in your app.
     * Creates a new note. This is usually the target of form submit actions.
     * POST request.
     */
    public function create()
    {

        ComponentModel::createComponent(Request::post('photo'), Request::post('description'), Request::post('price'), Request::post('supplierId'));
        Redirect::to('component');
    }

    /**
     * This method controls what happens when you move to /note/edit(/XX) in your app.
     * Shows the current content of the note and an editing form.
     * @param $note_id int id of the note
     */
    public function edit($productId)
    {
        $this->View->render('component/edit', array(
            'comp' => ComponentModel::getComponent($productId)
        ));
    }

    /**
     * This method controls what happens when you move to /note/editSave in your app.
     * Edits a note (performs the editing after form submit).
     * POST request.
     */
    public function editSave()
    {
        ComponentModel::updateComponent(Request::post('productId'), Request::post('photo'), Request::post('description'), Request::post('price'), Request::post('supplierId'));
        Redirect::to('component');
    }

    /**
     * This method controls what happens when you move to /note/delete(/XX) in your app.
     * Deletes a note. In a real application a deletion via GET/URL is not recommended, but for demo purposes it's
     * totally okay.
     * @param int $note_id id of the note
     */
    public function delete($productId)
    {
        ComponentModel::deleteComponent($productId);
        Redirect::to('component');
    }
}
