<?php

namespace App;
use \PDO;

class Teacher
{
	public $id;
	public $teacher_code;
	public $name;
	public $email;
	public $contact_number;
   
	// Database Connection Object
	protected $connection;

	public function __construct($teacher_code = null, $name = null, $email = null, $contact_number = null)
	{
		$this->teacher_code = $teacher_code;
		$this->name = $name;
		$this->email = $email;
		$this->contact_number = $contact_number;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getTeacherCode()
	{
		return $this->teacher_code;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getContactNumber()
	{
		return $this->contact_number;
	}

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function save()
	{
		try {
			$sql = "INSERT INTO teachers SET teacher_code=:teacher_code, name=:name, email=:email, contact_number=:contact_number";
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				':teacher_code' => $this->getTeacherCode(),
				':name' => $this->getName(),
				':email' => $this->getEmail(),
				':contact_number' => $this->getContactNumber()
			]);
			
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getById($id)
	{
		try {
			$sql = 'SELECT * FROM teachers WHERE id=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id
			]);

			$row = $statement->fetch();

			$this->id = $row['id'];
			$this->teacher_code = $row['teacher_code'];
			$this->name = $row['name'];
			$this->email = $row['email'];
			$this->contact_number = $row['contact_number'];

			return $row;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function update($id, $teacher_code, $name, $email, $contact_number)
	{
		try {
			$sql = 'UPDATE teachers SET teacher_code=:teacher_code, name=:name, email=:email, contact_number=:contact_number WHERE id=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id,
				':teacher_code' => $teacher_code,
				':name' => $name,
				':email' => $email,
				':contact_number' => $contact_number
			]);
		
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function delete()
	{
		try {
			$sql = 'DELETE FROM teachers WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function viewCourses($teacher_id)
	{
		try {
			$sql = 'SELECT * FROM courses WHERE teacher_id=:teacher_id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':teacher_id' => $teacher_id
			]);

            $row = $statement->fetchAll();
            return $row;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getAll()
	{
		try {
			$sql = 'SELECT * FROM teachers';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}
}