package com.kdk.college.model;

import jakarta.persistence.*;
import lombok.Data;
import java.time.LocalDateTime;

@Entity
@Table(name = "exam_selections")
@Data
public class ExamSelection {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Integer id;
    
    @Column(length = 255)
    private String branch;
    
    @Column(length = 50)
    private String semester;
    
    @Column(columnDefinition = "TEXT")
    private String subjects;
    
    @Column(length = 255)
    private String elective;
    
    @Column(name = "created_at", nullable = false)
    private LocalDateTime createdAt = LocalDateTime.now();
}
