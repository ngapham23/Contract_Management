-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 27, 2025 lúc 02:37 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cont_management`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contracts`
--

CREATE TABLE `contracts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contract_number` varchar(255) DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT (curdate() + interval 1 year),
  `amount` decimal(10,2) NOT NULL,
  `terms` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('pending','approved','rejected','completed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `contracts`
--

INSERT INTO `contracts` (`id`, `contract_number`, `customer_id`, `service_id`, `start_date`, `end_date`, `amount`, `terms`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'HD-1743081210', 1, 7, '2025-03-20', '2026-03-27', 414.00, NULL, NULL, 'pending', '2025-03-27 06:13:30', '2025-03-27 06:13:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contract_details`
--

CREATE TABLE `contract_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contract_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `unit_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) GENERATED ALWAYS AS (`quantity` * `unit_price`) STORED,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(6, '2025_03_25_150323_create_services_table', 2),
(7, '2025_03_25_150343_create_contracts_table', 2),
(8, '2025_03_25_150400_create_contract_details_table', 2),
(9, '2025_03_25_150414_create_payments_table', 2),
(10, '2025_03_25_150425_create_signatures_table', 2),
(11, '2025_03_26_152507_add_email_verified_at_to_users_table', 3),
(12, '2025_03_27_125654_update_services_status_column', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contract_id` bigint(20) UNSIGNED NOT NULL,
  `payment_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `transaction_reference` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('Hoạt Động','Tạm Ngừng') NOT NULL DEFAULT 'Hoạt Động',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `price`, `status`, `created_at`, `updated_at`) VALUES
(7, 'cc', '4', 414.00, 'Hoạt Động', '2025-03-27 05:58:07', '2025-03-27 05:58:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('12hhU2eNpj5UGV9FCbSK9lYwsN24sVBg9md1eYFY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', 'ZXlKcGRpSTZJbU5DVTBOWlNsSkdjak0xUld0TGRtTk9OamR6U1ZFOVBTSXNJblpoYkhWbElqb2lTRWRQZGtSbFl6ZzNPV3BXY21WbVR6SkpaU3N2Y25aTU1HMVdjMnBMY0Zkc2VsazFXbUpGV25kRmFYcFZXVmhPTkdkNVpYUm9SRXB4YURoNlJFUjNjVWxWVDNCV0wycHROVFpOVlRKdWJUZzBNbm8wUmtnNGVVNWhhelpTUkhSUk9FaHdNakkyYTNKYWIwZEtNVGQwWVVKM1dEWnJhRTFvYm1kUk5uRmFMMVpUVUVwdFlUSXZZekJ1YkRsdE9ETjFVVUZPYlZOdmJtVlhTMWhsV0hKdVIwaFhja3hyVmpJd05FbFNTRWRhYVZjNWJteDVPRVJhVnl0NWNuYzFaMmRFU25NNWR5OHpiUzlxU1RONmFUbFZZbk5WUzFGRFYySkJaalUzWlhwWmNVZzRhM0k0TlhSVmNVVjZaR3hYSzI5V1JUVldXamhhT1hSb1NFVjZWM1p2TW05blJGYzJjRmQ0YTNObmRHdERkMFJNV2t0V2N6aHdWekUxVDFoME5tTXphblFyUWpab2VFcEdNekF4U1M5b1ltZEZPRlJNTVd4U1pFdHlWVXNyV1RVd09IbGtOM05rYkdKWk5FVXhabEE1WVhOWlJXNUtSa1ZRY3pSeVZUQmxkbkpqUldoTlVGaFdiU3RyUFNJc0ltMWhZeUk2SW1GaE5qQXhOV0kxWXpjNVpEVTRaRFF6WkRNMllqTmhZV1JoWm1RMFlqRm1ObUk1WTJFek5HTTBNRGc0TlRaaU16TmtNbUppWVRsbFl6VTNNVGs1WmpNaUxDSjBZV2NpT2lJaWZRPT0=', 1743078788),
('EW3pfKVfcofjVgtwsIv8KJ9v2ZLguYEswjQ9BIul', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', 'ZXlKcGRpSTZJa3BOZVhwNlRXVnlWblp6TW10aksweElla3hrUVhjOVBTSXNJblpoYkhWbElqb2lRMU5XZDJKUFJrSkdkVmxRVlVzeE9ESmphbWN6VWsxRVdXRlJhR3RxVWpSM2Jsb3JiMVpvVUd0b0wxUjBaRTlMUW1kUVJVVjVWRXMzYzJvNGJtaFhaaXR5TkdWMk1YTnJUVVkyVlZnMGRrMVhkbHBIVld0TVIwZFRhMmRyUW5SelpHZDVRVVI0YjBONldrc3dUbmxDY201eWNDOHZWRFJrTlM5eGJFaFVPSHBhTHlzMlJrdHljVlV2VlV0R2NVRmhUREJyTldWNldGSnBjMWxhTUZrdk5rWjFaVTU0VTJGamJFTnZla3BxWkM5RE9UWjZla3BsWTFscVVHOVVObFF3TVd0eGRUWm9jbUV3VERkaWFrMWpLMWg0VWpKb1JteENiakZIYXk5d2VITnFhalp5YldNcllXVlZMMDE1TjFZdmRWZEVaMHBPU1RObFVEazRMekJsVHpGa1lqaG5OVzlHTWpoVVNtOXBkRWxRZEZoUmNVY3dVWGx4UzNZMVQwdEZZMHRHYzFGMVdHaGFPSEkzYmxKM2FHYzRaWHBrV1dwU01WcDBTWFpHYjJJNE5VbHRNM1p5TTNSMFVWTkJMM05xTVZGM1F6SlZjMmhtVFdWcFZ6a3hjVmhPVjJ0T09HeDVlbE00ZVdoTFJ6ZFBUVzVpTlhrMWRta3JUSFZRWTJJeGJXaFlWa2RDZFRoVFFVODVSV3RsTjB4NVdIbDJZMnR5Y1VwTk9VaFFTVzVFTm0xcWFWcDRSWFZyVlN0VFptcDJZalpPY1d0QlRpdHhaVmN5YTJWemFUbG5iM0ZxT1RsNlNrbzBSamMzYTNGd2RqSkxUMkpMU2pneFpEQmllU3RxV214eFFYUkVRbEIwZVRROUlpd2liV0ZqSWpvaU5XRm1ZalEzT0RSaE9HVmpPR1JsT0Rnd1l6WTBNelpsWWpJMVptRTFZelkwWXpNNE4yUTBZemsyWm1JM056WmhaR1kzTXprNE1EY3pPV0ZpTm1JNE1pSXNJblJoWnlJNklpSjk=', 1743081272),
('QSHwk9WP8awaVlwOIgwWVheHaRVjtIbG5kBIOdMm', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 Edg/134.0.0.0', 'ZXlKcGRpSTZJbEJZT1c1eVUwRmhiVE5IUTNCdWVXWmtiMHhyU0hjOVBTSXNJblpoYkhWbElqb2lkV1Z6T1ZSalMwWnRabmx2Vm0xeU16Y3JWWEpZYUc5NWRHWldOelpaTVRKNFIxbzFhMnM1U2tORk5EQndXVmhaTWt0bVQybzNhSEoyUVRjeVJWYzVieTloYmpWSmFHZDNaVTVhUkVWSFYxZElTa1JZT0V0NFZWQjRXRE5ITmpOV1JraHFLelpOUjBoaWJGWXZUamw2TkRGQ1JXNWxaM1ZsTkhCRlFrUk1SalExVG5oMlduWXhPR1ZQUTNONlYyTXJSMFpKYzJkeWEyUlJVWFpxTjNGcVJUQlNZVEJCVWpkMFZrczBPSFowZG5aRlFuaFJiR1kwTmxOSFZFWkpPVWcxYWpSRU9DOVJNaXREY3poU1dXZFpNME5DWnpndk9GUlpNMVY0YlV0NFRUWnliWGgzYkZjM1JraHRaVk5wSzB4bWVYTlhlR0ZKZVd0d1ZuTnZSMFJ5TlRObVZETXdkVEpJTlZCaWFqSnNlWFpMTUVwSVVYYzlQU0lzSW0xaFl5STZJbU13WTJZMlpEVTRZMlk1T1RReU0yRmxNV0l6TmpVeE9UYzJOakpqT0dJNU1qa3dZVE15WWpnMk1UazBObVk1TVRsaU5XSm1PR1l5TlRZellqbG1aVFFpTENKMFlXY2lPaUlpZlE9PQ==', 1743082459);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `signatures`
--

CREATE TABLE `signatures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contract_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `signature` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff','customer') NOT NULL DEFAULT 'customer',
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'ngapham23', 'nga@gmail.com', '$2y$12$XFmemR0XYHQunmyfSteA5u1c4IgRNfT3CX7sc9IbBSxbgEIRoWdyW', 'customer', NULL, NULL, '2025-03-25 08:44:28', '2025-03-25 08:44:28'),
(2, 'admin', 'admin@example.com', '$2y$12$mQagyG..d6vvQySuvmC3tOKhgaKINz3qDJT8aCYCJ4GPjsgVk8kky', 'admin', NULL, NULL, '2025-03-26 07:10:25', '2025-03-26 07:10:25');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contracts_contract_number_unique` (`contract_number`),
  ADD KEY `contracts_customer_id_foreign` (`customer_id`),
  ADD KEY `contracts_service_id_foreign` (`service_id`);

--
-- Chỉ mục cho bảng `contract_details`
--
ALTER TABLE `contract_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contract_details_contract_id_foreign` (`contract_id`),
  ADD KEY `contract_details_service_id_foreign` (`service_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_contract_id_foreign` (`contract_id`);

--
-- Chỉ mục cho bảng `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `signatures`
--
ALTER TABLE `signatures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `signatures_contract_id_foreign` (`contract_id`),
  ADD KEY `signatures_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `contract_details`
--
ALTER TABLE `contract_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `signatures`
--
ALTER TABLE `signatures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `contracts`
--
ALTER TABLE `contracts`
  ADD CONSTRAINT `contracts_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contracts_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `contract_details`
--
ALTER TABLE `contract_details`
  ADD CONSTRAINT `contract_details_contract_id_foreign` FOREIGN KEY (`contract_id`) REFERENCES `contracts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `contract_details_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_contract_id_foreign` FOREIGN KEY (`contract_id`) REFERENCES `contracts` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `signatures`
--
ALTER TABLE `signatures`
  ADD CONSTRAINT `signatures_contract_id_foreign` FOREIGN KEY (`contract_id`) REFERENCES `contracts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `signatures_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
