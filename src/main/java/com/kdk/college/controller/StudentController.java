package com.kdk.college.controller;

import com.kdk.college.dto.ApiResponse;
import com.kdk.college.model.Student;
import com.kdk.college.service.StudentService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/api/students")
@CrossOrigin(origins = "*")
public class StudentController {
    
    @Autowired
    private StudentService studentService;
    
    @GetMapping("/{idCode}")
    public ResponseEntity<ApiResponse> getStudent(@PathVariable Integer idCode) {
        return studentService.getStudentById(idCode)
                .map(student -> ResponseEntity.ok(new ApiResponse(true, "Student found", student)))
                .orElse(ResponseEntity.notFound().build());
    }
    
    @PutMapping("/{idCode}")
    public ResponseEntity<ApiResponse> updateStudent(@PathVariable Integer idCode, @RequestBody Student student) {
        student.setIdCode(idCode);
        Student updated = studentService.updateStudent(student);
        return ResponseEntity.ok(new ApiResponse(true, "Profile updated", updated));
    }
}
