# UEAB Smart Noticeboard

**A centralised digital notice platform for the University of Eastern Africa, Baraton**

**Theme:** Campus Problems: Notice Board / Communication (UEAB ISC Digital Build-Off 2026)
**Status:** Working prototype
**Repository:** [ADD GITHUB LINK]
**Demo video / live link (optional):** [ADD LINK]

---

## 1. Team

| Name | Registration No. | Role |
|------|------------------|------|
| Derrick Okoro | SOKODE2311 | Backend developer |
| Sharon Umutesi | SSHAUM2411 | Frontend and UX |
| Sheldon Kasera | SSHEKA2311 |  Research, documentation, pitch |

**Team name:** DESHASHERS  **Contact:** [sokode2311@ueab.ac.ke, sshaum2411@ueab.ac.ke, ssheka2311@ueab.ac.ke.]

---

## 2. Problem Statement

Notices at UEAB reach students through several scattered channels: physical noticeboards, class announcements, group chats and email. This causes three problems:

1. **Missed information:** students overlook exam changes, deadlines and events.
2. **Unclear relevance:** students cannot easily tell which notices apply to their department or year.
3. **Outdated notices:** old notices remain visible and clutter the information that matters.

UEAB Smart Noticeboard gives the university one searchable place for official announcements.
## 2. User Research Summary

We collected **42 student survey responses** and conducted three campus stakeholder interviews to understand challenges with existing university communication.

| # | Interviewee | Key Pain Point | Insight |
|---|---|---|---|
| 1 | Student, Year 4, School of Business | Important announcements get buried in WhatsApp groups. | Centralize announcements for easier access. |
| 2 | Lecturer / Department Staff | Repeatedly communicating the same information across different channels is time-consuming. | Provide a single platform for publishing and targeting departmental announcements. |
| 3 | University Administrator | Ensuring important announcements reach their intended audiences can be challenging. | Introduce centralized publishing, targeted distribution and clear notice visibility. |

**Current Channels and Their Performance:**

UEAB uses university email, WhatsApp groups, student representatives, lecturers and physical notice boards to communicate announcements. However, information is sometimes overlooked, delayed or scattered across these channels. In our survey, **64.3% of respondents sometimes or frequently miss important announcements**, while **97.6% expressed interest in or openness to a centralized digital platform**.

---

## 3. Objectives

1. **Centralize university announcements:** Provide one accessible digital platform for official announcements from different university departments.

2. **Simplify announcement management:** Enable authorized staff to create, categorize, prioritize and manage announcements targeted at specific departments and academic years.

3. **Improve student access to information:** Enable students to view, search and filter relevant announcements while easily identifying urgent and important notices.

## 4. Key Features

### Administrator
- Secure administrator login and dashboard
- Create, edit and delete notices
- Publish or save as draft
- Notice management statistics

### Student
- Registration, login and dashboard
- View published announcements and read individual notices
- Search notices by title or content

### Security
- Password hashing
- Session-based authentication
- Role-based access control
- Prepared SQL statements
- Protected administrator pages



## 5. Technical Architecture

| Layer | Technology | Purpose |
|-------|-----------|---------|
| Frontend | HTML, CSS, JavaScript | Pages and interactions |
| Backend | PHP | Server-side logic, authentication |
| Database | MySQL | Data storage |
| Environment | XAMPP, VS Code | Local development |

**How a notice flows:**

```
Administrator logs in -> creates notice (title, content, category, status)
   -> PHP validates input and saves it using prepared statements -> MySQL
Student logs in -> opens dashboard / searches
   -> PHP queries published notices -> results displayed
```

### Database Design

- **users:** administrator and student accounts, hashed passwords, roles
- **categories:** notice categories (Academic, Events, Examinations, etc.)
- **notices:** title, content, category, author (administrator), publication status

---

## 6. Setup and Installation

**Requirements:** XAMPP (Apache and MySQL), a web browser, Visual Studio Code (optional)

1. Install XAMPP and start **Apache** and **MySQL** in the control panel.
2. Copy the project folder to `C:\xampp\htdocs\`.
3. Open `http://localhost/phpmyadmin`, create a database named `[DATABASE NAME]`, and import `database/ueab_noticeboard.sql`.
4. Check the database settings in `config/db.php` (default XAMPP: host `localhost`, user `root`, empty password).
5. Create the administrator account: [EXPLAIN EXACTLY, e.g. run `admin/setup.php` once, or use the seeded login below].
6. Open `http://localhost/UEAB_Smart_Noticeboard/`.

**Demo credentials (testing only):**

| Role | Email / username | Password |
|------|------------------|----------|
| Administrator | [ADD] | [ADD] |
| Student | [ADD or "register a new account"] | [ADD] |

### Project Structure

```text
UEAB_Smart_Noticeboard/
├── admin/        Administrator pages
├── student/      Student pages
├── config/       Database configuration
├── css/          Stylesheets
├── js/           Client-side scripts
├── database/     SQL import file
├── docs/         Business model and pitch slides
├── index.php  login.php  register.php  logout.php
└── README.md
```

---

## 7. Testing

### Functional testing
The following functions were manually tested: student registration,
