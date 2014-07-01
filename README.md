S.I.M.
======

Student Information Management System

Users are now able to access both the Admin Panel and Student Panel depending on their account type.

If you are wanting to test the system, it is recommended you manually add an admin account first using
phpMyAdmin and log in using that account. From there you can add a student account, and in the future
an instructor account.

In addition, a new table was added that contains the Students' information and is populated when
adding new students to the database. Currently there is no form validation for adding students,
but that will be added at a later point.

There's a new check added that prevents users with unauthorized access from viewing pages
such as the adminPanel when logged in as a student or instructor. Currently implementing into pages
as I go.

Objectives So Far:

- Add the ability to create new admins, instructors, and classes.
- Add the portion of the website for admins to view a list of all instructors, students, admins, and classes.
- Create the instructor panel.
- Add the class management system in the student panel.
- Add the section for students to check their grades in each class.
- Create the attendance section of the students panel.
- Add the ability for students to view all upcoming, ongoing, and late assignments.