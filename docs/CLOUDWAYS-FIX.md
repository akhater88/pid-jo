# Cloudways tmpfile() Fix - SSH Method

## Step 1: SSH into your Cloudways server

```bash
ssh [username]@[your-server-ip] -p [port]
```

## Step 2: Find PHP-FPM configuration

```bash
# For PHP 8.2 (adjust version as needed)
sudo nano /etc/php/8.2/fpm/php.ini

# Or find it:
php --ini
```

## Step 3: Edit disable_functions

Find the line:
```
disable_functions = exec,passthru,shell_exec,system,proc_open,popen,curl_exec,curl_multi_exec,parse_ini_file,show_source,tmpfile
```

Remove `tmpfile` from the list:
```
disable_functions = exec,passthru,shell_exec,system,proc_open,popen,curl_exec,curl_multi_exec,parse_ini_file,show_source
```

## Step 4: Restart PHP-FPM

```bash
# For PHP 8.2
sudo systemctl restart php8.2-fpm

# Or
sudo service php8.2-fpm restart
```

## Step 5: Clear Application Cache

```bash
cd /home/1100125.cloudwaysapps.com/jqdrftndtz/public_html
php artisan config:clear
php artisan cache:clear
```

## Step 6: Test File Upload

Try uploading an image in the Filament admin panel.

---

## Alternative: Temporary Workaround (Not Recommended)

If you cannot enable `tmpfile()`, you can modify Livewire's temporary upload handling, but this is NOT recommended and may cause issues.

Contact Cloudways support instead - they typically enable this function within 1-2 hours.
