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



    public static function getComponent($id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM components
        WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));
        $component = $query->fetch();
        // fetch() is the PDO method that gets a single result
        return Filter::XSSFilter($component);
    }

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
        var_dump($description, $specs, $hyperlink, $id);
        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_COMPONENT_EDITING_FAILED'));
        return false;
    }

    public static function loanComponent($name, $amount0, $amount)
    {
        $database = DatabaseFactory::getFactory()->getConnection();
        var_dump($name, $amount, $amount0);
        $sql = "UPDATE components SET amount = :amount WHERE name = :name";
        $query = $database->prepare($sql);
        $amount = ($amount0 - $amount);
        var_dump($amount);
        $query->execute(array(':amount' => $amount, ':name' => $name));
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

    public static function addOrder($componentId, $supplierId, $amount, $date)
    {
        if (!self::validateOrder($componentId, $supplierId, $amount, $date)) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO order_history (date, amount, supplierId, componentId) VALUES(:date, :amount, :supplierId, :componentId)";
        $query = $database->prepare($sql);
        $query->execute(array(':date' => $date, ':amount' => $amount, ':supplierId' => $supplierId, ':componentId'  => $componentId));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
        return false;
        
    }

    public static function editOrder($componentId, $supplierId, $amount, $date, $id)
    {
        if (!self::validateOrder($componentId, $supplierId, $amount, $date)) {
            return false;
        }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE order_history SET amount = :amount, supplierId = :supplierId, componentId = :componentId, date = :date WHERE id = :id";
        $query = $database->prepare($sql); 
        $query->execute(array(
            ':date' => $date, 
            ':amount' => $amount, 
            ':supplierId' => $supplierId,
            ':componentId'  => $componentId, 
            ':id' => $id
        ));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
        return false;
    }

    public static function getAllOrders()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT order_history.amount as orderAmount,order_history.id as order_id,order_history.*,supplier.id,supplier.name as supplierName,supplier.active as activeSupplier,components.* FROM order_history INNER JOIN components ON order_history.componentId = components.id INNER JOIN supplier ON order_history.supplierId = supplier.id WHERE order_history.active = :active AND supplier.active = :active AND components.active = :active";
        $query = $database->prepare($sql);
        $query->execute(array(':active' => 1));

        $orders = $query->fetchAll();

        $database = null;

        return Filter::XSSFilter($orders);
    }

    public static function validateOrder($componentId, $supplierId, $amount, $date)
    {
        $date = explode("-", $date);

        if (count($date) !== 3 || checkdate($date[1] ,$date[0] ,$date[2]) === false) {
            //count $date to see if it has 3 items if not then php will halt the if statment preventing error undefinde index in the next condition
            Session::add('feedback_negative', Text::get('NO_DATE'));
            return false;
        }

        if (is_numeric($componentId) === false || self::getComponent($componentId) === false) {
            Session::add('feedback_negative', Text::get('FEEDBACK_COMPONENT_DOES_NOT_EXSIST'));
            return false;
        }

        if (is_numeric($supplierId) === false || SupplierModel::getSupplier($supplierId) === false) {
            Session::add('feedback_negative', Text::get('NO_SUPPLIER'));
            return false;
        }

        if (is_numeric($amount) === false || 0 >= $amount) {
            Session::add('feedback_negative', Text::get('NEGATIVE_AMOUNT'));
            return false;
        }
        return true;
    }

    public static function getOrder($id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT order_history.amount as orderAmount,order_history.id as order_id,order_history.*,supplier.id as supplierId,supplier.name as supplierName,supplier.active as activeSupplier,components.* FROM order_history INNER JOIN components ON order_history.componentId = components.id INNER JOIN supplier ON order_history.supplierId = supplier.id WHERE supplier.active = :active AND components.active = :active AND order_history.id = :id";
        $query = $database->prepare($sql);
        $query->execute(array(':active' => 1, ':id' => $id));

        $order = $query->fetch();

        $database = null;

        return Filter::XSSFilter($order);
    }

    public static function deleteOrder($id) {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE order_history SET active = :active WHERE id = :id";
        $query = $database->prepare($sql);
        $query->execute(array(':active' => 0, ':id' => $id));

        if ($query->rowCount() == 1) {
            return true;
        }


        Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
        return false;
    }
}
