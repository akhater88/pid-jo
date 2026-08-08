# Fix Production Settings on Cloudways

## The Issue
Your production site is showing a 500 error because the new footer settings are missing from the database.

## Solution: Run Command via Cloudways SSH

### Option 1: Using Cloudways Web Terminal (Easiest)

1. **Log in to Cloudways Dashboard**
   - Go to: https://platform.cloudways.com

2. **Access SSH Terminal**
   - Click on your **Application** (phpstack-1100125-6532762)
   - Go to **Access Details** tab
   - Click on **Launch SSH Terminal** button
   - This will open a web-based terminal

3. **Navigate to Your App**
   ```bash
   cd applications/jqdrftndtz/public_html
   ```

4. **Run the Fix Command**
   ```bash
   php artisan settings:add-footer
   ```

5. **You should see:**
   ```
   Checking for footer settings...
   ✓ Added footer_background_image setting
   ✓ Added google_maps_url setting

   Clearing caches...

   ✅ Footer settings added successfully!
   ```

6. **Clear Application Cache**
   ```bash
   php artisan cache:clear
   php artisan view:clear
   ```

7. **Done!** Refresh your admin panel - it should work now!

---

### Option 2: Using SSH Client (Terminal/PuTTY)

1. **Get SSH Credentials**
   - In Cloudways Dashboard → Application → Access Details
   - Note: SSH Host, SSH Port, Username

2. **Connect via SSH**
   ```bash
   ssh jqdrftndtz@your-server-ip -p 22
   ```

3. **Navigate and Run**
   ```bash
   cd applications/jqdrftndtz/public_html
   php artisan settings:add-footer
   php artisan cache:clear
   php artisan view:clear
   ```

---

### Option 3: Direct Database Insert (If SSH doesn't work)

1. **Access Cloudways Database Manager**
   - Application → Access Details → Database Access
   - Click **Launch Database Manager** (phpMyAdmin)

2. **Select Your Database**
   - Usually named something like: `jqdrftndtz`

3. **Go to SQL Tab and Run This Query:**
   ```sql
   INSERT INTO `settings` (`group`, `name`, `locked`, `payload`, `created_at`, `updated_at`)
   VALUES
       ('site', 'footer_background_image', 0, 'null', NOW(), NOW()),
       ('site', 'google_maps_url', 0, 'null', NOW(), NOW());
   ```

4. **Clear Redis Cache (if using Redis)**
   - In Cloudways Dashboard → Application → Redis
   - Click **Flush Redis**

   OR via SSH:
   ```bash
   php artisan cache:clear
   php artisan settings:discover
   ```

---

## Verification

After running the fix:

1. **Visit Admin Panel**: https://phpstack-1100125-6532762.cloudwaysapps.com/admin/manage-site-settings
   - Should load without errors ✅

2. **Visit Frontend**: https://phpstack-1100125-6532762.cloudwaysapps.com/en
   - Should load without errors ✅

---

## Common Issues

### "Command not found: php"
Try using full path:
```bash
/usr/bin/php artisan settings:add-footer
```

### "Permission denied"
Make sure you're in the correct directory:
```bash
pwd
# Should show: /home/master/applications/jqdrftndtz/public_html
```

### Settings still not working?
Clear all caches:
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
php artisan settings:discover
```

---

## What This Does

The command adds two new settings to your database:
- `footer_background_image` → For uploading custom footer background
- `google_maps_url` → For making footer background clickable to open Google Maps

Both are set to `null` by default, so your site will work normally until you configure them.

---

**Need Help?**
- Cloudways Support Chat: Available 24/7
- Cloudways SSH Guide: https://support.cloudways.com/en/articles/5119703-how-to-use-ssh-on-cloudways
