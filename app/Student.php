<?php

namespace App;
use \PDO;

class Student
{
	public $id;
	public $student_code;
	public $name;
	public $email;
	public $contact_number;
	public $program;
    
	// Database Connection Object
	protected $connection;

	public function __construct($student_code = null, $name = null, $email = null, $contact_number = null, $program = null)
	{
		$this->student_code = $student_code;
		$this->name = $name;
		$this->email = $email;
		$this->contact_number = $contact_number;
		$this->program = $program;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getStudentCode()
	{
		return $this->student_code;
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

    public function getProgram()
	{
		return $this->program;
	}

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function save()
	{
		try {
			$sql = "INSERT INTO students SET student_code=:student_code, name=:name, email=:email, contact_number=:contact_number, program=:program";
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				':student_code' => $this->getStudentCode(),
				':name' => $this->getName(),
				':email' => $this->getEmail(),
				':contact_number' => $this->getContactNumber(),
                ':program' => $this->getProgram()
			]);
			
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getById($id)
	{
		try {
			$sql = 'SELECT * FROM students WHERE id=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id
			]);

			$row = $statement->fetch();

			$this->id = $row['id'];
			$this->student_code = $row['student_code'];
			$this->name = $row['name'];
			$this->email = $row['email'];
			$this->contact_number = $row['contact_number'];
            $this->program = $row['program'];

			return $row;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function update($id, $student_code, $name, $email, $contact_number, $program)
	{
		try {
			$sql = 'UPDATE students SET student_code=:student_code, name=:name, email=:email, contact_number=:contact_number, program=:program WHERE id=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id,
				':student_code' => $student_code,
				':name' => $name,
				':email' => $email,
				':contact_number' => $contact_number,
                ':program' => $program
			]);
		
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function delete()
	{
		try {
			$sql = 'DELETE FROM students WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function viewCourses($student_id)
	{
		try {
			$sql = 'SELECT classes_rosters.id as id, 
			classes_rosters.course_code as course_code, 
			courses.name as courses_name
			FROM classes_rosters
			INNER JOIN courses
			ON classes_rosters.course_code = courses.course_code 
			WHERE student_id=:student_id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':student_id' => $student_id
			]);

			$row = $statement->fetchAll();

			return $row;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getClasses($id)
	{
		try {
			$sql = 'SELECT classes_rosters.id AS roster_code,
			courses.name AS courses_name,
			courses.course_code AS courses_code
			FROM classes_rosters
			INNER JOIN courses
			ON classes_rosters.course_code = courses.id
			WHERE student_code=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id
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
			$sql = 'SELECT * FROM students';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}
}