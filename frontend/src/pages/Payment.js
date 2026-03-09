import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import Navbar from '../components/Navbar';

function Payment() {
  const [student, setStudent] = useState(null);
  const navigate = useNavigate();

  useEffect(() => {
    const storedStudent = JSON.parse(localStorage.getItem('student'));
    if (!storedStudent) navigate('/login');
    else setStudent(storedStudent);
  }, [navigate]);

  const handlePayment = () => {
    alert('Payment integration pending. Redirecting to fee receipt...');
    navigate('/fee-receipt');
  };

  return (
    <div className="bg-gray-100 min-h-screen">
      <Navbar student={student} />
      
      <div className="container mx-auto p-6 mt-10 max-w-lg bg-white shadow-md rounded-lg">
        <h2 className="text-2xl font-bold text-gray-700 text-center">Exam Fee Payment</h2>
        <p className="text-gray-600 text-center mt-2">Complete your payment</p>
        <div className="mt-6">
          <p className="text-lg font-semibold">Amount: <span className="text-green-600">₹1500</span></p>
        </div>
        <button 
          onClick={handlePayment}
          className="w-full bg-green-500 text-white py-2 mt-6 rounded-lg hover:bg-green-600 transition"
        >
          Proceed to Pay
        </button>
      </div>
    </div>
  );
}

export default Payment;
