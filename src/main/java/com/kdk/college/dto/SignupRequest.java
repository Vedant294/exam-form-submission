package com.kdk.college.dto;

import jakarta.validation.constraints.*;
import lombok.Data;
import java.time.LocalDate;

@Data
public class SignupRequest {
    @NotNull(message = "ID code is required")
    private Integer idCode;
    
    @NotBlank(message = "First name is required")
    private String fname;
    
    @NotBlank(message = "Middle name is required")
    private String mname;
    
    @NotBlank(message = "Last name is required")
    private String lname;
    
    @NotNull(message = "Mobile number is required")
    private Integer mobNo;
    
    @NotBlank(message = "Email is required")
    @Email(message = "Invalid email format")
    private String email;
    
    @NotNull(message = "Aadhar number is required")
    private Long adharNo;
    
    @NotNull(message = "Date of birth is required")
    private LocalDate dob;
    
    @NotBlank(message = "Address is required")
    private String address;
    
    @NotBlank(message = "Password is required")
    @Size(min = 3, message = "Password must be at least 3 characters")
    private String password;
    
    @NotBlank(message = "Confirm password is required")
    private String confirmPassword;
}
