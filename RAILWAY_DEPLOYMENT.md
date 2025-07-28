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
   - Choose your repository

3. **Add Database**
   - Click "Add Service"
   - Select "Database" → "MySQL"
   - Railway will automatically create database

### 3. Configure Environment Variables

Add these environment variables in Railway dashboard:

```env
APP_NAME=Kashish World
APP_ENV=production
APP_DEBUG=false
APP_KEY=[Generate using: php artisan key:generate --show]
```

Database variables (auto-configured by Railway):
- `MYSQLHOST`
- `MYSQLPORT` 
- `MYSQLDATABASE`
- `MYSQLUSER`
- `MYSQLPASSWORD`

### 4. Deploy!

Railway will automatically:
- Build your application
- Run migrations
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
