<?php
class ComponentModel
{
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

    public static function createComponent($name, $description, $specs, $hyperlink, $location, $amount, $return, $minAmount)
    {
        if ( empty($name) || empty($description) || empty($specs) || empty($hyperlink) || empty($location) || empty($minAmount) || is_numeric($minAmount) === false || empty($amount) ) {

            Session::add('feedback_negative', Text::get('REQUIERED_FIELDS'));
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "
        INSERT INTO components (name, description, specs, hyperlink, minAmount, returns) 
        VALUES (:name, :description, :specs, :hyperlink, :minAmount, :return)";
        $query = $database->prepare($sql);
        $query->execute(array(':name' => $name, ':description' => $description, ':specs' => $specs, ':hyperlink' => $hyperlink, ':minAmount' => $minAmount, ':return' => ($return === '1' ? '1' : '0') )); 

        if ($query->rowCount() == 1) {
            locationModel::createComloc($database->lastInsertId() ,$location ,$amount);
            ComponentModel::checkIfComponentsUnderMinimumAmount();
            mutationModel::addMutation($database->lastInsertId() ,$location ,$amount ,"Onderdeel toegevoegd");
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
        return false;
    }

    public static function updateComponent($description, $specs, $hyperlink, $minAmount, $name, $id)
    {
        if (empty($description) || empty($specs) || empty($hyperlink) || empty($minAmount) && $minAmount !== '0' || is_numeric($minAmount) === false || empty($name)) {
            
            Session::add('feedback_negative', Text::get('REQUIERED_FIELDS'));
            return false;
        }

        if (!$id) {
            Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE components SET name = :name, description = :description, specs = :specs, hyperlink = :hyperlink, minAmount = :minAmount WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':minAmount' => $minAmount, ':name' => $name,':description' => $description, ':specs' => $specs, ':hyperlink' => $hyperlink, ':id' => $id));

        if ($query->rowCount() == 1) {
            ComponentModel::checkIfComponentsUnderMinimumAmount();
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
        return false;
    }

    public static function loanComponent($id, $amount, $location)
    {   
        $validate = locationModel::getSomeComloc($id, $location);

        if (empty($id) || empty($amount) || is_numeric($amount) === false || $validate === false) {
            Session::add('feedback_negative', Text::get('REQUIERED_FIELDS'));
            return false;
        }

        $amount = $validate->amount - $amount;

        if (!is_numeric($amount) ) {
            Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
            return false;
        }

        if (0 > $amount) {
            Session::add('feedback_negative', Text::get('NOT_ENOUGH_COMPONENTS'));
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();
        
        $sql = "UPDATE comloc SET amount = :amount 
        WHERE component_id = :componentId AND location_id = :locationId";
        $query = $database->prepare($sql);

        $query->execute(array(':amount' => $amount, ':componentId' => $id, ':locationId' => $id));

        if ($query->rowCount() == 1) {
            ComponentModel::checkIfComponentsUnderMinimumAmount();
            mutationModel::addMutation($id ,$location ,"-".$amount ,"Onderdeel uitgeleend");
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
        return false;
    }

    public static function deleteComponent($id)
    {
        if (!$id) {
            Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
            return false;
            exit;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE components SET active = 0 WHERE id = :id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $id));

        if ($query->rowCount() == 1) {
            $component = self::getComponent($id);
            mutationModel::addMutation($id ,1 ,"-".$component->amount, "Onderdeel verwijderd");
            return true;
            exit;
        }

        // default return
        Session::add('feedback_negative', Text::get('FEEDBACK_COMPONENT_DELETION_FAILED'));
        return false;
    }

    public static function addOrder($componentId, $supplierId, $amount, $date, $location)
    {
        if (!self::validateOrder($componentId, $supplierId, $amount, $date, $location)) {
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO order_history (date, amount, supplierId, componentId, locationId) 
        VALUES(:date, :amount, :supplierId, :componentId, :locationId)";
        $query = $database->prepare($sql);
        $query->execute(array(':date' => $date, ':amount' => $amount, ':supplierId' => $supplierId, ':componentId'  => $componentId, ':locationId' => $location));

        if ($query->rowCount() == 1) {
            mutationModel::addMutation($componentId ,$location ,$amount , "Onderdeel besteld");
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
        return false;
        
    }

    public static function editOrder($componentId, $supplierId, $amount, $date, $location, $id)
    {
        if (!self::validateOrder($componentId, $supplierId, $amount, $date, $location)) {
            return false;
        }
        
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE order_history SET 
        amount = :amount, supplierId = :supplierId,
        componentId = :componentId, date = :date,
        locationId = :locationId
        WHERE id = :id";
        $query = $database->prepare($sql); 
        $query->execute(array(
            ':date' => $date, 
            ':amount' => $amount, 
            ':supplierId' => $supplierId,
            ':componentId'  => $componentId, 
            'locationId' => $location,
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

    public static function validateOrder($componentId, $supplierId, $amount, $date, $location)
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

        if (is_numeric($location) === false || LocationModel::getLocation($location) === false) {
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

        $order = self::getOrder($id);

        $sql = "UPDATE comloc SET amount = amount + :amount 
        WHERE component_id = :componentId AND location_id = :locationId";
        $query = $database->prepare($sql);
        $query->execute(
            array(':locationId' => $order->locationId, ':componentId' => $order->componentId ,':amount' => $order->orderAmount)
        );

        $sql = "UPDATE order_history SET history = :history WHERE id = :id";
        $query = $database->prepare($sql);
        $query->execute(array(':history' => 1, ':id' => $id));

        if ($query->rowCount() == 1) {
            ComponentModel::checkIfComponentsUnderMinimumAmount();
            mutationModel::addMutation($order->id ,$order->locationId ,$order->orderAmount , "Besteld onderdeel aangekomen");
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
        return false;
    }

    public static function checkIfComponentsUnderMinimumAmount()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT components.minAmount, components.id, components.name,comloc.* FROM comloc INNER JOIN components ON components.id = comloc.component_id WHERE components.minAmount > amount";
        $query = $database->prepare($sql);
        $query->execute();

        $components = $query->fetchAll();

        if (!empty($components)) {
            self::sendComponentEmail($components);
        } else {
            return false;
        }
        return false;
    }

    protected static function sendComponentEmail($components)
    {

        $body = "
        <html>
            <head>
            <style>
                tr,td,th {
                    padding:5px;
                    border: 1px solid black;
                    border-collapse: collapse;
                }
                div {
                    margin:0xp auto;
                    text-align:center;
                    width:80%;
                }
            </style>
        </head>
        <body>
            <div>
                <h3>lage vooraad</h3>
                <table cellspacing=\"0px\">
                    <thead>
                        <tr>
                            <th>onderdeel</th>
                            <th>minimaal aantal</th>
                            <th>aantal in de vooraad</th>
                        </tr>
                    </thead>
                    <tbody>
        ";

        foreach ($components as $component) {
            $body .= "<tr>
                        <td>" . $component->name . "</td>
                        <td>" . $component->minAmount . "</td>
                        <td>". $component->amount ."</td>
                    </tr>";
        }

        $body .= "
                </tbody>
            </table>
            <h5>dit is een automatische email beantwoord hem niet</h5>
            </div>
        </body>";

        $user_email = Session::get('user_email');

        $mail = new Mail;
        $mail_sent = $mail->sendMail($user_email, Config::get('EMAIL_VERIFICATION_FROM_EMAIL'),
            Config::get('EMAIL_VERIFICATION_FROM_NAME'), Config::get('EMAIL_VERIFICATION_SUBJECT_OUT_OF_COMPONENTS'), $body );

        if (!$mail_sent) {
            Session::add('feedback_negative', Text::get('FEEDBACK_VERIFICATION_MAIL_SENDING_ERROR') . $mail->getError() );
            return false;
        }
    }

}
