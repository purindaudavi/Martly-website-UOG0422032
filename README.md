

## 🛒 Multi-Vendor E-Commerce Marketplace

A full-stack web application built with Laravel that simulates a real-world multi-vendor marketplace.
The system supports **Customers, Vendors, and Admins**, each with dedicated dashboards and workflows.

---

## 🚀 Features

### 👤 Customer Features

* Browse products by category
* Advanced filtering (price range, rating, sorting)
* View product details, reviews, and stock availability
* Add to cart and checkout
* View order history and cancel orders (if not shipped)
* Leave reviews and ratings (edit/delete own reviews)

---

### 🏪 Vendor Features

* Vendor dashboard with:

  * Total products
  * Sales and profit tracking
  * Pending approvals
* Manage products:

  * Add new products
  * Edit product details and stock
  * Delete products
* Product approval workflow:

  * New/updated products require admin approval
* View sales history:

  * Orders containing vendor products
  * Revenue per order

---

### 🛠 Admin Features

* Dashboard analytics:

  * Users, products, sales, profit, reviews
* Product management:

  * Approve/reject vendor products
  * Edit/delete products
  * Add new products
* Deal management:

  * Apply discount percentages
  * Automatically calculate discounted prices
* User management:

  * Change roles (Customer / Vendor / Admin)
* Order management:

  * View all orders
  * Update order statuses
  * View detailed order information

---

## 🔐 Role-Based Access Control

* Customers → shopping & reviews
* Vendors → product & inventory management
* Admins → full system control

---

## 🔄 Business Logic Highlights

* Vendor products require **admin approval**
* Editing a product triggers **re-approval**
* Deals are applied using **percentage-based discounts**
* Stock is controlled only by vendors
* Orders follow lifecycle:
  `Pending → Shipped → Delivered / Cancelled`

---

## 🛠 Tech Stack

* **Backend:** Laravel (PHP)
* **Frontend:** Blade / Tailwind CSS
* **Database:** MySQL
* **Authentication:** Laravel Auth

---

## 📸 Screenshots

### Customer Interface

* Home, Products, Deals, Cart, Orders

### Vendor Dashboard

* Product management, sales tracking

### Admin Panel

* Analytics, users, products, orders, deals



---

## ⚙️ Installation

```bash
git clone https://github.com/your-username/your-repo.git
cd your-repo
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

---

## 💡 Future Improvements

* Payment integration (Stripe/PayPal)
* Notifications system
* Wishlist feature
* API version (React / mobile app)

---
