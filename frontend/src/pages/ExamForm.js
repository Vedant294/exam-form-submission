import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import Navbar from '../components/Navbar';
import { examService } from '../services/api';

const branchSubjects = {
  cse: {
    7: ["Cryptography and Network Security", "Cryptography and Network Security (Lab)"],
  },
  it: {
    7: ["Cloud Computing", "AI & ML"],
  }
};

function ExamForm() {
  const [student, setStudent] = useState(null);
  const [branch, setBranch] = useState('');
  const [semester, setSemester] = useState('');
  const [subjects, setSubjects] = useState([]);
  const [selectedSubjects, setSelectedSubjects] = useState([]);
  const [elective, setElective] = useState('');
  const navigate = useNavigate();

  useEffect(() => {
    const storedStudent = JSON.parse(localStorage.getItem('student'));
    if (!storedStudent) navigate('/login');
    else setStudent(storedStudent);
  }, [navigate]);

  useEffect(() => {
    if (branch && semester && branchSubjects[branch]?.[semester]) {
      setSubjects(branchSubjects[branch][semester]);
    } else {
      setSubjects([]);
    }
  }, [branch, semester]);

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      await examService.submitExam({
        branch,
        semester,
        subjects: selectedSubjects.join(', '),
        elective
      });
      alert('Exam subjects saved successfully!');
      navigate('/dashboard');
    } catch (err) {
      alert('Error submitting exam form');
    }
  };

  return (
    <div className="bg-gray-100 min-h-screen">
      <Navbar student={student} />
      
      <div className="container mx-auto p-6 mt-6 bg-white shadow-lg rounded-lg max-w-2xl">
        <h2 className="text-2xl font-bold text-center text-gray-800">Exam Subject Selection</h2>
        
        <form onSubmit={handleSubmit} className="mt-4 space-y-4">
          <div>
            <label className="block text-gray-600 font-medium">Select Branch:</label>
            <select value={branch} onChange={(e) => setBranch(e.target.value)} className="w-full p-3 border rounded-lg" required>
              <option value="">-- Select Branch --</option>
              <option value="cse">Computer Science & Engineering</option>
              <option value="it">Information Technology</option>
            </select>
          </div>

          <div>
            <label className="block text-gray-600 font-medium">Select Semester:</label>
            <select value={semester} onChange={(e) => setSemester(e.target.value)} className="w-full p-3 border rounded-lg" required>
              <option value="">-- Select Semester --</option>
              {[1,2,3,4,5,6,7,8].map(s => <option key={s} value={s}>Semester {s}</option>)}
            </select>
          </div>

          {subjects.length > 0 && (
            <div>
              <label className="block text-gray-600 font-medium">Select Subjects:</label>
              <div className="space-y-2">
                {subjects.map((subject, i) => (
                  <div key={i}>
                    <input 
                      type="checkbox" 
                      value={subject}
                      onChange={(e) => {
                        if (e.target.checked) {
                          setSelectedSubjects([...selectedSubjects, subject]);
                        } else {
                          setSelectedSubjects(selectedSubjects.filter(s => s !== subject));
                        }
                      }}
                      className="mr-2"
                    />
                    {subject}
                  </div>
                ))}
              </div>
            </div>
          )}

          <button type="submit" className="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-lg">
            Submit
          </button>
        </form>
      </div>
    </div>
  );
}

export default ExamForm;
