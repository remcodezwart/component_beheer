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


    if (!isset($_POST['search'])) {}

        else{

        $sql = "SELECT components.productId, components.photo,components.description,components.price,components.supplierId,users.user_name,supplier.name,loaned.date_start,loaned.date_end, loaned.userid FROM components
        left join supplier on components.supplierid = supplier.id
        left join loaned on components.productId = loaned.compid
        left join users on loaned.userid = users.user_id where description = '" . $_POST['search'] . "'or userid = NULLIF('" . $_POST['search'] . "',0);";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => Session::get('user_id')));

        // fetchAll() is the PDO method that gets all result rows
        return $query->fetchAll();
    }
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

        // fetch() is the PDO method that gets a single result
        return $query->fetch();
    }

    /**
     * Set a note (create a new one)
     * @param string $note_text note text that will be created
     * @return bool feedback (was the note created properly ?)
     */
    public static function createComponent($photo, $description, $price, $stock, $supplier_id)
    {
      

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "
        INSERT INTO components (photo, description, price, supplierId) VALUES (:photo, :description, :price,  :supplierId)";
        $query = $database->prepare($sql);
        $query->execute(array(':photo' => $photo, ':description' => $description, ':price' => $price, ':supplierId' => $supplierId)); 
    }

    /**
     * Update an existing note
     * @param int $note_id id of the specific note
     * @param string $note_text new text of the specific note
     * @return bool feedback (was the update successful ?)
     */
    public static function updateComponent($productId, $photo, $description, $price, $supplierId)
    {
        if (!$productId ) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "
        UPDATE components SET photo = :photo, description = :description, price = :price, supplierId = :supplierId WHERE productId = :productId LIMIT 1; ";
        $query = $database->prepare($sql);
        $query->execute(array(':productId' => $productId, ':photo' => $photo, ':description' => $description, ':price' => $price, ':supplierId' => $supplierId));

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
    public static function deleteComponent($productId)
    {
        if (!$productId) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "DELETE FROM components WHERE productId = :productId LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':productId' => $productId));

        if ($query->rowCount() == 1) {
            return true;
        }

        // default return
        Session::add('feedback_negative', Text::get('FEEDBACK_COMPONENT_DELETION_FAILED'));
        return false;
    }
}
