CREATE TABLE `todo` (
  `todo_id` bigint(20) NOT NULL,
  `todo_task` text NOT NULL,
  `todo_status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `todo`
  ADD PRIMARY KEY (`todo_id`);

ALTER TABLE `todo`
  MODIFY `todo_id` bigint(20) NOT NULL AUTO_INCREMENT;