DROP TABLE notes;
DROP TABLE colors;
DROP TABLE categories;

CREATE TABLE colors
(
color_id SERIAL PRIMARY KEY,
color_name VARCHAR NOT NULL,
color_string VARCHAR NOT NULL
);

CREATE TABLE categories
(
category_id SERIAL PRIMARY KEY,
category_title VARCHAR(30) NOT NULL,
category_description VARCHAR(40) NOT NULL
);

CREATE TABLE notes
(
note_id SERIAL PRIMARY KEY,
category_id INTEGER REFERENCES categories(category_id) NOT NULL,
color_id INTEGER REFERENCES colors(color_id) NOT NULL,
parent_id INTEGER REFERENCES notes(note_id) NOT NULL,
title VARCHAR(40) NOT NULL,
body VARCHAR(240),
starred BOOLEAN NOT NULL
);

INSERT INTO colors(color_name, color_string)
VALUES
('RED', 'FF0000');

INSERT INTO colors(color_name, color_string)
VALUES
('BEIGE', 'D4A190');

INSERT INTO colors(color_name, color_string)
VALUES
('GREEN', '96DB7F');

INSERT INTO colors(color_name, color_string)
VALUES
('YELLOW', 'D7DB7F');

INSERT INTO categories(category_title, category_description)
VALUES
('SCHOOL', 'School');

INSERT INTO categories(category_title, category_description)
VALUES
('WORK', 'Work');

INSERT INTO categories(category_title, category_description)
VALUES
('WEDDING', 'Wedding Planning');

INSERT INTO categories(category_title, category_description)
VALUES
('Church', 'Church');

--A hidden root category
INSERT INTO categories(category_title, category_description)
VALUES
('ROOT', 'Root');

--Add the hidden root note
INSERT INTO notes(category_id, color_id, parent_id, title, body, starred)
VALUES
((SELECT category_id
  FROM categories
  WHERE category_title = 'ROOT'
  AND category_description = 'Root')
, (SELECT color_id
  FROM colors
  WHERE color_name = 'BEIGE')
, 1
, 'HIDDEN ROOT NODE'
, 'If you can see this, call your senator.'
, FALSE);

INSERT INTO notes(category_id, color_id, parent_id, title, body, starred)
VALUES
((SELECT category_id
  FROM categories
  WHERE category_title = 'WEDDING'
  AND category_description = 'Wedding Planning')
, (SELECT color_id
  FROM colors
  WHERE color_name = 'BEIGE')
, (SELECT note_id
  FROM notes
  WHERE title = 'HIDDEN ROOT NODE'
  AND body = 'If you can see this, call your senator.')
, 'Remember to plan your wedding'
, ''
, FALSE);

INSERT INTO notes(category_id, color_id, parent_id, title, body, starred)
VALUES
((SELECT category_id
  FROM categories
  WHERE category_title = 'WEDDING'
  AND category_description = 'Wedding Planning')
, (SELECT color_id
  FROM colors
  WHERE color_name = 'BEIGE')
, (SELECT note_id
  FROM notes
  WHERE title = 'Remember to plan your wedding'
  AND body = '')
, 'Address the invitations'
, 'You need to hand-write every address'
, FALSE);

INSERT INTO notes(category_id, color_id, parent_id, title, body, starred)
VALUES
((SELECT category_id
  FROM categories
  WHERE category_title = 'WEDDING'
  AND category_description = 'Wedding Planning')
, (SELECT color_id
  FROM colors
  WHERE color_name = 'BEIGE')
, (SELECT note_id
  FROM notes
  WHERE title = 'Remember to plan your wedding'
  AND body = '')
, 'Pay for postage'
, 'This much postage will not come cheaply'
, FALSE);

