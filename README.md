# katibehTahrir
باسلام. در ادامه فایل `readme.md` برای قالب وردپرس فروشگاه لوازم التحریر ارائه شده است:

---

# قالب فروشگاه لوازم التحریر

یک قالب وردپرس حرفه‌ای برای فروشگاه‌های لوازم التحریر که بر اساس Astra Pro ساخته شده و از ووکامرس و Advanced Custom Fields (ACF) پشتیبانی می‌کند.

## ویژگی‌های اصلی

- **طراحی واکنشگرا** - نمایش مناسب در تمام دستگاه‌ها
- **سازگاری کامل با ووکامرس** - مدیریت کامل محصولات و فروشگاه
- **استفاده از ACF** - ایجاد فیلدهای سفارشی برای محصولات و صفحات
- **بهینه‌سازی برای SEO** - ساختار بهینه برای موتورهای جستجو
- **سیستم ایمپورت محصولات** - امکان وارد کردن محصولات از وبسایت‌های دیگر

## افزونه‌های مورد نیاز

- **WooCommerce** - برای راه‌اندازی فروشگاه
- **Advanced Custom Fields PRO** - برای فیلدهای سفارشی
- **Astra Pro** - برای ساختار اصلی قالب

## نصب و راه‌اندازی

1. قالب را در پوشه `wp-content/themes/` آپلود کنید
2. از پیشخوان وردپرس، قالب را فعال کنید
3. افزونه‌های مورد نیاز را نصب و فعال کنید
4. از منوی **Tools > Import Products** برای وارد کردن محصولات استفاده کنید

## سیستم ایمپورت محصولات

این قالب شامل یک اسکریپت اختصاصی برای وارد کردن محصولات از وبسایت‌های دیگر می‌باشد.

### نحوه استفاده:

1. به منوی **Tools** در پیشخوان وردپرس مراجعه کنید
2. گزینه **Import Products** را انتخاب کنید
3. فایل داده یا لینک منبع را وارد کنید
4. فرآیند ایمپورت را شروع کنید

### پشتیبانی از فرمت‌ها:

- فایل‌های CSV
- داده‌های JSON
- ایمپورت از طریق API

## تنظیمات اولیه

پس از نصب، بخش‌های زیر را تنظیم کنید:

- اطلاعات فروشگاه در تنظیمات ووکامرس
- فیلدهای سفارشی ACF
- تنظیمات صفحه اصلی
- منوهای navigation

## پشتیبانی

برای پشتیبانی و راهنمایی می‌توانید با توسعه‌دهنده قالب تماس بگیرید.

---
بسیار خوب، توضیحات مربوط به عملکرد پوشه `import-products`:

---

### توضیحات پوشه import-products

این پوشه حاوی یک سیستم اختصاصی برای وارد کردن انبوه محصولات از فایل‌های اکسل به فروشگاه ووکامرس است.

**عملکرد اصلی:**

- فایل‌های اکسل حاوی اطلاعات محصولات را می‌خواند
- داده‌ها را اعتبارسنجی و پاکسازی می‌کند
- محصولات جدید را در ووکامرس ایجاد می‌کند
- محصولات موجود را به روزرسانی می‌نماید
- تصاویر محصولات را از آدرس‌های URL دانلود و ضمیمه می‌کند
- دسته‌بندی‌ها و برچسب‌ها را به صورت خودکار ایجاد می‌کند
- از محصولات ساده و متغیر پشتیبانی می‌کند

**فرآیند کار:**

1. کاربر فایل اکسل را آپلود می‌کند
2. سیستم داده‌ها را بررسی و خطاها را گزارش می‌دهد
3. محصولات به صورت گروهی یا تکی وارد می‌شوند
4. گزارش کامل از عملیات نمایش داده می‌شود

این سیستم برای انتقال محصولات از وبسایت‌های قدیمی یا وارد کردن محصولات از تامین‌کنندگان طراحی شده است.

---

### Description of import-products Folder

This folder contains a custom system for bulk importing products from Excel files into WooCommerce.

**Main Functions:**

- Reads Excel files containing product information
- Validates and cleanses data
- Creates new products in WooCommerce
- Updates existing products
- Downloads and attaches product images from URLs
- Automatically creates categories and tags
- Supports both simple and variable products

**Work Process:**

1. User uploads an Excel file
2. System checks data and reports errors
3. Products are imported in bulk or individually
4. Complete operation report is displayed

This system is designed for migrating products from old websites or importing products from suppliers.

# Stationery Store WordPress Theme

A professional WordPress theme for stationery stores built on Astra Pro with support for WooCommerce and Advanced Custom Fields (ACF).

## Key Features

- **Responsive Design** - Proper display on all devices
- **Full WooCommerce Compatibility** - Complete product and store management
- **ACF Integration** - Custom fields for products and pages
- **SEO Optimized** - Optimized structure for search engines
- **Product Import System** - Ability to import products from other websites

## Required Plugins

- **WooCommerce** - For store setup
- **Advanced Custom Fields PRO** - For custom fields
- **Astra Pro** - For theme core structure

## Installation

1. Upload the theme to `wp-content/themes/` directory
2. Activate the theme from WordPress admin panel
3. Install and activate required plugins
4. Use **Tools > Import Products** menu to import products

## Product Import System

This theme includes a custom script for importing products from other websites.

### How to Use:

1. Go to **Tools** menu in WordPress admin
2. Select **Import Products** option
3. Enter data file or source link
4. Start the import process

### Supported Formats:

- CSV files
- JSON data
- API import

## Initial Setup

After installation, configure the following sections:

- Store information in WooCommerce settings
- ACF custom fields
- Homepage settings
- Navigation menus

## Support

For support and guidance, please contact the theme developer.

---