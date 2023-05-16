# Azure Avenue - Laravel E-Commerce Store

Azure Avenue is a basic online store built with Laravel, serving as a comprehensive final project for my Laravel training. It showcases the fundamental features of an e-commerce platform, allowing users to browse and purchase products conveniently.

-   **Product Catalog**: Users can explore a wide range of products organized into categories. Each product listing provides details such as title, description, price, and images.
-   **User Registration and Authentication**: Users can create accounts and login. Authentication ensures secure access to purchased products.
-   **Shopping Cart**: Users can add products to their cart for future purchase. The cart dynamically calculates the total price, and users can adjust quantities or remove items.
-   **Checkout Process**: Customers can proceed to the checkout page to provide shipping and payment information. Integration with popular payment gateways ensures secure and seamless transactions.
-   **Search Functionality**: Users can search for products using keywords, making it easier to find specific items from the vast product catalog.
-   **Responsive Design**: The store is built with a mobile-friendly layout, ensuring a seamless shopping experience on various devices.

## Technologies Used

-   Laravel
-   PHP
-   MySQL
-   HTML
-   CSS
-   JavaScript
-   Tailwind CSS

## Installation and Setup

To get started with Azure Avenue, follow these steps to install and set up the project locally:

### Prerequisites

-   PHP (>=7.4)
-   Composer
-   MySQL
-   Node.js

### Step 1: Clone the Repository

Clone the Azure Avenue repository to your local machine using Git:

```
git clone https://github.com/haynakoban/azure-avenue-online-store.git
```

### Step 2: Install Dependencies

Navigate to the project's root directory and install the PHP and JavaScript dependencies using Composer and npm:

```
cd azure-avenue-online-store

# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### Step 3: Configure Environment Variables

Copy the .env.example file and rename it to .env. Update the necessary environment variables such as database connection details, mail settings, and other configurations. In particular, set the following variables for Google, GitHub, and PayPal integration:

```
cp .env.example .env
```

Open the .env file in a text editor and update the following variables with your own credentials:

```
GITHUB_CLIENT_ID=your_github_client_id
GITHUB_CLIENT_SECRET=your_github_client_secret

GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret

PAYPAL_CLIENT_ID=your_paypal_client_id
PAYPAL_CLIENT_SECRET=your_paypal_client_secret
PAYPAL_CURRENCY=USD
```

Replace **your_github_client_id** and **your_github_client_secret** with the corresponding values from your **GitHub** application setup. Similarly, replace **your_google_client_id**, **your_google_client_secret** with the values from your **Google** application setup. Finally, update **your_paypal_client_id** and **your_paypal_client_secret** with the credentials from your **PayPal** application setup. The **PAYPAL_CURRENCY** variable should be set to the **desired currency code**.

Save the .env file after making the necessary changes.

Remember to obtain the **client IDs and secrets** from the respective platforms **(GitHub, Google, and PayPal)** by creating applications or projects in their developer portals.

Once you've updated the environment variables, you can proceed with the remaining installation and setup steps.

### Step 4: Generate Application Key

Generate an application key for your Laravel application:

```
php artisan key:generate
```

### Step 5: Migrate and Seed the Database

Run the database migrations to create the required tables:

```
php artisan migrate
```

If you want to seed the database with sample data, you can run the database seeder:

```
php artisan db:seed
```

### Step 6: Compile Frontend Assets (optional)

If you made changes to the frontend assets and need to compile them, run the following command:

```
npm run watch
```

### Step 7: Serve the Application

You can use the built-in development server to run the application:

```
php artisan serve
```

The application will be available at **http://localhost:8000**.

Make sure to update the .env file with your desired configurations, such as the database connection details, mail settings, and any other required variables.

That's it! Azure Avenue is now installed and ready to be used locally. You can access it in your web browser and start exploring the features.

Feel free to customize the installation instructions based on your project's specific requirements.
