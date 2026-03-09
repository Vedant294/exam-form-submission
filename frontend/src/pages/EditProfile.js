import React, { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import Navbar from '../components/Navbar';
import { studentService } from '../services/api';

function EditProfile() {
  const [student, setStudent] = useState(null);
  const [formData, setFormData] = useState({});
  const navigate = useNavigate();

  useEffect(() => {
    const storedStudent = JSON.parse(localStorage.getItem('student'));
    if (!storedStudent) {
      navigate('/login');
      return;
    }
    
    studentService.getProfile(storedStudent.idCode)
      .then(res => {
        setStudent(res.data.data);
        setFormData(res.data.data);
      })
      .catch(() => navigate('/login'));
  }, [navigate]);

  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      await studentService.updateProfile(student.idCode, formData);
      alert('Profile updated successfully!');
      navigate('/dashboard');
    } catch (err) {
      alert('Error updating profile');
    }
  };

  if (!student) return <div>Loading...</div>;

  return (
    <div className="bg-gray-100 min-h-screen">
      <Navbar student={student} />
      
      <div className="container mx-auto my-10 p-6 bg-white shadow-lg rounded-lg">
        <h2 className="text-2xl font-bold mb-5">Edit Profile</h2>
        
        <form onSubmit={handleSubmit} className="space-y-4">
          <div className="grid grid-cols-2 gap-4">
            <div>
              <label className="block text-gray-700">First Name</label>
              <input type="text" name="fname" value={formData.fname || ''} onChange={handleChange} className="w-full px-4 py-2 border rounded-lg" required />
            </div>
            <div>
              <label className="block text-gray-700">Middle Name</label>
              <input type="text" name="mname" value={formData.mname || ''} onChange={handleChange} className="w-full px-4 py-2 border rounded-lg" required />
            </div>
            <div>
              <label className="block text-gray-700">Last Name</label>
              <input type="text" name="lname" value={formData.lname || ''} onChange={handleChange} className="w-full px-4 py-2 border rounded-lg" required />
            </div>
            <div>
              <label className="block text-gray-700">Mobile No.</label>
              <input type="text" name="mobNo" value={formData.mobNo || ''} onChange={handleChange} className="w-full px-4 py-2 border rounded-lg" required />
            </div>
            <div>
              <label className="block text-gray-700">College Email ID</label>
              <input type="email" name="email" value={formData.email || ''} onChange={handleChange} className="w-full px-4 py-2 border rounded-lg" required />
            </div>
            <div>
              <label className="block text-gray-700">Aadhar No.</label>
              <input type="text" name="adharNo" value={formData.adharNo || ''} onChange={handleChange} className="w-full px-4 py-2 border rounded-lg" required />
            </div>
            <div>
              <label className="block text-gray-700">Date of Birth</label>
              <input type="date" name="dob" value={formData.dob || ''} onChange={handleChange} className="w-full px-4 py-2 border rounded-lg" required />
            </div>
            <div className="col-span-2">
              <label className="block text-gray-700">Address</label>
              <input type="text" name="address" value={formData.address || ''} onChange={handleChange} className="w-full px-4 py-2 border rounded-lg" required />
            </div>
          </div>
          
          <button type="submit" className="w-full bg-green-500 text-white py-2 rounded-lg">Update Profile</button>
        </form>
      </div>
    </div>
  );
}

export default EditProfile;
