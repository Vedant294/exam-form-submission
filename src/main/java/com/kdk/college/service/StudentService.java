package com.kdk.college.service;

import com.kdk.college.dto.LoginRequest;
import com.kdk.college.dto.SignupRequest;
import com.kdk.college.model.Student;
import com.kdk.college.repository.StudentRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import java.time.LocalDate;
import java.util.Optional;

@Service
public class StudentService {
    
    @Autowired
    private StudentRepository studentRepository;
    
    public Student login(LoginRequest request) {
        return studentRepository.findByEmailAndPassword(request.getEmail(), request.getPassword())
                .orElse(null);
    }
    
    public Student signup(SignupRequest request) throws Exception {
        if (!request.getPassword().equals(request.getConfirmPassword())) {
            throw new Exception("Passwords do not match");
        }
        
        if (studentRepository.existsByEmail(request.getEmail())) {
            throw new Exception("Email already exists");
        }
        
        if (studentRepository.existsByAdharNo(request.getAdharNo())) {
            throw new Exception("Aadhar number already exists");
        }
        
        Student student = new Student();
        student.setIdCode(request.getIdCode());
        student.setFname(request.getFname());
        student.setMname(request.getMname());
        student.setLname(request.getLname());
        student.setMobNo(request.getMobNo());
        student.setEmail(request.getEmail());
        student.setAdharNo(request.getAdharNo());
        student.setDob(request.getDob());
        student.setAddress(request.getAddress());
        student.setPassword(request.getPassword());
        student.setDateReg(LocalDate.now());
        
        return studentRepository.save(student);
    }
    
    public Optional<Student> getStudentById(Integer idCode) {
        return studentRepository.findById(idCode);
    }
    
    public Student updateStudent(Student student) {
        return studentRepository.save(student);
    }
}
