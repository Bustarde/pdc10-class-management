<?php

namespace App;
use \PDO;

class Course
{
	public $id;
	public $course_code;
	public $name;
	public $description;
    public $teacher_id;

	// Database Connection Object
	protected $connection;

	public function __construct($course_code = null, $name = null, $description = null, $teacher_id = null)
	{
		$this->course_code = $course_code;
		$this->name = $name;
		$this->description = $description;
		$this->teacher_id = $teacher_id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getCourseCode()
	{
		return $this->course_code;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function getTeacherID()
	{
		return $this->teacher_id;
	}

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function save()
	{
		try {
			$sql = "INSERT INTO courses SET course_code=:course_code, name=:name, description=:description, teacher_id=:teacher_id";
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				':course_code' => $this->getCourseCode(),
				':name' => $this->getName(),
				':description' => $this->getDescription(),
				':teacher_id' => $this->getTeacherID()
			]);
			
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getById($id)
	{
		try {
			$sql = 'SELECT * FROM courses WHERE id=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id
			]);

			$row = $statement->fetch();

			$this->id = $row['id'];
			$this->course_code = $row['course_code'];
			$this->name = $row['name'];
			$this->description = $row['description'];
			$this->teacher_id = $row['teacher_id'];

			return $row;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function update($id, $course_code, $name, $description, $teacher_id)
	{
		try {
			$sql = 'UPDATE courses SET course_code=:course_code, name=:name, description=:description, teacher_id=:teacher_id WHERE id=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id,
				':course_code' => $course_code,
				':name' => $name,
				':description' => $description,
				':teacher_id' => $teacher_id
			]);
		
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function delete()
	{
		try {
			$sql = 'DELETE FROM courses WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getTeacherName($id)
	{
		try {
			$sql = 'SELECT teachers.name AS teacher_name
			FROM teachers
			INNER JOIN courses
			ON teachers.id = courses.teacher_id
			WHERE courses.teacher_id=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id
			]);

			$row = $statement->fetch();

			$this->teacher_name = $row['teacher_name'];

			return $row;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getAll()
	{
		try {
			$sql = 'SELECT * FROM courses';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}
}