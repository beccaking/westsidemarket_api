createdb westsidemarket
psql westsidemarket

CREATE TABLE vendors (id VARCHAR(5), name VARCHAR(60), image text, description text, contact VARCHAR(12));

INSERT INTO vendors (id, name, image, description, contact) VALUES ('A1', 'Johnny Hot Dog', 'http://westsidemarket.org/wp-content/uploads/IMG_0455_small.jpg', 'Johnny Hot Dog has been a staple at the West Side Market for many years. They offer a variety or burgers, chicken sandwiches and cooked to order hot dogs. Johnny’s also offers a large selection of deliciously hot breakfast sandwiches.', '216-502-9729'),
('A3', 'P-Nut Gallery', 'http://westsidemarket.org/wp-content/uploads/nuts_E3.jpg', 'Since 1996, P-Nut Gallery’s product and excellent customer service has kept its customers satisfied and coming back for more. P-Nut Gallery looks forward to sharing their love of nuts with all of their customers. They have accessibility to the highest quality, most delicious and most nutritious nuts.', '216-623-1084');

CREATE TABLE comments (id SERIAL, username text, vendorid VARCHAR(5), content text, commentdate timestamp);

INSERT INTO comments (username, vendorid, content, commentdate) VALUES ('Becca','A1', 'Johnny Hot Dog is the best!', CURRENT_TIMESTAMP);

CREATE TABLE users (id SERIAL, username text, password text);

INSERT INTO users (username, password) VALUES ('Becca', 'Becca');
