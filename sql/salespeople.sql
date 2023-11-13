INSERT INTO users (email, first_name, last_name, password_hash, created_time, last_login_time, phone_extension, user_type)
VALUES (
    'paologavi@dcmail.ca', 'Paolo', 'Gavi', crypt('test', gen_salt('bf')), '2023-10-31', '2023-10-31', 647, 's'
    );

INSERT INTO users (email, first_name, last_name, password_hash, created_time, last_login_time, phone_extension, user_type)
VALUES (
    'gonzalezpedri@dcmail.ca', 'Gonzalez', 'Pedri', crypt('test', gen_salt('bf')), '2023-10-31', '2023-10-31', 642, 's'
    );

INSERT INTO users (email, first_name, last_name, password_hash, created_time, last_login_time, phone_extension, user_type)
VALUES (
    'andres@dcmail.ca', 'Perez', 'Andres', crypt('test', gen_salt('bf')), '2023-10-31', '2023-10-31', 666, 's'
    );

SELECT * FROM users; 