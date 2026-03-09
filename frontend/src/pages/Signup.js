import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { authService } from '../services/api';

function Signup() {
  const [formData, setFormData] = useState({
    idCode: '', fname: '', mname: '', lname: '', mobNo: '',
    email: '', adharNo: '', dob: '', address: '', password: '', confirmPassword: ''
  });
  const [error, setError] = useState('');
  const navigate = useNavigate();

  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (formData.password !== formData.confirmPassword) {
      setError('Passwords do not match');
      return;
    }
    try {
      const response = await authService.signup(formData);
      if (response.data.success) {
        alert('Registration successful!');
        navigate('/login');
      }
    } catch (err) {
      setError(err.response?.data?.message || 'Registration failed');
    }
  };

  return (
    <div className="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-900 to-yellow-400">
      <div className="w-full max-w-3xl bg-white rounded-lg shadow-lg p-8">
        <h2 className="text-3xl font-bold text-center text-gray-800 mb-2">Create a Student Account</h2>
        <p className="text-center text-gray-500 mb-6 uppercase font-semibold">KDK COLLEGE OF ENGINEERING NAGPUR</p>

        {error && <div className="bg-red-100 text-red-700 p-2 rounded mb-4">{error}</div>}

        <form onSubmit={handleSubmit} className="space-y-5">
          <div className="grid grid-cols-2 gap-4">
            <input type="text" name="fname" placeholder="First Name" onChange={handleChange} className="w-full px-4 py-3 border rounded-lg" required />
            <input type="text" name="mname" placeholder="Middle Name" onChange={handleChange} className="w-full px-4 py-3 border rounded-lg" required />
            <input type="text" name="lname" placeholder="Last Name" onChange={handleChange} className="w-full px-4 py-3 border rounded-lg" required />
            <input type="number" name="idCode" placeholder="ID Code" onChange={handleChange} className="w-full px-4 py-3 border rounded-lg" required />
            <input type="tel" name="mobNo" placeholder="Mobile No." onChange={handleChange} className="w-full px-4 py-3 border rounded-lg" required />
            <input type="email" name="email" placeholder="College Email ID" onChange={handleChange} className="w-full px-4 py-3 border rounded-lg" required />
            <input type="text" name="adharNo" placeholder="Aadhar No." onChange={handleChange} className="w-full px-4 py-3 border rounded-lg" required />
            <input type="date" name="dob" onChange={handleChange} className="w-full px-4 py-3 border rounded-lg" required />
            <input type="text" name="address" placeholder="Address" onChange={handleChange} className="col-span-2 w-full px-4 py-3 border rounded-lg" required />
            <input type="password" name="password" placeholder="Password" onChange={handleChange} className="w-full px-4 py-3 border rounded-lg" required />
            <input type="password" name="confirmPassword" placeholder="Confirm Password" onChange={handleChange} className="w-full px-4 py-3 border rounded-lg" required />
          </div>
          <button type="submit" className="w-full bg-gradient-to-r from-green-400 to-blue-500 hover:from-green-500 hover:to-blue-600 text-white font-bold py-3 px-4 rounded-lg">
            Sign Up
          </button>
        </form>

        <div className="flex items-center my-4">
          <hr className="flex-grow border-t border-gray-300" />
          <span className="mx-3 text-gray-500 text-sm">OR</span>
          <hr className="flex-grow border-t border-gray-300" />
        </div>

        <Link to="/login">
          <button className="w-full bg-gradient-to-r from-green-400 to-blue-500 hover:from-green-500 hover:to-blue-600 text-white font-bold py-3 px-4 rounded-lg">
            Login
          </button>
        </Link>
      </div>
    </div>
  );
}

export default Signup;
