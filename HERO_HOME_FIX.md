# Hero Home Block FileUpload Fix

## Problem
The hero-home block's FileUpload fields were storing file paths as arrays instead of strings, causing errors when trying to save pages in the admin panel.

**Error:** `Filament\Forms\Components\BaseFileUpload::Filament\Forms\Components\{closure}(): Argument #2 ($value) must be of type array, string given`

## Solution
A command has been created to convert the array-formatted file paths to strings in the database.

## Steps to Fix on Production

### Option 1: SSH Command (Recommended)
```bash
# SSH into your Cloudways server
ssh [your-ssh-details]

# Navigate to project directory
cd applications/[app-name]/public_html

# Run the fix command
php artisan pages:fix-hero-home-uploads
```

### Option 2: Cloudways Application Management
1. Log into Cloudways dashboard
2. Go to your application
3. Click "Application Management" → "Cron Job Management"
4. Add a one-time cron job:
   ```
   php /home/master/applications/[app-folder]/public_html/artisan pages:fix-hero-home-uploads
   ```
5. Set it to run once, then delete it after it executes

### Option 3: Laravel Forge (if using)
1. Go to your site in Forge
2. Click "Commands"
3. Run:
   ```
   php artisan pages:fix-hero-home-uploads
   ```

## What the Command Does
The command:
1. Loops through all pages in both English and Arabic
2. Finds hero-home blocks
3. Converts FileUpload fields from array format to string format:
   - `background_image`
   - `promo_1_image`
   - `promo_1_pdf`
   - `promo_2_image`
   - `promo_2_pdf`
4. Saves the updated page data
5. Clears all caches

## Verification
After running the command:
1. Try editing the Home page in admin panel (`/admin/pages/1/edit`)
2. Make a small change (or no change)
3. Click "Save"
4. It should save successfully without errors

## Notes
- This is a one-time fix
- The command is safe to run multiple times (it only fixes array values)
- No data will be lost - it only converts the format
- After this fix, all new file uploads will be stored correctly as strings

## If You Still Have Issues
If the error persists after running the command, you may need to:
1. Clear Filament cached components: `php artisan filament:clear-cached-components`
2. Clear Laravel cache: `php artisan cache:clear`
3. Clear views: `php artisan view:clear`
