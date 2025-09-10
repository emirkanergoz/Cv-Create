\# CV Project



This is a simple web-based CV form application built with HTML, PHP, MySQL, and Bootstrap. Users can submit their personal and professional information, which is saved to a database and displayed on a separate CV page.



\## Features



\- Responsive CV form using Bootstrap

\- PHP backend for data processing

\- MySQL database integration

\- Profile picture upload

\- Dynamic skill list with levels (via JavaScript)

\- CV display page with formatted output



\## Folder Structure
cv-project/
├── config.php # Database connection
├── cv-form.html # CV input form

├── cv\_save.php # Handles form submission and saves to DB

├── cv.php # Displays the saved CV

├── style.css # Custom styles

├── main.js # Skill input logic

├── uploads/ # Uploaded profile pictures

└── README.md # Project documentation





\## Setup Instructions

1\. Clone the repository:

&nbsp;  ```bash

&nbsp;  git clone https://github.com/yourusername/cv-project.git



2\.Create a MySQL database named cv\_project.



3\.Run the following SQL to create the required table:



CREATE TABLE cv\_bilgileri (

&nbsp;   id INT AUTO\_INCREMENT PRIMARY KEY,

&nbsp;   ad VARCHAR(100),

&nbsp;   soyad VARCHAR(100),

&nbsp;   email VARCHAR(100),

&nbsp;   telefon VARCHAR(50),

&nbsp;   dogum\_tarihi DATE,

&nbsp;   egitim TEXT,

&nbsp;   deneyim TEXT,

&nbsp;   yetenekler TEXT,

&nbsp;   hakkinda TEXT,

&nbsp;   foto VARCHAR(255)

);



4\.Update config.php with your database credentials.



5.Make sure the uploads/ folder exists and is writable.



6.Open cv-form.html in your browser to start using the form.



License

This project is open-source and free to use.

