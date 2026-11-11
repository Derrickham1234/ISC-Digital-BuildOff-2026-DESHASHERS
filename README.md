# UEAB Smart Noticeboard

**A centralised digital notice platform for the University of Eastern Africa, Baraton**

**Theme:** Campus Problems: Notices and Communication (ISC Digital Build-Off 2026)
**Team:** DESHASHERS
**Status:** Working prototype
**Repository:** https://github.com/Derrickham1234/ISC-Digital-BuildOff-2026-DESHASHERS
**Live demo / demo video:** FILL: paste a link, or delete this line

---

## 1. Project Title and Team

| Name | Registration No. | Role |
| ---- | ---------------- | ---- |
| Derrick Okoro (**Team Leader**) | SOKODE2311 | Backend developer |
| Sharon Umutesi | SSHAUM2411 | Frontend and UX |
| Sheldon Kasera | SSHEKA2311 | Research, documentation, pitch |

Contact: sokode2311@ueab.ac.ke, sshaum2411@ueab.ac.ke, ssheka2311@ueab.ac.ke

---

## 2. Problem Statement and Research

Notices at UEAB reach students through scattered channels: physical notice boards, class announcements, WhatsApp groups and email. This causes three problems:

1. **Missed information:** students overlook exam changes, deadlines and events.
2. **Unclear relevance:** students cannot easily tell which notices apply to them.
3. **Late or buried notices:** announcements get lost among other messages or arrive too late.

### Method
- Online student survey: **43 responses** (10 to 11 November 2026) from four schools: Business (17), Education, Humanities and Social Sciences (10), Science and Technology (9), and Nursing and Health Sciences (7). Raw data: [`docs/research/survey_responses.csv`](docs/research/survey_responses.csv)
- Three stakeholder interviews. Notes: [`docs/research/interview_notes.md`](docs/research/interview_notes.md)

### Key survey findings
- **93%** (40 of 43) have missed an announcement at least once; **67%** (29 of 43) miss announcements "sometimes" or "frequently".
- Only **23%** (10 of 43) check university email several times a day.
- **88%** (38 of 43) attended a physical meeting or appointment they felt could have been a digital announcement.
- **98%** (42 of 43) said a centralised platform would be useful (32 Yes, 10 Maybe, 1 No).
- Most requested features: department-specific notices, urgent highlighting, academic-year targeting, notifications and clear deadlines.

### Interviews

| # | Interviewee | Key pain point | Insight |
|---|-------------|----------------|---------|
| 1 | Student, Year 4, School of Business | Important announcements get buried in WhatsApp groups. | Centralise announcements for easier access. |
| 2 | Lecturer / department staff | Repeating the same information across channels is time-consuming. | Provide one platform for publishing departmental announcements. |
| 3 | University administrator | Ensuring notices reach the intended audience is difficult. | Centralised publishing and clear notice visibility. |

### Limitations
Convenience sample; Business students make up 40% of responses.

---

## 3. Proposed Solution

UEAB Smart Noticeboard gives the university one searchable place for official announcements.

**Administrator**
- Secure login and dashboard
- Create, edit and delete notices
- Publish or save as draft
- Notice management statistics

**Student**
- Registration, login and dashboard
- View published notices and read individual notices
- Search notices by title or content

**Security**
- Password hashing, session-based authentication, role-based access control, prepared SQL statements, protected administrator pages

---

## 4. System Design

- **ERD:** [`database/ERD.md`](database/ERD.md)
- **Use case diagram:** [`docs/use_case.md`](docs/use_case.md)
- **Data flow diagram (level 0):** [`docs/dfd_level0.md`](docs/dfd_level0.md)
- **Wireframes:** [`docs/wireframes/`](docs/wireframes/)

**How a notice flows**

```
Administrator logs in -> creates notice (title, content, category, status)
   -> PHP validates input and saves it using prepared statements -> MySQL
Student logs in -> opens dashboard / searches
   -> PHP queries published notices -> results displayed
```

---

## 5. Technology Stack

| Layer | Technology |
| ----- | ---------- |
| Frontend | HTML, CSS, JavaScript |
| Backend | PHP |
| Database | MySQL |
| Tools | XAMPP, phpMyAdmin, VS Code, Git and GitHub |

---

## 6. Screenshots / Demo

| Page | Screenshot |
|------|------------|
| Login | ![Login](screenshots/01-login.png) |
| Student dashboard | ![Student dashboard](screenshots/02-student-dashboard.png) |
| Reading a notice | ![Notice](screenshots/03-notice-view.png) |
| Admin dashboard | ![Admin dashboard](screenshots/04-admin-dashboard.png) |
| Create notice | ![Create notice](screenshots/05-create-notice.png) |

---

## 7. How to Run the Project

**Requirements:** XAMPP (Apache and MySQL), a web browser.

1. Install XAMPP and start **Apache** and **MySQL** in the XAMPP control panel.
2. Download or clone this repository. Copy the whole folder into `C:\xampp\htdocs\` (for example `C:\xampp\htdocs\noticeboard`).
3. Open `http://localhost/phpmyadmin`. Click **New**, create a database named `FILL_DATABASE_NAME`, then open it, click **Import**, choose `database/ueab_smart_noticeboard.sql` and click **Go**.
4. Open `src/db.php` and confirm the settings (default XAMPP: host `localhost`, user `root`, empty password, database `FILL_DATABASE_NAME`).
5. Open `http://localhost/noticeboard/src/` in your browser.

**Demo accounts (testing only)**

| Role | Email / username | Password |
|------|------------------|----------|
| Administrator | FILL | FILL |
| Student | Register a new account on the register page | your choice |

---

## 8. Business Model Summary

Free for students; sustained by the University (ICT or Student Affairs) as an official communication tool, hosted on the university server or low-cost shared hosting. Adoption: pilot with one school and class representatives, departments publish official notices there first, BITSA promotion and QR codes on existing notice boards. Full detail: [`docs/Business_Model.pdf`](docs/Business_Model.pdf)

---

## 9. Testing and User Feedback

**Functional testing:** manually tested registration, login and logout, role-based access (a student cannot open admin pages), create, edit and delete notice, draft versus published, and search.

**User testing (at least two real users):**

| Tester | Role | What they said | What we changed |
|--------|------|----------------|-----------------|
| FILL | FILL | FILL | FILL |
| FILL | FILL | FILL | FILL |

---

## 10. Contributions

| Member | Contribution |
|--------|--------------|
| Derrick Okoro | Backend: PHP logic, database, authentication and security |
| Sharon Umutesi | Frontend: pages, styling, user experience |
| Sheldon Kasera | Survey and interviews, documentation, business model, pitch |

---

## 11. Future Improvements and Conclusion

Based on the survey, next we would build:
- Targeting notices by department and academic year
- An urgent or priority flag for important notices
- Deadlines and event dates on notices
- Notifications for new notices
- File attachments such as PDFs
- Filtering by category

**What we learned:** talking to students first showed that the real problem is scattered channels, not a lack of information. A small system that works end to end is more useful than a large one that does not.

---

## 12. Credits and Third-Party Tools

- XAMPP, PHP, MySQL (open source)
- FILL: list any templates, libraries, fonts, or AI-assisted tools you used (for example "AI assistant used for drafting documentation and diagrams"). Be honest: the guide requires every member to be able to explain everything in the project.

Licensed under the MIT License (see [`LICENSE`](LICENSE)).
