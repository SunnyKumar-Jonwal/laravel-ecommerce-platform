# Kashish World - E-Commerce Platform

A modern e-commerce platform built with Laravel featuring admin panel, product management, wishlist, cart, and order management.

## Features

- 🛍️ Modern e-commerce storefront
- 👑 Admin panel with comprehensive management tools
- 📱 Responsive design
- 🛒 Shopping cart and wishlist
- 📦 Order management
- 💳 Checkout process
- 📧 Contact form system
- 📄 Legal pages (Terms & Conditions, Privacy Policy)
- 👤 User authentication and profiles

## Tech Stack

- **Backend**: Laravel 10.x
- **Frontend**: Bootstrap 5, JavaScript
- **Database**: MySQL
- **Deployment**: Railway
- **Local Development**: PHP 8.1+, Composer, Node.js

## Local Development

### Prerequisites

- PHP 8.1 or higher
- Composer
- MySQL 5.7+ or 8.0+
- Node.js 16+ and npm
- Git

### Setup

1. **Clone the repository:**
   ```bash
   git clone <your-repo-url>
   cd e-commerce
   ```

2. **Install PHP dependencies:**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies:**
   ```bash
   npm install
   ```

4. **Environment configuration:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database in .env:**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=ecommerce_laravel
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations and seeders:**
   ```bash
   php artisan migrate --seed
   ```

7. **Create storage link:**
   ```bash
   php artisan storage:link
   ```

8. **Compile assets:**
   ```bash
   npm run dev
   ```

9. **Start the server:**
   ```bash
   php artisan serve
   ```

10. **Access the application:**
    - Frontend: http://localhost:8000
    - Admin Panel: http://localhost:8000/admin

## Deployment to Railway

### Quick Railway Deployment

1. **Push to GitHub:**
   ```bash
   git add .
   git commit -m "Ready for Railway deployment"
   git push origin main
   ```

2. **Deploy on Railway:**
   - Visit [railway.app](https://railway.app)
   - Sign in with GitHub
   - Click "New Project" → "Deploy from GitHub repo"
   - Select your repository

3. **Add MySQL Database:**
   - Click "Add Service" → "Database" → "MySQL"
   - Railway auto-configures database connection

4. **Configure Environment Variables:**
   - Go to your service settings
   - Add variables tab
   - Set `APP_KEY` (generate with: `php artisan key:generate --show`)

5. **Deploy!**
   - Railway automatically builds and deploys
   - Your app will be live at the provided Railway URL

### Detailed Guide

See `RAILWAY_DEPLOYMENT.md` for complete deployment instructions.

## Admin Panel

Access the admin panel at `/admin` with admin credentials.

### Default Admin User
- Email: admin@example.com
- Password: password
- **User Authentication**: Registration, login, profile management
- **Checkout Process**: Multi-step checkout with address management
- **Payment Integration**: Razorpay payment gateway
- **Order Tracking**: View order history and status
- **Wishlist**: Save favorite products
- **Product Reviews**: Rate and review products

### Admin Panel Features
- **Dashboard**: Sales overview, analytics, and quick stats
- **Product Management**: CRUD operations for products, categories, brands
- **Order Management**: Process orders, update status, manage inventory
- **User Management**: Customer accounts and roles management
- **Content Management**: Manage site content and settings
- **Reports**: Sales reports, inventory reports, customer analytics

### Technical Features
- **Responsive Design**: Mobile-first Bootstrap UI
- **Role-based Access Control**: Using Spatie Laravel Permission
- **Image Management**: Intervention/Image for product images
- **DataTables**: Advanced admin tables with sorting and filtering
- **Security**: CSRF protection, input validation, secure authentication
- **Database**: Optimized MySQL with proper indexing
- **File Storage**: Laravel storage with public disk linking

## Technology Stack

- **Backend**: Laravel 10
- **Frontend**: Bootstrap 5, jQuery
- **Database**: MySQL
- **Payment**: Razorpay
- **Image Processing**: Intervention/Image
- **Permissions**: Spatie Laravel Permission
- **DataTables**: Yajra Laravel DataTables

## Installation

### Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL 5.7+ or 8.0+
- Node.js and npm

### Quick Setup (Windows)
1. Clone the repository
2. Run the setup script:
   ```bash
   setup.bat
   ```

### Manual Setup
1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd e-commerce
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database in .env**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=ecommerce_db
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Configure Razorpay (for payments)**
   ```env
   RAZORPAY_KEY_ID=your_razorpay_key_id
   RAZORPAY_KEY_SECRET=your_razorpay_key_secret
   ```

7. **Run migrations and seeders**
   ```bash
   php artisan migrate --seed
   ```

8. **Create storage link**
   ```bash
   php artisan storage:link
   ```

9. **Compile assets**
   ```bash
   npm run dev
   ```

10. **Start the server**
    ```bash
    php artisan serve
    ```

## Default Login Credentials

After running the seeders, you can use these credentials:

**Admin Account:**
- Email: admin@example.com
- Password: password

**Customer Account:**
- Email: customer@example.com
- Password: password

## Configuration

### Payment Gateway
Update your `.env` file with Razorpay credentials:
```env
RAZORPAY_KEY_ID=your_key_id
RAZORPAY_KEY_SECRET=your_key_secret
```

### Mail Configuration
Configure mail settings for order notifications:
```env
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourstore.com
MAIL_FROM_NAME="Your Store"
```

## Usage

### Customer Flow
1. Browse products on the homepage
2. Add products to cart
3. Proceed to checkout
4. Enter shipping address
5. Complete payment via Razorpay
6. Receive order confirmation

### Admin Flow
1. Login to admin panel at `/admin`
2. Manage products, categories, and brands
3. Process customer orders
4. View analytics and reports
5. Manage user accounts and permissions

## API Endpoints

The application includes API endpoints for:
- Product catalog
- Cart management
- Order processing
- User authentication

Documentation available at `/api/documentation` (if API docs are implemented)

## Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## Security

- All forms include CSRF protection
- User input is validated and sanitized
- Passwords are hashed using Laravel's bcrypt
- Payment processing uses secure Razorpay integration
- File uploads are validated and secured

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support
feature/remaining-components
For support, email support@kashishworld.com or create an issue in the repository.

### Common Issues and Solutions

#### Local Development Issues

**Issue: "No application encryption key has been specified"**
- **Solution**: Run `php artisan key:generate`

**Issue: "Storage link missing"**
- **Solution**: Run `php artisan storage:link`

**Issue: "Database connection failed"**
- **Solution**: Check your database credentials in `.env` file
- Ensure MySQL service is running

**Issue: "Permission denied" errors**
- **Solution**: Fix storage permissions:
  ```bash
  chmod -R 775 storage bootstrap/cache
  ```

**Issue: "npm build fails"**
- **Solution**: Clear npm cache and reinstall:
  ```bash
  npm cache clean --force
  npm install
  npm run dev
  ```

#### Railway Deployment Issues

**Issue: "Build fails on Railway"**
- **Solution**: Check build logs in Railway dashboard
- Ensure `composer.json` and `package.json` are valid
- Verify all required environment variables are set

**Issue: "Database connection fails on Railway"**
- **Solution**: Verify Railway MySQL service is running
- Check environment variables match Railway database credentials

**Issue: "500 Internal Server Error"**
- **Solution**: Set `APP_DEBUG=true` temporarily to see detailed errors
- Check Railway application logs
- Ensure `APP_KEY` is set

#### Development Tips

1. **Test locally first:**
   ```bash
   php artisan serve
   ```

2. **Clear Laravel caches:**
   ```bash
   php artisan cache:clear
   php artisan config:clear
   php artisan route:clear
   php artisan view:clear
   ```

3. **Run migrations:**
   ```bash
   php artisan migrate
   php artisan migrate --seed
   ```

4. **Check application status:**
   ```bash
   php artisan about
   ```
=======
For support, email sunnyjonwal76@gmail.com or create an issue in the repository.
main
