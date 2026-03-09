package com.kdk.college.repository;

import com.kdk.college.model.Student;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;
import java.util.Optional;

@Repository
public interface StudentRepository extends JpaRepository<Student, Integer> {
    Optional<Student> findByEmailAndPassword(String email, String password);
    Optional<Student> findByEmail(String email);
    boolean existsByEmail(String email);
    boolean existsByAdharNo(Long adharNo);
}
