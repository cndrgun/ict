CREATE DATABASE mydatabase;
CREATE USER postgres WITH ENCRYPTED PASSWORD '123456';
GRANT ALL PRIVILEGES ON DATABASE postgres TO postgres;