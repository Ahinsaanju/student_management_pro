# 🎓 StuDora - Student Management & LMS Portal

StuDora is a full-stack Laravel web application designed for managing student records, attendance, academic performance, and course-based learning materials with role-based access for Admins, Teachers, and Students.

---

##  Core Features

###  Admin Management
- Multi-tier Role-Based Access Control (Admin, Teacher, Student).
- Student, Teacher, and Course record management.
- System-wide data export in **CSV** and **PDF** formats.

###  Learning Management System (LMS)
- Dedicated Learning Materials portal categorized by Department and Course.
- Support for lecture slides, PDFs, and external resource URLs.

###  Digital Student ID
- Dynamic QR code generation using `simple-qrcode`.
- Printable Sri Lankan NIC-style horizontal ID card interface.

###  Academic & Attendance Tracking
- Dynamic AJAX-based student attendance marking per module.
- Exam marks entry and grade calculation.

---

##   Tech Stack

- **Backend:** Laravel (PHP 10.x), MySQL
- **Frontend:** Bootstrap 5, Blade Templates, JavaScript (AJAX)
- **Packages:** `simple-software-io/simple-qrcode`
