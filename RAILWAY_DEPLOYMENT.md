# Railway Deployment Guide for Kashish World

## Quick Deployment Steps

### 1. Prepare Your Repository
- Ensure all code is committed to Git
- Push to GitHub/GitLab

### 2. Deploy to Railway

1. **Go to Railway**
   - Visit [railway.app](https://railway.app)
   - Sign in with GitHub

2. **Create New Project**
   - Click "New Project"
   - Select "Deploy from GitHub repo"
   - Choose your repository: `laravel-ecommerce-platform`
   - Select branch: `feature/remaining-components`

3. **Add Database**
   - Click "Add Service" 
   - Select "Database" → "MySQL"
   - Railway will automatically create database and set environment variables

### 3. Configure Environment Variables

Railway auto-configures database variables, but you need to add:

**Required Variables:**
```env
APP_NAME=Kashish World
APP_ENV=production
APP_DEBUG=false
APP_KEY=[Click "Generate" or use: php artisan key:generate --show]
APP_URL=[Will be auto-set by Railway]
```

**Database variables (auto-configured by Railway):**
- `MYSQLHOST`
- `MYSQLPORT` 
- `MYSQLDATABASE`
- `MYSQLUSER`
- `MYSQLPASSWORD`

### 4. Fix Build Issues

If build fails with Nixpacks error:
1. Ensure `nixpacks.toml` is deleted (Railway auto-detects Laravel)
2. Make sure `package.json` has valid JSON syntax
3. Check that `composer.json` is valid

### 5. Deploy!

Railway will automatically:
- Detect Laravel project
- Install PHP dependencies 
- Install Node dependencies and build assets
- Run migrations (add manually if needed)
- Deploy to a public URL

## Custom Domain (Optional)

1. Go to your service settings
2. Click "Domains"
3. Add your custom domain
4. Update DNS records as shown

## Database Access

Railway provides a database URL in this format:
```
mysql://user:password@host:port/database
```

## Troubleshooting

### Build Fails
- Check build logs in Railway dashboard
- Ensure `composer.json` and `package.json` are valid

### Database Connection Issues
- Verify environment variables are set
- Check if database service is running

### 500 Errors
- Set `APP_DEBUG=true` temporarily to see errors
- Check application logs

## Local Testing

Before deploying, test locally:
```bash
composer install
npm install
npm run build
php artisan serve
```

## Support

- Railway Docs: https://docs.railway.app
- Laravel Docs: https://laravel.com/docs
