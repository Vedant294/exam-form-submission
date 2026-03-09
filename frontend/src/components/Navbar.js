import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';

function Navbar({ student }) {
  const [menuOpen, setMenuOpen] = useState(false);
  const navigate = useNavigate();

  const handleLogout = () => {
    localStorage.removeItem('student');
    navigate('/login');
  };

  return (
    <nav className="bg-green-500 p-4 shadow-md">
      <div className="container mx-auto flex justify-between items-center">
        <div className="flex items-center space-x-4">
          <span className="text-white text-lg font-bold">KDK COLLEGE OF ENGINEERING, NAGPUR</span>
        </div>
        
        <div className="hidden md:flex space-x-6 text-white">
          <Link to="/dashboard" className="hover:underline">Dashboard</Link>
          <Link to="/payment" className="hover:underline">Pay Online</Link>
          <Link to="/fee-receipt" className="hover:underline">Fee Receipt</Link>
          <Link to="/exam-form" className="hover:underline">Form Submission</Link>
          <Link to="/edit-profile" className="hover:underline">Edit Profile</Link>
        </div>
        
        <div className="flex items-center space-x-4">
          <button 
            className="text-white focus:outline-none md:hidden" 
            onClick={() => setMenuOpen(!menuOpen)}
          >
            ☰
          </button>
          <div className="flex items-center space-x-2">
            {student && <span className="text-white">{student.idCode}</span>}
            <button 
              onClick={handleLogout}
              className="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition"
            >
              Logout
            </button>
          </div>
        </div>
      </div>
      
      {menuOpen && (
        <div className="md:hidden flex flex-col bg-green-500 p-4 space-y-2">
          <Link to="/dashboard" className="block text-white hover:underline">Dashboard</Link>
          <Link to="/payment" className="block text-white hover:underline">Pay Online</Link>
          <Link to="/fee-receipt" className="block text-white hover:underline">Fee Receipt</Link>
          <Link to="/exam-form" className="block text-white hover:underline">Form Submission</Link>
          <Link to="/edit-profile" className="block text-white hover:underline">Edit Profile</Link>
        </div>
      )}
    </nav>
  );
}

export default Navbar;
