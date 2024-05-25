<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $fields = [];
        $students = Student::query();

        if ($request->get('search')) {
            $students->where('firstname', 'like', "{$request->get('search')}%")
                ->orWhere('lastname', 'like', "{$request->get('search')}%");
        }

        if ($request->get('sex')) {
            $students->where('sex', $request->get('sex'));
        }

        if ($request->get('year')) {
            $students->where('year', $request->get('year'));
        }

        if ($request->get('course')) {
            $students->where('course', $request->get('course'));
        }

        if ($request->get('sort') && $request->get('direction')) {
            $students->orderBy($request->get('sort'), $request->get('direction'));
        }

        if ($request->get('fields')) {
            $fields = explode(',', $request->get('fields'));
        }

        return response()->json($fields ? $students->get($fields) : $students->get());
    }

    public function select($id)
    {
        try {
            return response()->json(Student::findOrFail($id));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create(Request $request)
    {
        $newStudent = Student::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'birthdate' => $request->birthdate,
            'sex' => $request->sex,
            'address' => $request->address,
            'year' => $request->year,
            'course' => $request->course,
            'section' => $request->section,
        ]);

        return $this->select($newStudent->id);
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->update($request->all());
        
        return response()->json($student);
    }

    public function sub_index($id){
        $student = Student::find($id);
        $subjects = Subject::all();
        if($subjects->count() > 0){
            return response()->json([
                'status' => 200,
                'students' => $student,
                'subjects' => $subjects
                
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'subjects' => 'No Subject Found'
            ],400);
        }
    }

    public function select_both($id, $subject_id)
    {
        $student = Student::find($id);
        $subjects = Subject::find($subject_id);
        if($subjects->count() > 0){
            return response()->json([
                'status' => 200,
                'students' => $student,
                'subjects' => $subjects
                
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'subjects' => 'No Subject Found'
            ],400);
        }
    }

    public function create_sub(Request $request, $id)
    {
        $student = Student::find($id);
        $newSubject = Subject::create([
            'subject_code' => $request->subject_code,
            'name' => $request->name,
            'description' => $request->description,
            'instructor' => $request->instructor,
            'schedule' => $request->schedule,
            'prelims' => $request->prelims,
            'midterms' => $request->midterms,
            'pre_finals' => $request->pre_finals,
            'finals' => $request->finals,
            'average_grade' => $request->average_grade,
            'remarks' => $request->remarks,
            'date_taken ' => $request->date_taken
        ]);

        return $this->select($newSubject->$student);
    }
}