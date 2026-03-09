package com.kdk.college.model;

import jakarta.persistence.*;
import lombok.Data;
import java.time.LocalDate;

@Entity
@Table(name = "students")
@Data
public class Student {
    @Id
    @Column(name = "id_code")
    private Integer idCode;
    
    @Column(nullable = false, length = 20)
    private String fname;
    
    @Column(nullable = false, length = 20)
    private String mname;
    
    @Column(nullable = false, length = 20)
    private String lname;
    
    @Column(name = "mob_no", nullable = false)
    private Integer mobNo;
    
    @Column(nullable = false, unique = true, length = 40)
    private String email;
    
    @Column(name = "adhar_no", nullable = false, unique = true)
    private Long adharNo;
    
    @Column(nullable = false)
    private LocalDate dob;
    
    @Column(nullable = false, length = 60)
    private String address;
    
    @Column(nullable = false, length = 50)
    private String password;
    
    @Column(name = "date_reg", nullable = false)
    private LocalDate dateReg;
    
    @Column(name = "profile_photo", length = 100)
    private String profilePhoto;
}
