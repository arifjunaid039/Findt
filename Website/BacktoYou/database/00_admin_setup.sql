-- ============================================
-- FindIT Admin Panel - DB Setup
-- Run this directly in phpMyAdmin / MySQL
-- ============================================

-- 1) Add role column to users (user | admin)
ALTER TABLE `users`
  ADD COLUMN `role` ENUM('user','admin') NOT NULL DEFAULT 'user' AFTER `status`;

-- 2) Add approval status to communities (admin approves new communities)
ALTER TABLE `communities`
  ADD COLUMN `status` ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending' AFTER `privacy`;

-- 3) Make yourself an admin (CHANGE THE EMAIL BELOW to your real login email)
UPDATE `users` SET `role` = 'admin' WHERE `email` = 'arifjunaid039@gmail.com';

-- 4) Existing communities already in DB — auto-approve them so nothing breaks
UPDATE `communities` SET `status` = 'approved' WHERE `status` = 'pending';
