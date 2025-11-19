# Deployment Checklist

Use this checklist to ensure a smooth deployment process.

## Pre-Deployment

### Environment Setup
- [ ] Server has PHP 8.2 or 8.3 installed
- [ ] Required PHP extensions installed (mysql, xml, mbstring, curl, zip, gd, bcmath)
- [ ] Composer installed globally
- [ ] Node.js and npm installed
- [ ] Database server (MySQL/PostgreSQL) installed and running
- [ ] Web server (Nginx/Apache) installed and configured
- [ ] SSL certificate obtained and ready

### Application Configuration
- [ ] Repository cloned to server
- [ ] `.env` file created from `.env.example`
- [ ] All environment variables configured:
  - [ ] `APP_NAME` set
  - [ ] `APP_ENV=production`
  - [ ] `APP_DEBUG=false`
  - [ ] `APP_URL` set to production domain
  - [ ] `APP_KEY` generated
  - [ ] Database credentials configured
  - [ ] Razorpay production keys configured
  - [ ] MSG91 production credentials configured
  - [ ] Mail server configured
  - [ ] Session and cache drivers configured

### Security
- [ ] `.env` file permissions set (not world-readable)
- [ ] Storage directory permissions set (775)
- [ ] Bootstrap cache directory permissions set (775)
- [ ] `.env` file not accessible via web server
- [ ] Production API keys used (not test keys)

## Deployment Steps

### Initial Setup
- [ ] Run `composer install --no-dev --optimize-autoloader`
- [ ] Run `npm ci --production=false`
- [ ] Run `npm run build`
- [ ] Run `php artisan key:generate` (if not already done)
- [ ] Run `php artisan migrate --force`
- [ ] Run database seeders (if needed):
  - [ ] `php artisan db:seed --class=RolePermissionSeeder`
  - [ ] `php artisan db:seed --class=PlanSeeder`
  - [ ] `php artisan db:seed --class=AdminUserSeeder`

### Optimization
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Run `php artisan view:cache`
- [ ] Verify cache files created in `bootstrap/cache/`

### Web Server Configuration
- [ ] Nginx/Apache virtual host configured
- [ ] Document root set to `public` directory
- [ ] SSL certificate installed and configured
- [ ] HTTP to HTTPS redirect configured
- [ ] Web server restarted and tested

### Background Services
- [ ] Queue worker configured (Supervisor or systemd)
- [ ] Queue worker started and running
- [ ] Cron job configured for Laravel scheduler
- [ ] Cron job active

## Post-Deployment Verification

### Functionality Tests
- [ ] Homepage loads correctly
- [ ] Admin login page accessible (`/admin/login`)
- [ ] Customer login page accessible (`/customer/login`)
- [ ] Admin can log in successfully
- [ ] Customer can register and log in
- [ ] OTP verification works (if MSG91 configured)
- [ ] Payment flow works (test with Razorpay test mode first)
- [ ] Plans display correctly
- [ ] Subscription creation works
- [ ] Static assets (CSS/JS) load correctly

### Performance Checks
- [ ] Page load times acceptable
- [ ] Assets are minified and optimized
- [ ] Database queries optimized
- [ ] Cache working correctly

### Security Verification
- [ ] HTTPS enforced
- [ ] Debug mode disabled (`APP_DEBUG=false`)
- [ ] Error pages don't expose sensitive information
- [ ] `.env` file not accessible via URL
- [ ] Storage files not directly accessible
- [ ] CSRF protection working

### Monitoring Setup
- [ ] Log files accessible and monitored
- [ ] Error logging configured
- [ ] Queue worker logs monitored
- [ ] Database backup schedule configured

## Update Deployment Checklist

When updating the application:

- [ ] Backup database before update
- [ ] Pull latest code from repository
- [ ] Run `composer install --no-dev --optimize-autoloader`
- [ ] Run `npm ci --production=false`
- [ ] Run `npm run build`
- [ ] Run `php artisan migrate --force`
- [ ] Clear caches: `php artisan config:clear`, `route:clear`, `view:clear`
- [ ] Rebuild caches: `php artisan config:cache`, `route:cache`, `view:cache`
- [ ] Restart queue workers
- [ ] Verify application still works correctly
- [ ] Check error logs for any issues

## Rollback Plan

If deployment fails:

- [ ] Restore previous code version
- [ ] Restore database backup (if migrations caused issues)
- [ ] Clear all caches
- [ ] Restart web server
- [ ] Restart queue workers
- [ ] Verify application works

## Emergency Contacts

- Server Administrator: _______________
- Database Administrator: _______________
- Development Team: _______________
- Hosting Provider Support: _______________

## Notes

- Always test in staging environment first
- Keep database backups before major updates
- Monitor logs closely after deployment
- Have rollback plan ready

