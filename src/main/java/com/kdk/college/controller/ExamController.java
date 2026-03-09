package com.kdk.college.controller;

import com.kdk.college.dto.ApiResponse;
import com.kdk.college.model.ExamSelection;
import com.kdk.college.service.ExamService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import java.util.List;

@RestController
@RequestMapping("/api/exams")
@CrossOrigin(origins = "*")
public class ExamController {
    
    @Autowired
    private ExamService examService;
    
    @PostMapping
    public ResponseEntity<ApiResponse> createExamSelection(@RequestBody ExamSelection exam) {
        ExamSelection created = examService.createExamSelection(exam);
        return ResponseEntity.ok(new ApiResponse(true, "Exam selection created", created));
    }
    
    @GetMapping
    public ResponseEntity<List<ExamSelection>> getAllExamSelections() {
        return ResponseEntity.ok(examService.getAllExamSelections());
    }
}
