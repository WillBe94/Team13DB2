
DROP TABLE IF EXISTS enroll;
DROP TABLE IF EXISTS assign;
DROP TABLE IF EXISTS material;
DROP TABLE IF EXISTS meetings;
DROP TABLE IF EXISTS time_slot;
DROP TABLE IF EXISTS groups;
DROP TABLE IF EXISTS admins;
DROP TABLE IF EXISTS child_of;
DROP TABLE IF EXISTS students;
DROP TABLE IF EXISTS parents;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS member_of;

-- ----------------------------
-- Table structure for users
-- ----------------------------

CREATE TABLE users (
  id int(11) NOT NULL,
  email varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  name varchar(255) NOT NULL,
  phone varchar(255) DEFAULT NULL,
  PRIMARY KEY (id) 
);

-- ----------------------------
-- Table structure for parents
-- ----------------------------

CREATE TABLE parents (
  parent_id int(11),
  PRIMARY KEY (parent_id),
  FOREIGN KEY (parent_id) REFERENCES users (id) ON DELETE CASCADE
);

-- ----------------------------
-- Table structure for students
-- ----------------------------

CREATE TABLE students (
  student_id int(11) NOT NULL,
  grade int(11) DEFAULT NULL,
  bday DATE NOT NULL,
  pronouns VARCHAR(255) NOT NULL,
  allergies VARCHAR(255) NOT NULL,
  PRIMARY KEY (student_id),
  FOREIGN KEY (student_id) REFERENCES users (id) ON DELETE CASCADE
);

-- ----------------------------
-- Table structure for child_of
-- ----------------------------

CREATE TABLE child_of (
  student_id int(11),
  parent_id int(11),
  PRIMARY KEY (student_id, parent_id),
  FOREIGN KEY (student_id) REFERENCES students (student_id),
  FOREIGN KEY (parent_id) REFERENCES parents (parent_id) 
);


-- ----------------------------
-- Table structure for admins
-- ----------------------------

CREATE TABLE admins (
  admin_id int(11),
  PRIMARY KEY (admin_id),
  FOREIGN KEY (admin_id) REFERENCES users (id) ON DELETE CASCADE
);


-- ----------------------------
-- Table structure for groups
-- ----------------------------

CREATE TABLE groups (
  group_id int(11),
  name varchar(255) NOT NULL,
  description varchar(255),
  grade_req int(11),
  PRIMARY KEY (group_id)
);


-- ----------------------------
-- Table structure for time_slot (this table is from normalizaion)
-- ----------------------------

CREATE TABLE time_slot (
  time_slot_id int(11),
  day_of_the_week varchar(255) NOT NULL,
  start_time time NOT NULL,
  end_time time NOT NULL,
  PRIMARY KEY (time_slot_id)
);

-- ----------------------------
-- Table structure for meetings
-- ----------------------------

CREATE TABLE meetings (
  meeting_id int(11),
  meeting_name varchar(255) NOT NULL,
  date date NOT NULL,
  time_slot_id int(11) NOT NULL,
  capacity int(11) NOT NULL,
  group_id int(11) NOT NULL,
  announcement varchar(255),
  PRIMARY KEY (meeting_id),
  FOREIGN KEY (group_id) REFERENCES groups (group_id),
  FOREIGN KEY (time_slot_id) REFERENCES time_slot (time_slot_id)
);

-- ----------------------------
-- Table structure for material
-- ----------------------------

CREATE TABLE material (
  material_id int(11),
  meeting_id int(11),
  title varchar(255) NOT NULL,
  author varchar(255),
  type varchar(255),
  url varchar(255),
  notes varchar(255),
  assigned_date date NOT NULL,
  PRIMARY KEY (material_id, meeting_id),
  FOREIGN KEY (meeting_id) REFERENCES meetings (meeting_id) ON DELETE CASCADE
);

-- ----------------------------
-- Table structure for enroll
-- ----------------------------

CREATE TABLE enroll (
  meeting_id int(11) NOT NULL,
  student_id int(11) NOT NULL,
  PRIMARY KEY (meeting_id, student_id),
  FOREIGN KEY (student_id) REFERENCES students (student_id),
  FOREIGN KEY (meeting_id) REFERENCES meetings (meeting_id)
);

-- ------------------------------
-- Table structure for member_of
-- ------------------------------

CREATE TABLE member_of (
  group_id int(11) NOT NULL,
  student_id int(11) NOT NULL,
  PRIMARY KEY (group_id, student_id),
  FOREIGN KEY (student_id) REFERENCES students (student_id),
  FOREIGN KEY (group_id) REFERENCES groups (group_id)
);
