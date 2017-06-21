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

    public static function createComponent($name, $description, $specs, $hyperlink, $amount, $minAmount)
    {
        if ( empty($name) || empty($description) || empty($specs) || empty($hyperlink) || empty($amount) || empty($minAmount) || is_numeric($minAmount) === false || is_numeric($amount) === false) {
            Session::add('feedback_negative', Text::get('REQUIERED_FIELDS'));
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "
        INSERT INTO components (name, description, specs, hyperlink, amount,minAmount) VALUES (:name, :description, :specs, :hyperlink, :amount, :minAmount)";
        $query = $database->prepare($sql);
        $query->execute(array(':name' => $name, ':description' => $description, ':specs' => $specs, ':hyperlink' => $hyperlink, ':amount' => $amount, ':minAmount' => $minAmount)); 

        if ($query->rowCount() == 1) {
            ComponentModel::checkIfComponentsUnderMinimumAmount();
            mutationModel::addMutation($database->lastInsertId() ,1 ,$amount ,"Onderdeel toegevoegd");
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

    public static function loanComponent($id, $amount)
    {   
        $validate = self::getComponent($id);

        $amount = $validate->amount - $amount;

        if (empty($id) || empty($amount) || is_numeric($amount) === false) {
            Session::add('feedback_negative', Text::get('REQUIERED_FIELDS'));
            return false;
        }
        if (!is_numeric($amount) ) {
            Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
            return false;
        }

        if (0 > $amount) {
            Session::add('feedback_negative', Text::get('NOT_ENOUGH_COMPONENTS'));
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();
        
        $sql = "UPDATE components SET amount = :amount WHERE id = :id";
        $query = $database->prepare($sql);

        $query->execute(array(':amount' => $amount, ':id' => $id));


        if ($query->rowCount() == 1) {
            ComponentModel::checkIfComponentsUnderMinimumAmount();
            mutationModel::addMutation($id ,1 ,"-".$amount ,"Onderdeel uitgeleend");
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
            mutationModel::addMutation($componentId ,1 ,$amount , "Onderdeel besteld");
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
            ComponentModel::checkIfComponentsUnderMinimumAmount();
            mutationModel::addMutation($amount->id ,1 ,$amount->orderAmount , "Besteld onderdeel aangekomen");
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
        return false;
    }

    public static function checkIfComponentsUnderMinimumAmount()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM `components` WHERE minAmount > amount";
        $query = $database->prepare($sql);
        $query->execute();

        $components = $query->fetchAll();

        if (!empty($components)) {
            self::sendComponentEmail($components);
        } else {
            return false;
        }
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
