CREATE DATABASE IF NOT EXISTS roomeasy_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE roomeasy_db;
CREATE TABLE IF NOT EXISTS bookings (
  booking_id INT AUTO_INCREMENT PRIMARY KEY,
  guest_name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  room_type VARCHAR(50) NOT NULL,
  check_in_date DATE NOT NULL,
  check_out_date DATE NOT NULL,
  status VARCHAR(20) NOT NULL DEFAULT 'Booked'
);
INSERT INTO bookings (guest_name,email,phone,room_type,check_in_date,check_out_date,status) VALUES
('John Doe','john@mail.com','01712345678','Deluxe','2025-12-01','2025-12-03','Booked'),
('Sarah Lee','sarah@gmail.com','0185554433','Suite','2025-12-05','2025-12-07','Booked'),
('Adam Khan','adam@yahoo.com','01677889900','Standard','2025-11-28','2025-12-01','Booked'),
('Maria Noor','maria@mail.com','01533442211','Deluxe','2025-12-10','2025-12-15','Cancelled'),
('Tom Jerry','tom@cartoon.com','01966223311','Standard','2025-11-30','2025-12-02','Booked');
