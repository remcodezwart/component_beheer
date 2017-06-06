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
        if ( empty($name) || empty($description) || empty($specs) || empty($hyperlink) || empty($amount) ||    is_numeric($amount) === false) {
            Session::add('feedback_negative', Text::get('REQUIERED_FIELDS'));
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "
        INSERT INTO components (name, description, specs, hyperlink, amount) VALUES (:name, :description, :specs, :hyperlink, :amount)";
        $query = $database->prepare($sql);
        $query->execute(array(':name' => $name, ':description' => $description, ':specs' => $specs, ':hyperlink' => $hyperlink, ':amount' => $amount)); 

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
        return false;
    }

    public static function updateComponent($description, $specs, $hyperlink, $id)
    {
        if ( empty($description) || empty($specs) || empty($hyperlink) ) {
            Session::add('feedback_negative', Text::get('REQUIERED_FIELDS'));
            return false;
        }

        if (!$id) {
            Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE components SET description = :description, specs = :specs, hyperlink = :hyperlink WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':description' => $description, ':specs' => $specs, ':hyperlink' => $hyperlink, ':id' => $id));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
        return false;
    }

    public static function loanComponent($name, $amount0, $amount)
    {
        if ( empty($name) || empty($amount0) || empty($amount) ||                                           is_numeric($amount0) === false || is_numeric($amount) === false ) {
            Session::add('feedback_negative', Text::get('REQUIERED_FIELDS'));
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();
        
        $sql = "UPDATE components SET amount = :amount WHERE name = :name";
        $query = $database->prepare($sql);
        $amount = $amount0 - $amount;
        
        if (!is_numeric($amount) ) {
            Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
            return false;
        }

        if (0 > $amount) {
            Session::add('feedback_negative', Text::get('NOT_ENOUGH_COMPONENTS'));
            return false;
        }

        $query->execute(array(':amount' => $amount, ':name' => $name));


        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
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
            Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
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

        $sql = "SELECT order_history.amount as orderAmount,order_history.id as order_id,order_history.*,supplier.id,supplier.name as supplierName,supplier.active as activeSupplier,components.* FROM order_history INNER JOIN components ON order_history.componentId = components.id INNER JOIN supplier ON order_history.supplierId = supplier.id WHERE order_history.active = :active AND supplier.active = :active AND components.active = :active ORDER BY history ASC";
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

    public static function archieve($id) {
        $database = DatabaseFactory::getFactory()->getConnection();

        $amount = self::getOrder($id);

        $sql = "UPDATE components SET amount = amount + :amount WHERE id = :id";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $amount->id,':amount' => $amount->orderAmount));

        $sql = "UPDATE order_history SET history = :history WHERE id = :id";
        $query = $database->prepare($sql);
        $query->execute(array(':history' => 1, ':id' => $id));

        if ($query->rowCount() == 1) {
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
        return false;
    }
}
