<?php

class LocationModel
{

    public static function getAllLocations()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM location WHERE active = :active";
        $query = $database->prepare($sql);
        $query->execute(array(':active' => 1));

        $locations = $query->fetchALL();
        return Filter::XSSFilter($locations);
    }


    public static function getLocation($id)
    {
        if (empty($id)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM location WHERE id = :id AND active = :active";
        $query = $database->prepare($sql);
        $query->execute(array(':active' => 1, 'id' => $id));

        $location = $query->fetch();
        return Filter::XSSFilter($location);
    }

    public static function addLocation($adress)
    {
        if (empty($adress)) {
            Session::add('feedback_negative', Text::get('LOCATION_NO_ADDRESS'));
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO location (address) VALUES(:addres)";
        $query = $database->prepare($sql);
        $query->execute(array(':addres' => $adress));

        if ($query->rowCount() !== 1) {
            Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
            return false;
        }
    }

    public static function deleteLocation($id)
    {
        if (empty($id)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE location SET active = :active WHERE id = :id";
        $query = $database->prepare($sql);
        $query->execute(array(':active' => 0, ':id' => $id));

        if ($query->rowCount() !== 1) {
            Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
        } 
    }

    public static function editLocation($id, $address)
    {
        if (empty($id)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
            return false;
        }

        if (empty($address)) {
            Session::add('feedback_negative', Text::get('LOCATION_NO_ADDRESS'));
            return false;
        }

        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE location SET address = :address WHERE id = :id";
        $query = $database->prepare($sql);
        $query->execute(array(':address' => $address, ':id' => $id));

        if ($query->rowCount() !== 1) {
            Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
            return false;
        } 
    }

    public static function getAllComloc()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT comloc.*, components.name AS name, location.address AS address FROM ((comloc INNER JOIN components ON comloc.component_id = components.id) INNER JOIN location ON comloc.location_id = location.id)";
        $query = $database->prepare($sql);
        $query->execute();
        $locations = $query->fetchALL();
        return Filter::XSSFilter($locations);
    }

    public static function getSomeComloc($componentId, $locationId = null)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        if ($locationId === null) {
            $sql = "SELECT comloc.*, components.name AS name, location.address AS address FROM ((comloc INNER JOIN components ON comloc.component_id = components.id) INNER JOIN location ON comloc.location_id = location.id) WHERE comloc.component_id = :component";
            $query = $database->prepare($sql);
            $query->execute(array(':component' => $componentId));
            $locations = $query->fetchALL();
        } else {
            $sql = "SELECT comloc.*, components.name AS name, location.address AS address FROM ((comloc INNER JOIN components ON comloc.component_id = components.id) INNER JOIN location ON comloc.location_id = location.id) WHERE comloc.component_id = :component AND comloc.location_id = :location";
            $query = $database->prepare($sql);
            $query->execute(array(':component' => $componentId, ':location' => $locationId));
            $locations = $query->fetch();
        }

        return Filter::XSSFilter($locations);
    }

    public static function updateComloc($amount, $id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE comloc SET amount = :amount WHERE id = :id";
        $query = $database->prepare($sql);
        $query->execute(array(':amount' => $amount, ':id' => $id));

        if ($query->rowCount() !== 1) {
            Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
            return false;
        }
    }

    public static function createComloc($componentId, $locationId, $amount)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO comloc (component_id, location_id, amount) VALUES(:componentId, :locationId, :amount)";
        $query = $database->prepare($sql);
        $query->execute(array(':componentId' => $componentId, ':locationId' => $locationId, 'amount' => $amount));

        if ($query->rowCount() !== 1) {
            Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
            return false;
        }

        return true;
    }
}