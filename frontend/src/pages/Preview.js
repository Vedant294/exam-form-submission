import React from 'react';

// Preview/Demo component showing the application features
function Preview() {
  return (
    <div className="min-h-screen bg-gradient-to-br from-blue-900 to-yellow-400 p-8">
      <div className="max-w-6xl mx-auto">
        <div className="bg-white rounded-lg shadow-2xl p-8">
          <div className="text-center mb-8">
            <h1 className="text-4xl font-bold text-gray-800 mb-2">
              KDK College Management System
            </h1>
            <p className="text-gray-600">Full-Stack Student Management Application</p>
          </div>

          <div className="grid md:grid-cols-2 gap-6 mb-8">
            <div className="bg-green-50 p-6 rounded-lg">
              <h3 className="text-xl font-bold text-green-700 mb-3">🎓 Features</h3>
              <ul className="space-y-2 text-gray-700">
                <li>✅ Student Authentication</li>
                <li>✅ Profile Management</li>
                <li>✅ Exam Form Submission</li>
                <li>✅ Payment Integration</li>
                <li>✅ Fee Receipt Management</li>
                <li>✅ Responsive Dashboard</li>
              </ul>
            </div>

            <div className="bg-blue-50 p-6 rounded-lg">
              <h3 className="text-xl font-bold text-blue-700 mb-3">🛠️ Tech Stack</h3>
              <ul className="space-y-2 text-gray-700">
                <li><strong>Backend:</strong> Java 17, Spring Boot</li>
                <li><strong>Frontend:</strong> React 18, Tailwind CSS</li>
                <li><strong>Database:</strong> MySQL</li>
                <li><strong>API:</strong> RESTful Architecture</li>
              </ul>
            </div>
          </div>

          <div className="bg-yellow-50 p-6 rounded-lg mb-6">
            <h3 className="text-xl font-bold text-yellow-700 mb-3">🔑 Test Credentials</h3>
            <div className="grid md:grid-cols-2 gap-4 text-gray-700">
              <div>
                <p><strong>Email:</strong> jack@gmail.com</p>
                <p><strong>Password:</strong> 201</p>
              </div>
              <div>
                <p><strong>Student ID:</strong> 201</p>
                <p><strong>Name:</strong> Jack Jason William</p>
              </div>
            </div>
          </div>

          <div className="text-center space-y-4">
            <a href="/login" className="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-8 rounded-lg transition">
              Go to Login
            </a>
            <p className="text-gray-600 text-sm">
              Make sure backend is running on port 8080
            </p>
          </div>

          <div className="mt-8 pt-6 border-t border-gray-200">
            <h3 className="text-lg font-bold text-gray-800 mb-3">📋 Setup Instructions</h3>
            <ol className="list-decimal list-inside space-y-2 text-gray-700">
              <li>Setup MySQL database: <code className="bg-gray-100 px-2 py-1 rounded">CREATE DATABASE vipuldb;</code></li>
              <li>Import schema: <code className="bg-gray-100 px-2 py-1 rounded">mysql -u root -p vipuldb &lt; database/schema.sql</code></li>
              <li>Start backend: <code className="bg-gray-100 px-2 py-1 rounded">mvn spring-boot:run</code></li>
              <li>Start frontend: <code className="bg-gray-100 px-2 py-1 rounded">npm start</code></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Preview;
