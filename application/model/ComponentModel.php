<?php


class ComponentModel
{
    /**
     * Get all notes (notes are just example data that the user has created)
     * @return array an array with several objects (the results)
     */
    public static function getAllComponent()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM components WHERE active = 1";
        $query = $database->prepare($sql);
        $query->execute();
        $components = $query->fetchAll();
        // fetchAll() is the PDO method that gets all result rows
        return Filter::XSSFilter($components);
    }


    /**
     * Get a single note
     * @param int $note_id id of the specific note
     * @return object a single object (the result)
     */


 public static function createMutation()
    {

      $database = DatabaseFactory::getFactory()->getConnection();
           if (!isset($_POST['student'])) {}
          else{
            
        $sql = "
        INSERT INTO mutations (date, productId,description, studentId,stock) VALUES (CURDATE(), '".$_GET['productId']."','".$_POST['description']."', '".$_POST['student']."','".$_POST['quantity']."')
        ON DUPLICATE KEY UPDATE date=CURDATE(), productId='".$_GET['productId']."', studentId='".$_POST['student']."',description='".$_POST['description']."';
        ";
        $query = $database->prepare($sql);
        $query->execute(array()); 
    }
}



    public static function getComponent($productId)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT components.*,supplier.name FROM components
        left join supplier on components.supplierId = supplierId
        WHERE components.productId = :productId LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':productId' => $productId));
        $component = $query->fetch();
        // fetch() is the PDO method that gets a single result
        return Filter::XSSFilter($component);
    }

    /**
     * Set a note (create a new one)
     * @param string $note_text note text that will be created
     * @return bool feedback (was the note created properly ?)
     */
    public static function createComponent($name, $description, $specs, $hyperlink, $amount)
    {
      

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "
        INSERT INTO components (name, description, specs, hyperlink, amount) VALUES (:name, :description, :specs, :hyperlink, :amount)";
        $query = $database->prepare($sql);
        $query->execute(array(':name' => $name, ':description' => $description, ':specs' => $specs, ':hyperlink' => $hyperlink, ':amount' => $amount)); 
    }

    /**
     * Update an existing note
     * @param int $note_id id of the specific note
     * @param string $note_text new text of the specific note
     * @return bool feedback (was the update successful ?)
     */
    public static function updateComponent($description, $specs, $hyperlink, $id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE components SET description = :description, specs = :specs, hyperlink = :hyperlink WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':description' => $description, ':specs' => $specs, ':hyperlink' => $hyperlink, ':id' => $id));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_COMPONENT_EDITING_FAILED'));
        return false;
    }

    /**
     * Delete a specific note
     * @param int $note_id id of the note
     * @return bool feedback (was the note deleted properly ?)
     */
    public static function deleteComponent($id)
    {
        if (!$id) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE components SET active = 0 WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));

        if ($query->rowCount() == 1) {
            return true;
        }

        // default return
        Session::add('feedback_negative', Text::get('FEEDBACK_COMPONENT_DELETION_FAILED'));
        return false;
    }
}
