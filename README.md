# BlueCare AgedCare - Website Project
------------------------------------------------------------------------------

## Latest Update
- fixed registration page


## 🌐 Pages Overview

### `index.php`
- Main landing page
- Includes navigation bar, hero section, and featured content
![image](https://github.com/user-attachments/assets/0c5831d6-fb78-4c07-99c1-5675a57f45db)
![image](https://github.com/user-attachments/assets/799c67f3-3813-4367-bfa7-1b8b4cfed31f)

### `about.html`
- Overview of the organisation's mission, history, and values
![image](https://github.com/user-attachments/assets/03c1c10e-6d81-48c3-a716-15b76cb51831)

### `services.html`
- Showcases key healthcare services offered
![image](https://github.com/user-attachments/assets/ce83d058-e163-4145-8f71-9c1f80265c81)

### `contact.html`
- Includes contact form and embedded Google Maps (Melbourne)
![image](https://github.com/user-attachments/assets/41cb2ec0-7a62-45a0-beac-c5412294abe1)

### `login.html`
- Login form for patients and staff
- Redirects to `dashboard.html` upon form submission
![image](https://github.com/user-attachments/assets/110db0f6-e9bb-41f2-b763-63acf6768e6e)

### `register.html`
- Acts as a gateway to select between **Patient** and **Staff** registration
- Includes options to:
  - Show patient form directly
  - Validate staff invite code
  - Generate staff username automatically from name & DOB
![image](https://github.com/user-attachments/assets/730e08d5-79af-466a-8f8e-17c2b3ffeda2)
![image](https://github.com/user-attachments/assets/48ec34f3-efe5-4162-8828-a1593ea0c633)
- ## staff register
  ![image](https://github.com/user-attachments/assets/e237f7d6-5a77-4ca6-a52d-46c2582253e0)
  ![image](https://github.com/user-attachments/assets/31c3ef16-514e-4560-9e86-97b7bde15f0c)

### `registered.html`
- Confirmation page shown after successful registration
- Auto-redirects to home page after 5 seconds
![image](https://github.com/user-attachments/assets/ce43092a-b56d-497a-8a3d-131d42225905)

----

## 👤 Registration Flow

### Patients:
1. Click "Normal User / Patient"
2. Fill out form with basic details
3. Submit → Redirects to `registered.html`

### Staff:
1. Click "Staff Member"
2. Enter invite code (e.g. `STAFF-2025`) **WILL NEED TO IMPLEMENT CODE GENERATION IN DASHBOARD RIGHT NOW ITS HARDCODED FOR STAFF REGISRATION**
3. Fill out form
4. Username is auto-generated from First Name + Last Name + Year
5. Submit → Redirects to `registered.html`


## 🔜 Future Enhancements
- Connect forms to a back-end (e.g. Node.js + MongoDB) **OR WHATEVER DATABASE OR HOSTING WE CAN USE**
- Role-based dashboards (staff vs patient)
- Invite code system managed via admin panel
- Email confirmations and password resets

