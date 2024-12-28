-- Base de données : Bibliothèque
CREATE DATABASE library;
USE library;

-- Table des utilisateurs
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'authenticated') DEFAULT '	',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des catégories de livres
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Table des livres
CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    category_id INT NOT NULL,
    cover_image VARCHAR(255), 
    summary TEXT,
    status ENUM('available', 'borrowed', 'reserved') DEFAULT 'available',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);
INSERT INTO books(title,author,category_id,cover_image,summary)
VALUES ("the king admin","moha",1,"https://placehold.co/400x600/000000/FFF","this is king bbooks");
INSERT INTO books(title,author,category_id,cover_image,summary)
VALUES ("cashvertising","yassin",1,"https://placehold.co/400x600/000000/FFF","marketing books");
UPDATE books SET title = "the king admin", author = "anas" WHERE id = 1;
SELECT * FROM books;
-- Table des emprunts
CREATE TABLE borrowings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    book_id INT NOT NULL,
    borrow_date DATE NOT NULL,
    due_date DATE NOT NULL,
    return_date DATE DEFAULT NULL,
   isAccepted ENUM('Accepted', 'Canceled', 'Pending') DEFAULT 'Pending',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
);
INSERT INTO categories(name) VALUES ("design");
SELECT * FROM categories;
DELETE FROM users WHERE id = 2;
INSERT INTO users (name,email, PASSWORD) VALUES ("anas","anas@gmail.com","12345678");
UPDATE users SET ROLE = "admin";