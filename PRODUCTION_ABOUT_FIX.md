# Fix Arabic About Page on Production

## Problem
The `/ar/about` page shows a 404 error on production because the Arabic slug is `"من-نحن"` but the code expects `"about"`.

## Solution

### Step 1: Deploy the Latest Code

First, push the latest changes to production:

```bash
git push origin main
```

Wait for Forge to auto-deploy (or manually deploy from Forge dashboard).

### Step 2: Run the Fix Command

Connect to your Cloudways server via SSH and run:

```bash
cd applications/jqdrftndtz/public_html
php artisan pages:fix-about-slug
```

**Expected Output:**
```
Searching for About page...
Found page: About Us (ID: 2)
Current Arabic slug: من-نحن
✓ Updated Arabic slug to: about

Clearing caches...

✅ About page slug fixed successfully!
Arabic page is now accessible at: /ar/about
```

### Step 3: Verify

Visit: https://phpstack-1100125-6532762.cloudwaysapps.com/ar/about

The page should now load correctly! ✅

---

## Alternative Methods

### Method 1: Via Admin Panel (No SSH Required)

1. Go to: https://phpstack-1100125-6532762.cloudwaysapps.com/admin
2. Navigate to **Pages**
3. Click on **About Us** page
4. Switch to **Arabic** tab
5. Change slug from `من-نحن` to `about`
6. Click **Save**
7. Go to **Application** → **Cache** → Clear cache

### Method 2: Direct Tinker Command

If you prefer to run it directly without deploying first:

```bash
cd applications/jqdrftndtz/public_html
php artisan tinker --execute="\$page = \App\Models\Page::find(2); \$page->setTranslation('slug', 'ar', 'about'); \$page->save(); echo 'Fixed!';"
php artisan cache:clear
```

---

## Why This Happened

The PageController searches for pages using:
```php
Page::query()->where('slug->' . app()->getLocale(), 'about')
```

This works fine in English (`slug->en = "about"`), but fails in Arabic because the Arabic slug was different (`slug->ar = "من-نحن"`).

The fix changes both slugs to use the same value: `"about"`.

---

**Need Help?**
- The command is safe to run multiple times
- It only updates the slug if it's not already correct
- All changes are logged to the console
