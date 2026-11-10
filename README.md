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
| Derrick Okoro | [Reg. No.] | [e.g. Backend developer] |
| [Sharon Umutesi] | [Reg. No.] | [e.g. Frontend and UX] |
| [Name] | [Reg. No.] | [e.g. Research, documentation, pitch] |

**Team name:** [TEAM NAME]  **Contact:** [email / phone]

---

## 2. Problem Statement

Notices at UEAB reach students through several scattered channels: physical noticeboards, class announcements, group chats and email. This causes three problems:

1. **Missed information:** students overlook exam changes, deadlines and events.
2. **Unclear relevance:** students cannot easily tell which notices apply to their department or year.
3. **Outdated notices:** old notices remain visible and clutter the information that matters.

UEAB Smart Noticeboard gives the university one searchable place for official announcements.

### User Research Summary

We interviewed three campus users to understand the problem. [REPLACE WITH YOUR REAL INTERVIEWS.]

| # | Interviewee | Key pain point | Insight |
|---|-------------|----------------|---------|
| 1 | [Student, Year __, Department] | [What they said] | [What it means for the design] |
| 2 | [Lecturer / department staff] | [What they said] | [What it means for the design] |
| 3 | [Admin / Registrar office] | [What they said] | [What it means for the design] |

**Current channels and how they perform:** [2-3 sentences, e.g. which channels exist, who uses them, where they fail. Include one concrete example of a missed notice.]

---

## 3. Objectives

- Provide one central platform for university announcements.
- Let administrators create, edit, delete and publish notices (or save drafts).
- Let students view and read published notices.
- Organise notices into categories.
- Let students search notices by title or content.
- Improve access to university information.

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

> **Screenshots:** [Add 3-4 images in a `/screenshots` folder: student dashboard, notice view, admin dashboard, create-notice form.]

---

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
