CREATE TABLE people (
  id INT AUTO_INCREMENT PRIMARY KEY,
  is_core TINYINT(1) NOT NULL DEFAULT 0,
  display_name VARCHAR(120) NOT NULL,
  locality VARCHAR(120),
  quadrant ENUM('study','devotional','childrens','jyp') NOT NULL,
  pos_r FLOAT NULL,
  pos_a FLOAT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE connections (
  id INT AUTO_INCREMENT PRIMARY KEY,
  from_person_id INT NOT NULL,
  to_person_id INT NOT NULL,
  connection_type ENUM('met','invited','taught','visited','other') NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY uniq_edge (from_person_id, to_person_id)
);
