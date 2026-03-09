import axios from 'axios';

const API_BASE_URL = process.env.REACT_APP_API_URL || 'http://localhost:8080/api';

const api = axios.create({
  baseURL: API_BASE_URL,
  headers: {
    'Content-Type': 'application/json',
  },
});

// Demo mode - mock data when backend is not available
const DEMO_MODE = true;

const mockStudent = {
  idCode: 201,
  fname: 'Jack',
  mname: 'Jason',
  lname: 'William',
  mobNo: 1234567894,
  email: 'jack@gmail.com',
  adharNo: 123456789012,
  dob: '2003-05-15',
  address: 'Nagpur',
  password: '201',
  dateReg: '2025-02-19',
  profilePhoto: null
};

export const authService = {
  login: async (credentials) => {
    if (DEMO_MODE) {
      // Mock login for demo
      if (credentials.email === 'jack@gmail.com' && credentials.password === '201') {
        return {
          data: {
            success: true,
            message: 'Login successful',
            data: mockStudent
          }
        };
      }
      throw new Error('Invalid credentials');
    }
    return api.post('/auth/login', credentials);
  },
  signup: async (data) => {
    if (DEMO_MODE) {
      return {
        data: {
          success: true,
          message: 'Registration successful',
          data: { ...mockStudent, ...data }
        }
      };
    }
    return api.post('/auth/signup', data);
  },
};

export const studentService = {
  getProfile: async (idCode) => {
    if (DEMO_MODE) {
      return {
        data: {
          success: true,
          message: 'Student found',
          data: mockStudent
        }
      };
    }
    return api.get(`/students/${idCode}`);
  },
  updateProfile: async (idCode, data) => {
    if (DEMO_MODE) {
      return {
        data: {
          success: true,
          message: 'Profile updated',
          data: { ...mockStudent, ...data }
        }
      };
    }
    return api.put(`/students/${idCode}`, data);
  },
};

export const examService = {
  submitExam: async (data) => {
    if (DEMO_MODE) {
      return {
        data: {
          success: true,
          message: 'Exam selection created',
          data: { id: 201, ...data, createdAt: new Date() }
        }
      };
    }
    return api.post('/exams', data);
  },
  getAllExams: () => {
    if (DEMO_MODE) {
      return Promise.resolve({
        data: [
          {
            id: 201,
            branch: 'cse',
            semester: '7',
            subjects: 'Cryptography and Network Security, Cryptography and Network Security (Lab)',
            elective: 'JAVA Programming',
            createdAt: '2025-02-20T16:07:37'
          }
        ]
      });
    }
    return api.get('/exams');
  },
};

export default api;
