<div align="center">
  <img src="https://i.giphy.com/media/v1.Y2lkPTc5MGI3NjExbnd0dG5weTZtNTlzY2l1YzF4a2tmdzM0NnI1eDJwOG93M21oOGFwMSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/3o6MbpgyY90oJBd4Uo/giphy.gif" alt="Blood donation GIF" width="100%" height="250">
  <h1>Donor Management System 🩸</h1>
  <p>Welcome to the Donor Management System. This application is designed to manage and keep track of blood and plasma donors. It provides features such as adding new donors, searching for donors based on various criteria, and viewing detailed information about each donor.</p>

[![GitHub License](https://img.shields.io/badge/license-MIT-blue.svg)](https://opensource.org/licenses/MIT) [![PHP Version](https://img.shields.io/badge/php-%3E%3D%207.4-8892BF.svg)](https://www.php.net/) [![MySQL Version](https://img.shields.io/badge/mysql-%3E%3D%205.7-4479A1.svg)](https://www.mysql.com/) [![Composer](https://img.shields.io/badge/composer-2.0-885630.svg)](https://getcomposer.org/) [![Web Server](https://img.shields.io/badge/web%20server-Apache%20%2F%20Nginx-green.svg)](https://httpd.apache.org/)
</div>

## Table of Contents 📚

- [Getting Started](#getting-started-🚀)
- [Prerequisites](#prerequisites-📋)
- [Installation](#installation-⚙️)
- [Usage](#usage-💻)
- [Contributing](#contributing-🤝)
- [License](#license-📄)
- [Contact](#contact-📧)

## Getting Started 🚀

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites 📋

What things you need to install the software and how to install them:

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Composer
- A web server (like Apache or Nginx)

### Installation ⚙️

1. Clone the repo
   ```sh
   git clone https://github.com/chaima-bekhaouda/Donor-Management-System.git
   ```
2. Install PHP packages
   ```sh
   composer install
   ```
3. Create your `.env` file from the `.env.example` template and fill in your database credentials
4. Run the setup script to create the necessary tables and populate them with some data
   ```sh
   php scripts/setup.php
   ```
5. Point your web server to the `public` directory


## Usage 💻

After installation, you can start using the Donor Management System. Visit the login page in your web browser to get started.

Please note that this project does not include a registration feature as it is intended to be managed by administrators only. 

During the setup process, an administrator user is created for you to use the program:
```bash
Username: admin
Password: password
```
Ensure to change these credentials in a production environment to maintain the security of the system.

## Contributing 🤝

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

Please note that this project uses conventional commits. Make sure your commit messages adhere to the [Conventional Commits specification](https://www.conventionalcommits.org/).

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes following the Conventional Commits specification (`git commit -m 'feat: add AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License 📄

Distributed under the MIT License. See `LICENSE` for more information.

## Contact 📧

Chaima BEKHAOUDA - bekhaoudachaima@gmail.com
Project Link: [https://github.com/chaima-bekhaouda/Donor-Management-System](https://github.com/chaima-bekhaouda/Donor-Management-System)