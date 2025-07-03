![Project Banner](ProjectBanner.png)
<p align="center">
  <img src="Project Banner.png" alt="Project Banner" width="100%">
</p>

# Secure Login and OTP Verification System using PHP and MySQL
## Features
- User login authentication
- OTP generation and SMS delivery
- OTP expiration after 5 minutes
- MySQL database logging of OTPs
- Dashboard access only after OTP verification
- Works on Replit, XAMPP, or local server

  
## Technologies Used
- PHP 8
- MySQL
- HTML/CSS
- Fast2SMS API
- Replit (for online deployment)
- phpMyAdmin / MySQL Workbench

## Database Tables

### users
- id (INT, PK)
- username (VARCHAR)
- password (VARCHAR)

### otp_logs
- id (INT, PK)
- username (VARCHAR)
- mobile (VARCHAR)
- otp (VARCHAR)
- verified (BOOLEAN)
- created_at (TIMESTAMP)
- expires_at (DATETIME)

## Credits
- [Fast2SMS](https://www.fast2sms.com/) for SMS API
- PHP documentation
- MySQL documentation
