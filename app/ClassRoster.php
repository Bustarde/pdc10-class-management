<?php

namespace App;
use \PDO;

class ClassRoster
{
	public $id;
	public $course_code;
	public $student_id;
	public $date_enrolled;

	// Database Connection Object
	protected $connection;

	public function __construct($course_code = null, $student_id = null)
	{
		$this->course_code = $course_code;
		$this->student_id = $student_id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getCourseCode()
	{
		return $this->course_code;
	}

	public function getStudentID()
	{
		return $this->student_id;
	}

	public function getDateEnrolled()
	{
		return $this->date_enrolled;
	}

	public function setConnection($connection)
	{
		$this->connection = $connection;
	}

	public function save()
	{
		try {
			$sql = "INSERT INTO classes_rosters SET course_code=:course_code, student_id=:student_id";
			$statement = $this->connection->prepare($sql);
			return $statement->execute([
				':course_code' => $this->getCourseCode(),
				':student_id' => $this->getStudentID()
			]);
			
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getById($id)
	{
		try {
			$sql = 'SELECT * FROM classes_rosters WHERE id=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id
			]);

			$row = $statement->fetch();

			$this->id = $row['id'];
			$this->course_code = $row['course_code'];
			$this->student_id = $row['student_id'];
			$this->date_enrolled = $row['date_enrolled'];

			return $row;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getByClassId($course_id)
	{
		try {
			$sql = 'SELECT classes_rosters.id AS id, 
			courses.id AS course_id,
			students.id AS student_id,
			courses.name AS course_name, 
			classes_rosters.course_code, 
			students.student_code AS students_code, 
			students.name AS student_name, 
			classes_rosters.date_enrolled AS date_enrolled 
			FROM classes_rosters 
			INNER JOIN courses 
			ON classes_rosters.course_code = courses.course_code 
			INNER JOIN students 
			ON classes_rosters.student_id = students.id 
			WHERE courses.id=:course_id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':course_id' => $course_id
			]);

			$row = $statement->fetchAll();

			return $row;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function update($id, $course_code, $student_id, $date_enrolled)
	{
		try {
			$sql = 'UPDATE classes_rosters SET course_code=:course_code, student_id=:student_id, date_enrolled=:date_enrolled WHERE id=:id';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id,
				':course_code' => $course_code,
				':student_id' => $student_id,
				':date_enrolled' => $date_enrolled
			]);
		
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function delete()
	{
		try {
			$sql = 'DELETE FROM classes_rosters WHERE id=?';
			$statement = $this->connection->prepare($sql);
			$statement->execute([
				$this->getId()
			]);
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getRoster(){
		try {
			$sql = 'SELECT classes_rosters.course_code AS courses_code,
			courses.id AS course_id,
			student_id, 
			courses.name AS course_name, 
			teachers.name AS teacher_name, 
			COUNT(classes_rosters.course_code) AS students_roster
			FROM classes_rosters 
			INNER JOIN courses 
			ON classes_rosters.course_code = courses.course_code 
			INNER JOIN teachers 
			ON courses.teacher_id = teachers.id
			GROUP BY courses_code';

			$data = $this->connection->query($sql)->fetchAll();
			return $data;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getAll()
	{
		try {
			$sql = 'SELECT * FROM classes_rosters';
			$data = $this->connection->query($sql)->fetchAll();
			return $data;
		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

	public function getStudentDetails($id)
	{
		try {
			$sql = 'SELECT students.name AS student_name,
			students.student_code AS students_code,
			students.id AS student_id,
			classes_rosters.date_enrolled AS date_enrolled,
			classes_rosters.id AS roster_id
			FROM students
			INNER JOIN classes_rosters
			ON classes_rosters.student_id = students.id 
			WHERE classes_rosters.student_id=:id';

			$statement = $this->connection->prepare($sql);
			$statement->execute([
				':id' => $id
			]);

			$row = $statement->fetch();

			$this->id = $row['id'];
			$this->student_name = $row['student_name'];
			$this->date_enrolled = $row['date_enrolled'];
			$this->student_code = $row['student_code'];

			return $row;

		} catch (Exception $e) {
			error_log($e->getMessage());
		}
	}

}