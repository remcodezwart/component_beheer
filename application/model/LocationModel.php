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

        $sql = "SELECT comloc.*, components.name AS name, location.address AS address FROM ((comloc inner join components on comloc.component_id = components.id) INNER JOIN location ON comloc.location_id = location.id)";
        $query = $database->prepare($sql);
        $query->execute();
        $locations = $query->fetchALL();
        return Filter::XSSFilter($locations);
    }

    public static function getSomeComloc($component_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT comloc.*, components.name as name, location.address as address from ((comloc inner join components on comloc.component_id = components.id)inner join location on comloc.location_id = location.id) where comloc.component_id = :id";
        $query = $database->prepare($sql);
        $query->execute(array(':id' => $component_id));
        $locations = $query->fetchALL();
        return Filter::XSSFilter($locations);
    }

    public static function updateComloc($amount, $component, $location)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE comloc SET amount = :amount WHERE component_id = :component AND location_id = :location";
        $query = $database->prepare($sql);
        $query->execute(array(':amount' => $amount, ':component' => $component, ':location' => $location));

        if ($query->rowCount() !== 1) {
            Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
            return false;
        }
    }
}