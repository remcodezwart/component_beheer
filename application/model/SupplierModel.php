<?php

class SupplierModel
{
	public static function getAllSuppliers($limit = null)
	{
		if ($limit === null || !is_numeric($limit) || 0 >= $limit) {
            $limit = 5;   
        } else {
            $limit = $limit*5;
        }

		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM supplier WHERE active = :active LIMIT :start, :amount";
        $query = $database->prepare($sql);
        $query->execute(array(':active' => 1, ':start' => $limit-5, 'amount' => 5));

        $suppliers = $query->fetchALL();
        return Filter::XSSFilter($suppliers);
	} 

	public static function getSupplier($id)
	{
		if (empty($id)) {
			Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
			return false;
		}

		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM supplier WHERE active = :active AND id = :id";
        $query = $database->prepare($sql);
        $query->execute(array(':active' => 1, ':id' => $id));

        $supplier = $query->fetch();

        return Filter::XSSFilter($supplier);
	} 

	public static function addSuppliers($name)
	{
		if (empty($name)) {
			Session::add('feedback_negative', Text::get('SUPPLIER'));
			return false;
		}

		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "INSERT INTO supplier (name) VALUES(:name)";
        $query = $database->prepare($sql);
        $query->execute(array(':name' => $name));
	} 

	public static function editSupplier($name, $id)
	{
		if (empty($id)) {
			Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
			return false;
		}

		if (empty($name)) {
			Session::add('feedback_negative', Text::get('SUPPLIER_NO_NAME'));
			return false;
		}

		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE supplier SET name = :name WHERE id = :id";
        $query = $database->prepare($sql);
        $query->execute(array(':name' => $name, ':id' => $id));
	}

	public static function deleteSupplier($id)
	{
		if (empty($id)) {
			Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
			return false;
		}

		$database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE supplier SET active = :active WHERE id = :id";
        $query = $database->prepare($sql);
        $query->execute(array(':active' => 0, ':id' => $id));
	}
}
