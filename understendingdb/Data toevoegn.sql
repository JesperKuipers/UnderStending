USE `understendingdb`;

--
-- Add rank
--

INSERT INTO usertype (userTypeID, name) VALUES (1, "admin");

--
-- Add admin account
--

INSERT INTO user (userTypeID, name, email, password, admin) VALUES (1, "admin", "admin@admin.com", "$2y$10$LRZ8k.t8ROiYT4/oGydR7OEi42XYLDPw7mjhOHvIQyAyvPnQ9CfIe", 1);