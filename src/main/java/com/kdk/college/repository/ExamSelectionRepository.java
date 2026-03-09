package com.kdk.college.repository;

import com.kdk.college.model.ExamSelection;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface ExamSelectionRepository extends JpaRepository<ExamSelection, Integer> {
}
