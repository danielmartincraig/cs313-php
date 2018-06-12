DROP TABLE notes;
DROP TABLE categories;
DROP TABLE colors;

CREATE TABLE colors
(
color_id SERIAL PRIMARY KEY,
color_name VARCHAR NOT NULL UNIQUE,
color_string VARCHAR NOT NULL
);

CREATE TABLE categories
(
category_id SERIAL PRIMARY KEY,
color_id INTEGER REFERENCES colors(color_id) NOT NULL,
category_title VARCHAR(30) NOT NULL,
category_description VARCHAR(40) NOT NULL
);

CREATE TABLE notes
(
note_id SERIAL PRIMARY KEY,
category_id INTEGER REFERENCES categories(category_id) NOT NULL,
parent_id INTEGER REFERENCES notes(note_id) ON DELETE CASCADE NOT NULL,
title VARCHAR(40) NOT NULL,
body VARCHAR(240),
starred BOOLEAN NOT NULL
);

INSERT INTO colors(color_name, color_string)
VALUES
('RED', 'FF0000');

INSERT INTO colors(color_name, color_string)
VALUES
('BEIGE', 'FFFFCC');

INSERT INTO colors(color_name, color_string)
VALUES
('GREEN', '96DB7F');

INSERT INTO colors(color_name, color_string)
VALUES
('YELLOW', 'D7DB7F');

INSERT INTO categories(color_id, category_title, category_description)
VALUES
((SELECT color_id FROM colors WHERE color_name='YELLOW'), 'SCHOOL', 'School');

INSERT INTO categories(color_id, category_title, category_description)
VALUES
((SELECT color_id FROM colors WHERE color_name='RED'), 'WORK', 'Work');

INSERT INTO categories(color_id, category_title, category_description)
VALUES
((SELECT color_id FROM colors WHERE color_name='BEIGE'), 'WEDDING', 'Wedding Planning');

INSERT INTO categories(color_id, category_title, category_description)
VALUES
((SELECT color_id FROM colors WHERE color_name='GREEN'), 'Church', 'Church');

--A hidden root category
INSERT INTO categories(color_id, category_title, category_description)
VALUES
((SELECT color_id FROM colors WHERE color_name='GREEN'), 'ROOT', 'Root');

--Add the hidden root note
INSERT INTO notes(category_id, parent_id, title, body, starred)
VALUES
((SELECT category_id
  FROM categories
  WHERE category_title = 'ROOT'
  AND category_description = 'Root')
, 1
, 'ROOT'
, 'Root'
, FALSE);

INSERT INTO notes(category_id, parent_id, title, body, starred)
VALUES
((SELECT category_id
  FROM categories
  WHERE category_title = 'WEDDING'
  AND category_description = 'Wedding Planning')
, (SELECT note_id
  FROM notes
  WHERE title = 'ROOT'
  AND body = 'Root')
, 'Remember to plan your wedding'
, ''
, FALSE);

INSERT INTO notes(category_id, parent_id, title, body, starred)
VALUES
((SELECT category_id
  FROM categories
  WHERE category_title = 'WEDDING'
  AND category_description = 'Wedding Planning')
, (SELECT note_id
  FROM notes
  WHERE title = 'Remember to plan your wedding'
  AND body = '')
, 'Address the invitations'
, 'You need to hand-write every address'
, FALSE);

INSERT INTO notes(category_id, parent_id, title, body, starred)
VALUES
((SELECT category_id
  FROM categories
  WHERE category_title = 'WEDDING'
  AND category_description = 'Wedding Planning')
, (SELECT note_id
  FROM notes
  WHERE title = 'Remember to plan your wedding'
  AND body = '')
, 'Pay for postage'
, 'This much postage will not come cheaply'
, FALSE);

INSERT INTO notes(category_id, parent_id, title, body, starred)
VALUES
((SELECT category_id
  FROM categories
  WHERE category_title = 'WEDDING'
  AND category_description = 'Wedding Planning')
, (SELECT note_id
  FROM notes
  WHERE title = 'Address the invitations'
  AND body = 'You need to hand-write every address')
, 'Decide whether to put home address'
, 'It makes more sense than putting AZ address on them'
, TRUE);

INSERT INTO notes(category_id, parent_id, title, body, starred)
VALUES
((SELECT category_id
  FROM categories
  WHERE category_title = 'WEDDING'
  AND category_description = 'Wedding Planning')
, (SELECT note_id
  FROM notes
  WHERE title = 'Pay for postage'
  AND body = 'This much postage will not come cheaply')
, 'Put stamps upside down'
, 'An upside down stamp means I Love You'
, TRUE);


INSERT INTO notes(category_id, parent_id, title, body, starred)
VALUES
((SELECT category_id
  FROM categories
  WHERE category_title = 'SCHOOL'
  AND category_description = 'School')
, 1
, 'Stay up late'
, 'It will be worth it some day'
, TRUE);

INSERT INTO notes(category_id, parent_id, title, body, starred)
VALUES
((SELECT category_id
  FROM categories
  WHERE category_title = 'SCHOOL'
  AND category_description = 'School')
, (SELECT note_id
  FROM notes
  WHERE title = 'Stay up late'
  AND body = 'It will be worth it some day')
, 'You can sleep '
, 'When you are dead'
, TRUE);

