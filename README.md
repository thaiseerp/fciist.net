FCIIST - The online food coupon booking system of IIST Mess

FCIIST.NET is web app created for IIST Mess, for online food coupon booking (Auxiliary Coupons for B.Tech).

This web app is based on CodeIgniter an open source application framework for PhP

User authentication system is based on Ben Edmunds' Ion Auth for CodeIgniter, all tables required are in fciist.sql

Default username/email for admin is 'admin@admin.com' and password: password

## cron.php file
This file @ root is for clearing the booking every day beofore booking. Keep it behind the publichtml and run a cron job on that every day before booking starts.

## fciist.sql
This file contains all tables required for database.
