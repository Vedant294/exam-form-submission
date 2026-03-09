import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import Navbar from '../components/Navbar';

function FeeReceipt() {
  const [student, setStudent] = useState(null);
  const navigate = useNavigate();

  useEffect(() => {
    const storedStudent = JSON.parse(localStorage.getItem('student'));
    if (!storedStudent) navigate('/login');
    else setStudent(storedStudent);
  }, [navigate]);

  return (
    <div className="bg-gray-100 min-h-screen">
      <Navbar student={student} />
      
      <div className="p-6 bg-gray-50 rounded-lg shadow-md m-6">
        <h2 className="text-lg font-semibold text-gray-700 mb-4">Admission Fee Receipt</h2>
        <div className="overflow-x-auto">
          <table className="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
            <thead>
              <tr className="bg-gray-200 text-gray-700 text-left">
                <th className="px-4 py-2 border">#</th>
                <th className="px-4 py-2 border">RECEIPT NO.</th>
                <th className="px-4 py-2 border">RECEIPT DATE</th>
                <th className="px-4 py-2 border">SESSION</th>
                <th className="px-4 py-2 border">YEAR</th>
                <th className="px-4 py-2 border">TUITION FEE</th>
                <th className="px-4 py-2 border">DEVELOPMENT FEE</th>
                <th className="px-4 py-2 border">OTHER FEE</th>
                <th className="px-4 py-2 border">TOTAL FEE</th>
              </tr>
            </thead>
            <tbody>
              <tr className="text-gray-700">
                <td className="px-4 py-2 border">1</td>
                <td className="px-4 py-2 border">2024-2025/TY/974</td>
                <td className="px-4 py-2 border">20-07-2024</td>
                <td className="px-4 py-2 border">2024</td>
                <td className="px-4 py-2 border">III Year</td>
                <td className="px-4 py-2 border">0.00</td>
                <td className="px-4 py-2 border">1000.00</td>
                <td className="px-4 py-2 border">550.00</td>
                <td className="px-4 py-2 border font-semibold">1550.00</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );
}

export default FeeReceipt;
