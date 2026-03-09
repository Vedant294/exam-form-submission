package com.kdk.college.service;

import com.kdk.college.model.ExamSelection;
import com.kdk.college.repository.ExamSelectionRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import java.util.List;

@Service
public class ExamService {
    
    @Autowired
    private ExamSelectionRepository examRepository;
    
    public ExamSelection createExamSelection(ExamSelection exam) {
        return examRepository.save(exam);
    }
    
    public List<ExamSelection> getAllExamSelections() {
        return examRepository.findAll();
    }
}
