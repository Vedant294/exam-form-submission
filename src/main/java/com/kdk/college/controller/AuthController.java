package com.kdk.college.controller;

import com.kdk.college.dto.ApiResponse;
import com.kdk.college.dto.LoginRequest;
import com.kdk.college.dto.SignupRequest;
import com.kdk.college.model.Student;
import com.kdk.college.service.StudentService;
import jakarta.validation.Valid;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/api/auth")
@CrossOrigin(origins = "*")
public class AuthController {
    
    @Autowired
    private StudentService studentService;
    
    @PostMapping("/login")
    public ResponseEntity<ApiResponse> login(@Valid @RequestBody LoginRequest request) {
        Student student = studentService.login(request);
        
        if (student != null) {
            return ResponseEntity.ok(new ApiResponse(true, "Login successful", student));
        }
        return ResponseEntity.badRequest().body(new ApiResponse(false, "Invalid credentials"));
    }
    
    @PostMapping("/signup")
    public ResponseEntity<ApiResponse> signup(@Valid @RequestBody SignupRequest request) {
        try {
            Student student = studentService.signup(request);
            return ResponseEntity.ok(new ApiResponse(true, "Registration successful", student));
        } catch (Exception e) {
            return ResponseEntity.badRequest().body(new ApiResponse(false, e.getMessage()));
        }
    }
}
