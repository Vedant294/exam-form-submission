import React, { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import Navbar from '../components/Navbar';
import { studentService } from '../services/api';

function Dashboard() {
  const [student, setStudent] = useState(null);
  const navigate = useNavigate();

  useEffect(() => {
    const storedStudent = JSON.parse(localStorage.getItem('student'));
    if (!storedStudent) {
      navigate('/login');
      return;
    }
    
    studentService.getProfile(storedStudent.idCode)
      .then(res => setStudent(res.data.data))
      .catch(() => navigate('/login'));
  }, [navigate]);

  if (!student) return <div>Loading...</div>;

  return (
    <div className="bg-gray-100 min-h-screen">
      <Navbar student={student} />
      
      <div className="flex flex-col md:flex-row p-6">
        <div className="bg-white p-6 rounded-lg shadow-md w-full md:w-1/3 lg:w-1/4">
          <div className="flex flex-col items-center">
            <div className="rounded-full w-24 h-24 bg-gray-300"></div>
            <h2 className="mt-2 font-bold">{student.fname} {student.lname}</h2>
            <span className="bg-green-100 text-green-600 text-sm px-3 py-1 rounded-lg">{student.idCode}</span>
          </div>
          <div className="mt-4">
            <h3 className="font-semibold">Details</h3>
            <p><strong>Enrollment No.:</strong> ID-{student.idCode}</p>
            <p><strong>Mobile No.:</strong> {student.mobNo}</p>
            <p><strong>Email ID:</strong> {student.email}</p>
            <p><strong>Address:</strong> {student.address}</p>
          </div>
        </div>

        <div className="bg-white p-6 rounded-lg shadow-md w-full md:w-2/3 lg:w-3/4 mt-6 md:mt-0 md:ml-6">
          <h2 className="font-bold text-lg border-b pb-2">Profile</h2>
          <div className="mt-4 space-y-3">
            <p><strong>Login ID:</strong> {student.email}</p>
            <p><strong>Student Name:</strong> {student.fname} {student.mname} {student.lname}</p>
            <p><strong>Date of Birth:</strong> {student.dob}</p>
            <p><strong>Aadhar No.:</strong> {student.adharNo}</p>
            <p><strong>Mobile No.:</strong> {student.mobNo}</p>
            <p><strong>Email ID:</strong> {student.email}</p>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Dashboard;
