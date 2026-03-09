import React from 'react';
import { HashRouter as Router, Routes, Route } from 'react-router-dom';
import Preview from './pages/Preview';
import Login from './pages/Login';
import Signup from './pages/Signup';
import Dashboard from './pages/Dashboard';
import EditProfile from './pages/EditProfile';
import ExamForm from './pages/ExamForm';
import Payment from './pages/Payment';
import FeeReceipt from './pages/FeeReceipt';

function App() {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<Preview />} />
        <Route path="/login" element={<Login />} />
        <Route path="/signup" element={<Signup />} />
        <Route path="/dashboard" element={<Dashboard />} />
        <Route path="/edit-profile" element={<EditProfile />} />
        <Route path="/exam-form" element={<ExamForm />} />
        <Route path="/payment" element={<Payment />} />
        <Route path="/fee-receipt" element={<FeeReceipt />} />
      </Routes>
    </Router>
  );
}

export default App;
