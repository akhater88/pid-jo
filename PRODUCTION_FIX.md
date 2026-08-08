# Production Fix: Add Footer Settings

## Problem
The production site is showing a 500 error because the new footer settings (`footer_background_image` and `google_maps_url`) are missing from the database.

## Solution
Run the following command on your production server to add the missing settings:

```bash
php artisan settings:add-footer
```

## Step-by-Step Instructions

### 1. Connect to Your Production Server
SSH into your Cloudways server or use the Cloudways SSH terminal.

### 2. Navigate to Your Project Directory
```bash
cd /home/master/applications/[your-app-name]/public_html
```

### 3. Run the Command
```bash
php artisan settings:add-footer
```

You should see output like this:
```
Checking for footer settings...
✓ Added footer_background_image setting
✓ Added google_maps_url setting

Clearing caches...

✅ Footer settings added successfully!
You can now upload a footer background image and set Google Maps URL in Settings → Site Settings.
```

### 4. Verify the Fix
Visit your production website. The error should be gone!

## What This Command Does

1. Checks if `footer_background_image` setting exists
2. Checks if `google_maps_url` setting exists
3. Adds any missing settings to the database with default `null` values
4. Clears application cache
5. Refreshes the settings cache

## Alternative: Manual Database Insert

If you prefer to add the settings manually via database, run these SQL queries:

```sql
INSERT INTO `settings` (`group`, `name`, `locked`, `payload`, `created_at`, `updated_at`)
VALUES
    ('site', 'footer_background_image', 0, 'null', NOW(), NOW()),
    ('site', 'google_maps_url', 0, 'null', NOW(), NOW());
```

Then clear caches:
```bash
php artisan cache:clear
php artisan settings:discover
```

## After the Fix

Once the settings are added, you can:

1. Go to **Admin Panel → Settings → Site Settings**
2. Scroll to **Footer Settings** section
3. Upload a footer background image
4. Set your Google Maps location URL
5. Save

The footer background will be clickable and open your location on Google Maps!

---

**Note:** This is a one-time fix. Once the settings are added, they will persist in the database.
